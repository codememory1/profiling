<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Caching\Exceptions\ConfigPathNotExistException;
use Codememory\Components\Configuration\Config;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Configuration\Interfaces\ConfigInterface;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;
use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\FileSystem\File;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Utils
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class Utils
{

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * @throws ConfigPathNotExistException
     * @throws EnvironmentVariableNotFoundException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     * @throws ConfigNotFoundException
     */
    public function __construct()
    {

        $config = new Config(new File());

        $this->config = $config->open(GlobalConfig::get('profiler.configName'), $this->defaultConfig());

    }

    /**
     * @return bool
     */
    public function isDev(): bool
    {

        $mode = $this->config->get('mode');

        if (preg_match('/^dev/', $mode)) {
            return true;
        }

        return false;

    }

    /**
     * @return bool
     */
    public function isProd(): bool
    {

        $mode = $this->config->get('mode');

        if (preg_match('/^prod/', $mode)) {
            return true;
        }

        return false;

    }

    /**
     * @return bool
     */
    public function enabledProfiler(): bool
    {

        return $this->config->get('profiler.enabled');

    }

    /**
     * @return bool
     */
    public function isProfilingController(): bool
    {

        return $this->config->get('profiler.controllerProfiling');

    }

    /**
     * @return array
     */
    public function profilingPages(): array
    {

        return $this->config->get('profiler.profilingPages');

    }

    /**
     * @return string
     */
    public function profilerSubdomain(): string
    {

        return $this->config->get('profiler.security.subdomain');

    }

    /**
     * @return bool
     */
    public function enabledProfilerInProduction(): bool
    {

        return $this->config->get('profiler.security.enabledInProduction');

    }

    /**
     * @return bool
     */
    public function enabledToolbar(): bool
    {

        return $this->config->get('toolbar.enabled');

    }

    /**
     * @return bool
     */
    public function enabledToolbarInProduction(): bool
    {

        return $this->config->get('toolbar.enabledInProduction');

    }

    /**
     * @return bool|string
     */
    public function enableToolbarByIp(): bool|string
    {

        return $this->config->get('toolbar.enableByIp');

    }

    /**
     * @return array
     */
    #[ArrayShape([
        'mode'     => "string",
        'profiler' => "array",
        'toolbar'  => "array"
    ])]
    private function defaultConfig(): array
    {

        return [
            'mode'     => GlobalConfig::get('profiler.mode'),
            'profiler' => [
                'enabled'             => GlobalConfig::get('profiler.enabled'),
                'controllerProfiling' => true,
                'profilingPages'      => [],
                'security'            => [
                    'subdomain'           => GlobalConfig::get('profiler.security.subdomain'),
                    'enabledInProduction' => GlobalConfig::get('profiler.security.enabledInProduction')
                ]
            ],
            'toolbar'  => [
                'enabled'             => GlobalConfig::get('profiler.toolbar.enabled'),
                'enabledInProduction' => GlobalConfig::get('profiler.toolbar.enabledInProduction'),
                'enableByIp'          => GlobalConfig::get('profiler.toolbar.enableByIp'),
            ]
        ];

    }

}