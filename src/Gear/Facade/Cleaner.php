<?php
declare(strict_types = 1);

namespace Chopper\Gear\Facade;

use Chopper\Component\Curl\Request\CurlRequest;
use Chopper\Component\Downloader\HttpDownloader;
use Chopper\Component\Logger\GlobalLogger\GLogger;
use Chopper\Gear\Factory\Filter\IFilterFactory;
use Chopper\Gear\Filtration\Filtrator\Filtrator;

/**
 * Cleaner
 */
class Cleaner
{
    /**
     * Method filts file
     *
     * @param string         $path
     * @param string         $dest
     * @param IFilterFactory $factory
     *
     * @return bool
     */
    public function filtFile(string $path, string $dest, IFilterFactory $factory): bool
    {
        $filtrator = new Filtrator($factory, GLogger::getLogger());

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            file_put_contents(
                $dest,
                $filtrator->handle(
                    (new HttpDownloader(new CurlRequest(), GLogger::getLogFilePath()))->download($path)->getBody()
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
