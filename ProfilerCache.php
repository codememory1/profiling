<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Caching\Cache;
use Codememory\Components\Caching\Interfaces\CacheInterface;
use Codememory\Components\Markup\Types\YamlType;
use Codememory\FileSystem\File;
use Codememory\FileSystem\Interfaces\FileInterface;

/**
 * Class ProfilerCache
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class ProfilerCache
{

    private const TYPE_CACHE = '__cdm-profiler';
    private const NAME_CACHE = 'profiling';

    /**
     * @var CacheInterface
     */
    private CacheInterface $caching;

    /**
     * ProfilerCache Construct
     */
    public function __construct()
    {

        $this->caching = new Cache(new YamlType(), new File());

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Change the data in the profiler cache. The callback is passed a reference data argument that
     * can be changed. If the cache does not exist, then it will be created
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param callable $callback
     */
    public function change(callable $callback): void
    {

        if ($this->caching->exist(self::TYPE_CACHE, self::NAME_CACHE)) {
            $this->caching->get(self::TYPE_CACHE, self::NAME_CACHE, function (FileInterface $filesystem, string $fullPath) use ($callback) {
                $fullPath = sprintf('%s.data', $fullPath);

                $data = [];

                if ($filesystem->exist($fullPath)) {
                    $cache = file_get_contents($filesystem->getRealPath($fullPath));
                    $data = unserialize($cache);
                }

                call_user_func_array($callback, [&$data]);

                file_put_contents($fullPath, serialize($data));

                return false;
            });
        } else {
            $data = [];

            call_user_func_array($callback, [&$data]);

            $this->caching->create(self::TYPE_CACHE, self::NAME_CACHE, $data, function (FileInterface $filesystem, string $fullPath, mixed $data) {
                $fullPath = sprintf('%s.data', $fullPath);

                file_put_contents($fullPath, serialize($data));
            });
        }

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns profiler cache data. If the cache does not exist, an empty array will be returned
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     */
    public function get(): array
    {

        return $this->caching->get(self::TYPE_CACHE, self::NAME_CACHE, function (FileInterface $filesystem, string $fullPath) {
            $fullPath = sprintf('%s.data', $fullPath);

            if (!$filesystem->exist($fullPath)) {
                return [];
            }

            return unserialize(file_get_contents($filesystem->getRealPath($fullPath)));
        });

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Clears the profiler cache
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public function remove(): void
    {

        $this->caching->remove(self::TYPE_CACHE, self::NAME_CACHE);

    }

}