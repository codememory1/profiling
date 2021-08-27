<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Caching\Cache;
use Codememory\Components\Caching\Interfaces\CacheInterface;
use Codememory\Components\Markup\Types\YamlType;
use Codememory\Components\Profiling\Interfaces\ProfilerCacheInterface;
use Codememory\FileSystem\File;
use Codememory\FileSystem\Interfaces\FileInterface;
use Codememory\Support\Arr;

/**
 * Class ProfilerCache
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class ProfilerCache implements ProfilerCacheInterface
{

    private const TYPE_CACHE = '__cdm-profiler';
    private const NAME_CACHE = 'profiling';

    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    /**
     * ProfilerCache construct
     */
    public function __construct()
    {

        $this->cache = new Cache(new YamlType(), new File());

    }

    /**
     * @inheritDoc
     */
    public function add(string $page, string $sectionName, array $data, bool $asAdd = false): ProfilerCache
    {

        $this->cache->create(self::TYPE_CACHE, self::NAME_CACHE, $data, function (FileInterface $filesystem, string $fullPath, mixed $data) use ($page, $sectionName, $asAdd) {
            $cacheSerialize = [];
            $fullPath = $fullPath . '.data';

            if ($filesystem->exist($fullPath)) {
                $cacheSerialize = unserialize(file_get_contents($filesystem->getRealPath($fullPath)));
            }

            if($asAdd) {
                $cacheSerialize[$page][$sectionName][] = $data;
            } else {
                $cacheSerialize[$page][$sectionName] = $data;
            }

            file_put_contents($filesystem->getRealPath($fullPath), serialize($cacheSerialize));
        });

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {

        return $this->cache->get(self::TYPE_CACHE, self::NAME_CACHE, function (FileInterface $filesystem, string $fullPath) {
            $fullPath = $fullPath . '.data';

            if (!$filesystem->exist($fullPath)) {
                return [];
            }

            return unserialize(file_get_contents($filesystem->getRealPath($fullPath)));
        });

    }

    /**
     * @inheritDoc
     */
    public function get(string $page, string $sectionName): array
    {

        $data = Arr::set($this->getAll())::get(sprintf('%s.%s', $page, $sectionName));

        return $data ?: [];

    }

    /**
     * @inheritDoc
     */
    public function removeAllStatistic(): void
    {

        $this->cache->remove(self::TYPE_CACHE, self::NAME_CACHE);

    }

}