<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Exceptions\FileNotExistException;
use Codememory\Components\Profiling\Interfaces\ResourceInterface;

/**
 * Class Resource
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class Resource implements ResourceInterface
{

    private const PATH_TO_RESOURCES = 'Resources';


    /**
     * @inheritDoc
     */
    public function getPath(?string $path = null): string
    {

        return sprintf('%s/%s/%s', __DIR__, self::PATH_TO_RESOURCES, $path);

    }

    /**
     * @inheritDoc
     * @throws FileNotExistException
     */
    public function getResourceInBase64(string $resource): string
    {

        $fullPath = $this->getPath($resource);

        if (!file_exists($fullPath) || !is_file($fullPath)) {
            throw new FileNotExistException($fullPath);
        }

        $format = 'data:%s;base64,%s';

        return sprintf($format, $this->getExactMimeType($resource), base64_encode(file_get_contents($fullPath)));

    }

    /**
     * @inheritDoc
     * @throws FileNotExistException
     */
    public function getExactMimeType(string $resource): string
    {

        $fullPath = $this->getPath($resource);

        if (!file_exists($fullPath) || !is_file($fullPath)) {
            throw new FileNotExistException($fullPath);
        }

        $mimeType = mime_content_type($fullPath);
        $resourceInfo = pathinfo($fullPath);

        return str_replace([
            'plain'
        ], [
            $resourceInfo['extension']
        ], $mimeType);

    }

}