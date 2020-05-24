<?php
declare(strict_types = 1);

namespace Chopper\App;

use Chopper\Component\Downloader\PageDownloader;
use Chopper\Component\Logger\GlobalLogger\Exception\GLoggerException as GLoggerExceptionAlias;
use Chopper\Component\Logger\GlobalLogger\GLogger;
use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Filtration\Filtrator\Filtrator;

/**
 * Cleaner
 */
class Cleaner
{
    /**
     * Method filts html file
     *
     * @param string $path
     *
     * @param string $dest
     *
     * @return bool
     * @throws GLoggerExceptionAlias
     */
    public function filtHtmlFile(string $path, string $dest): bool
    {
        $filtrator = new Filtrator((new BaseFilterFactory())->createFilter(), GLogger::getLogger());
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            file_put_contents($dest, $filtrator->handle((new PageDownloader())->download($path)));

            return true;
        }
        if (file_exists($path) && is_readable($path)) {
            file_put_contents($dest, $filtrator->handle(file_get_contents($path)));

            return true;
        }

        return false;
    }
}
