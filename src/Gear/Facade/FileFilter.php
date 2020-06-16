<?php
declare(strict_types = 1);

namespace Chopper\Gear\Facade;

use Chopper\Curl\Request\CurlRequest;
use Chopper\Downloader\HttpDownloader;
use Chopper\Gear\Filtration\FilterCell\FilterCellInterface;
use Chopper\Gear\Filtration\Filtrator\Filtrator;
use Chopper\Logger\LoggerContainer\LoggerContainerInterface;

/**
 * FileFilter
 */
final class FileFilter
{
    /**
     * @var LoggerContainerInterface
     */
    private $loggerContainer;

    /**
     * Конструктор.
     *
     * @param LoggerContainerInterface $loggerContainer
     */
    public function __construct(LoggerContainerInterface $loggerContainer)
    {
        $this->loggerContainer = $loggerContainer;
    }

    /**
     * File filtering method
     *
     * @param string              $path
     * @param string              $dest
     * @param FilterCellInterface $cell
     *
     * @return bool
     */
    public function filtering(string $path, string $dest, FilterCellInterface $cell): bool
    {
        $filtrator = new Filtrator($cell, $this->loggerContainer->getLogger());

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            file_put_contents($dest,
                $filtrator->handle((new HttpDownloader(new CurlRequest(), $this->loggerContainer->getLogFilePath()
                ))->download($path)->getBody()
                )
            );

            return true;
        }
        if (file_exists($path) && is_readable($path)) {
            file_put_contents($dest, $filtrator->handle(file_get_contents($path)));

            return true;
        }
        $this->loggerContainer->getLogger()->warn(sprintf("Filtering error! %s is not valid.", $path));

        return false;
    }
}
