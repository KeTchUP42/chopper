<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command\CommandTraits;

use Chopper\App\Cleaner;
use Chopper\Component\Logger\GlobalLogger\Exception\GLoggerException;

/**
 * CleanerCommandTrait
 */
trait CleanerCommandTrait
{
    /**
     * Method clears html file and puts it to the dir
     *
     * @param string $path
     * @param string $dest
     * @param string $filterFactoryName
     *
     * @throws GLoggerException
     */
    public function clear(string $path, string $dest = null, string $filterFactoryName = null): void
    {
        $dest    = is_null($dest) ? uniqid('file', false) : basename($dest);
        $factory = null;
        if (!is_null($filterFactoryName)) {
            $filterFactoryName = "Chopper\Gear\Factory\Filter\\" . $filterFactoryName;
            $factory           = new $filterFactoryName();
        }
        $path = !filter_var($path, FILTER_VALIDATE_URL) ? $_ENV['MAIN_RESOURCES'] . $path : $path;

        (new Cleaner())->filtHtmlFile(
            $path,
            $_ENV['MAIN_RESOURCES'] . $dest,
            $factory
        );
    }
}
