<?php

namespace Codememory\Components\Profiling\ErrorHandler;

use Codememory\Components\Profiling\Resource;
use Codememory\Components\Profiling\Utils;
use Codememory\FileSystem\File;
use ErrorException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\RunInterface;

/**
 * Class ErrorHandler
 *
 * @package Codememory\Components\Profiling\ErrorHandler
 *
 * @author  Codememory
 */
class ErrorHandler
{

    /**
     * @var Utils
     */
    private Utils $utils;

    /**
     * @var RunInterface
     */
    private RunInterface $whoopsRun;

    /**
     * ErrorHandler Construct
     */
    public function __construct()
    {

        $this->utils = new Utils();
        $this->whoopsRun = new Run();

    }

    /**
     * @return void
     */
    public function modeHandler(): void
    {

        if ($this->utils->isDev()) {
            $this->developmentModeHandler();
        } else if ($this->utils->isProd()) {
            $this->productionModeHandler();
        } else {
            $this->developmentModeHandler();
        }

    }

    /**
     * @return void
     */
    private function developmentModeHandler(): void
    {

        $prettyHandler = new PrettyPageHandler();
        $prettyHandler
            ->addResourcePath((new Resource())->getPath())
            ->addCustomCss('css/error-handler.css');

        $this->whoopsRun->pushHandler($prettyHandler)->register();

    }

    /**
     * @return void
     */
    private function productionModeHandler(): void
    {

        ini_set('error_reporting', -1);
        ini_set('display_errors', '0');

        ini_set('ignore_repeated_errors', true);
        ini_set('html_errors', false);

        $this->whoopsRun->pushHandler(function (ErrorException $exception) {
            $filesystem = new File();
            $configErrorHandler = $this->utils->getErrorHandler();

            file_put_contents($filesystem->getRealPath($configErrorHandler['pathLogs'].$configErrorHandler['logFilename']), json_encode([
                'message' => $exception->getMessage(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
            ]), FILE_APPEND);
        })->register();

    }

}