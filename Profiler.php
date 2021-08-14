<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Caching\Cache;
use Codememory\Components\Caching\Interfaces\CacheInterface;
use Codememory\Components\Markup\Types\YamlType;
use Codememory\Components\Profiling\Interfaces\ProfilerInterface;
use Codememory\FileSystem\File;
use Codememory\FileSystem\Interfaces\FileInterface;
use Codememory\Support\Str;
use Generator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Profiler
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class Profiler implements ProfilerInterface
{

    private const TYPE_CACHE = '__cdm-profiling';
    private const NAME_CACHE = 'reports';

    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    /**
     * @var array
     */
    private array $profilingData = [];

    /**
     * Profiler Construct
     */
    public function __construct()
    {

        $this->cache = new Cache(new YamlType(), new File());

    }

    /**
     * @inheritDoc
     */
    public function enable(array $options = []): void
    {

        xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY, $options);

    }

    /**
     * @inheritDoc
     */
    public function profile(): void
    {

        $this->profilingData = xhprof_disable();

        $this->save($this->profilingData);

    }

    /**
     * @return array
     */
    public function getProfiledData(): array
    {

        return $this->profilingData;

    }

    /**
     * @param string $str
     *
     * @return array
     */
    public function stringToUnicode(string $str): array
    {

        $codes = [];
        $strLength = mb_strlen($str, 'utf8');

        for ($i = 0; $i < $strLength; $i++) {
            $codes[] = ord($str[$i]);
        }

        return $codes;

    }

    /**
     * @param array $codes
     *
     * @return string
     */
    public function unicodeCodesToString(array $codes): string
    {

        $str = null;

        foreach ($codes as $code) {
            $str .= chr($code);
        }

        return $str;

    }

    /**
     * @param array $components
     *
     * @return array
     */
    public function getUniqueComponentNames(array $components): array
    {

        $uniqueComponentNames = [];

        foreach ($this->iterationData($components) as $componentNamesString => $value) {
            $componentNames = explode('==>', $componentNamesString);

            foreach ($componentNames as $componentName) {
                if (!in_array($componentName, $uniqueComponentNames)) {
                    $uniqueComponentNames[] = $componentName;
                }
            }
        }

        return $uniqueComponentNames;

    }

    /**
     * @param array       $report
     * @param string|null $sortByKeyData
     *
     * @return array
     */
    public function getUniqueComponentNamesWithData(array $report, ?string $sortByKeyData = null): array
    {

        $uniqueComponentNamesWithData = [];

        foreach ($this->getUniqueComponentNames($report) as $uniqueComponentName) {
            foreach ($this->iterationData($report) as $componentNamesString => $value) {
                if (Str::ends($componentNamesString, $uniqueComponentName)) {
                    $uniqueComponentNamesWithData[$uniqueComponentName] = $value;
                }
            }
        }

        if (null !== $sortByKeyData) {
            uasort($uniqueComponentNamesWithData, function (array $data1, array $data2) use ($sortByKeyData) {
                return $data1[$sortByKeyData] < $data2[$sortByKeyData];
            });
        }

        return $uniqueComponentNamesWithData;

    }

    /**
     * @param string $componentName
     * @param array  $components
     *
     * @return array
     */
    public function getComponentsByName(string $componentName, array $components): array
    {

        $uniqueComponentNamesWithData = [];

        foreach ($this->iterationData($components) as $componentNamesString => $value) {
            if (Str::starts($componentNamesString, sprintf('%s==>', $componentName))) {
                preg_match('/(?<current>.*)==>(?<next>.*)/', $componentNamesString, $match);

                $uniqueComponentNamesWithData[$match['next']] = $value;
            }
        }

        return $uniqueComponentNamesWithData;

    }

    /**
     * @return array
     */
    public function getReports(): array
    {

        return $this->cache->get(self::TYPE_CACHE, self::NAME_CACHE, function (FileInterface $filesystem, string $fullPath) {
            $fullPath = $fullPath . '.fc';

            if ($filesystem->exist($fullPath)) {
                return unserialize(file_get_contents($filesystem->getRealPath($fullPath)));
            }

            return [];
        }) ?: [];

    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getReport(string $name): array
    {

        return $this->getReports()[$name] ?? [];

    }

    /**
     * @return void
     */
    public function clear(): void
    {

        $this->cache->remove(self::TYPE_CACHE, self::NAME_CACHE);

    }

    /**
     * @param array       $main
     * @param array       $comparable
     * @param string|null $sortByKey
     *
     * @return array
     */
    public function diffReports(array $main, array $comparable, ?string $sortByKey = null): array
    {

        $result = [];

        foreach ($main as $componentName => $data) {
            if (array_key_exists($componentName, $main)) {
                $componentDataOfComparable = $comparable[$componentName];
                $ctResult = $componentDataOfComparable['ct'] - $data['ct'];
                $mtResult = $componentDataOfComparable['wt'] - $data['wt'];
                $cpuResult = $componentDataOfComparable['cpu'] - $data['cpu'];
                $muResult = $componentDataOfComparable['mu'] - $data['mu'];
                $pmuResult = $componentDataOfComparable['pmu'] - $data['pmu'];

                $result[$componentName] = [
                    'ct'  => [
                        'was'     => $data['ct'],
                        'changed' => $ctResult
                    ],
                    'wt'  => [
                        'was'     => $data['wt'],
                        'changed' => $mtResult
                    ],
                    'cpu' => [
                        'was'     => $data['cpu'],
                        'changed' => $cpuResult
                    ],
                    'mu'  => [
                        'was'     => $data['mu'],
                        'changed' => $muResult
                    ],
                    'pmu' => [
                        'was'     => $data['pmu'],
                        'changed' => $pmuResult
                    ]
                ];
            }
        }

        if (null !== $sortByKey) {
            uasort($result, function (array $data1, array $data2) use ($sortByKey) {
                return $data1[$sortByKey]['was'] < $data2[$sortByKey]['was'];
            });
        }

        return $result;

    }

    /**
     * @param array $diffReport
     *
     * @return array
     */
    #[ArrayShape(['added' => "array", 'removed' => "array"])]
    public function getDiffCommonNumbers(array $diffReport): array
    {

        $numbers = [
            'added'   => [],
            'removed' => []
        ];

        foreach ($diffReport as $data) {
            foreach ($data as $key => $value) {
                if($value['changed'] < 0) {
                    if(!array_key_exists($key, $numbers['removed'])) {
                        $numbers['removed'][$key] = 0;
                    }

                    $numbers['removed'][$key] += $value['changed'];
                } else {
                    if(!array_key_exists($key, $numbers['added'])) {
                        $numbers['added'][$key] = 0;
                    }

                    $numbers['added'][$key] += $value['changed'];
                }
            }
        }

        return $numbers;

    }

    /**
     * @return void
     */
    public function connectTemplate(): void
    {

        require_once 'Resources/templates/profiler.php';

    }

    /**
     * @param array $data
     *
     * @return Generator
     */
    private function iterationData(array $data): Generator
    {

        foreach ($data as $key => $value) {
            yield $key => $value;
        }

    }

    /**
     * @param array $data
     */
    private function save(array $data): void
    {

        $report[uniqid()] = $data;

        $this->cache->create(self::TYPE_CACHE, self::NAME_CACHE, $report, function (FileInterface $filesystem, string $fullPath, array $data) {
            $fullPath = $fullPath . '.fc';

            if ($filesystem->exist($fullPath)) {
                $dataOfCache = unserialize(file_get_contents($filesystem->getRealPath($fullPath)));
                $data = array_merge($data, $dataOfCache);
            }

            file_put_contents($filesystem->getRealPath($fullPath), serialize($data));
        });

    }

}