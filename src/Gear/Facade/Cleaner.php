<?php
declare(strict_types = 1);

namespace Chopper\Gear\Facade;

use Chopper\Curl\Request\CurlRequest;
use Chopper\Downloader\HttpDownloader;
use Chopper\Gear\Factory\Filter\FilterFactoryInterface;
use Chopper\Gear\Filtration\Filtrator\Filtrator;
use Chopper\Logger\GlobalLogger\GlobalLoggerInterface;

/**
 * Cleaner
 */
class Cleaner
{
    /**
     * @var GlobalLoggerInterface
     */
    private $globalLogger;

    /**
     * Конструктор.
     *
     * @param GlobalLoggerInterface $globalLogger
     */
    public function __construct(GlobalLoggerInterface $globalLogger)
    {
        $this->globalLogger = $globalLogger;
    }

    /**
     * Method filts file
     *
     * @param string                 $path
     * @param string                 $dest
     * @param FilterFactoryInterface $factory
     *
     * @return bool
     */
    public function filterFile(string $path, string $dest, FilterFactoryInterface $factory): bool
    {
        $filtrator = new Filtrator($factory, $this->globalLogger->getLogger());

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            file_put_contents(
                $dest,
                $filtrator->handle(
                    (new HttpDownloader(new CurlRequest(), $this->globalLogger->getLogFilePath()))->download($path)
                        ->getBody()
                )
            );

            return true;
        }
        if (file_exists($path) && is_readable($path)) {
            file_put_contents($dest, $filtrator->handle(file_get_contents($path)));

            return true;
        }

        return false;
    }
}
