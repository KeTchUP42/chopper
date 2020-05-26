<?php
declare(strict_types = 1);

namespace Chopper\App;

use Chopper\Component\Curl\CurlRequest;
use Chopper\Component\Downloader\HttpDownloader;
use Chopper\Component\Logger\GlobalLogger\Exception\GLoggerException as GLoggerExceptionAlias;
use Chopper\Component\Logger\GlobalLogger\GLogger;
use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Factory\Filter\IFilterFactory;
use Chopper\Gear\Filtration\Filtrator\Filtrator;

/**
 * Cleaner
 */
class Cleaner
{
    /**
     * Method filts main file
     *
     * @param string              $path
     *
     * @param string              $dest
     *
     * @param IFilterFactory|null $factory
     *
     * @return bool
     * @throws GLoggerExceptionAlias
     */
    public function filtHtmlFile(string $path, string $dest, IFilterFactory $factory = null): bool
    {
        $filtrator = new Filtrator(($factory ?? (new BaseFilterFactory()))->createFilter(), GLogger::getLogger());

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            file_put_contents(
                $dest,
                $filtrator->handle(
                    (new HttpDownloader(new CurlRequest(), GLogger::getLogFilePath()))->download($path)['body']
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
