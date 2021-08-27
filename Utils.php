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
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function __construct()
    {

        $config = new Config(new File());

        $this->config = $config->open(GlobalConfig::get('profiling.configName'), $this->defaultConfig());

    }

    /**
     * @return string
     */
    public function getSubdomain(): string
    {

        return $this->config->get('subdomain');

    }

    /**
     * @return bool
     */
    public function getEnabledInProd(): bool
    {

        return $this->config->get('security.enabledInProduction');

    }

    /**
     * @return array
     */
    #[ArrayShape([
        'subdomain' => "mixed",
        'security' => "array"
    ])]
    private function defaultConfig(): array
    {

        return [
            'subdomain' => GlobalConfig::get('profiling.subdomain'),
            'security'  => [
                'enabledInProduction' => GlobalConfig::get('profiling.enabledInProduction')
            ]
        ];

    }

}