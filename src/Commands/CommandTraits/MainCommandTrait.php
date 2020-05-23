<?php
declare(strict_types = 1);

namespace Chopper\Commands\CommandTraits;

use Chopper\App\Mixer;
use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Filtration\Filtrator\Filtrator;
use Chopper\Tools\ColoredConsole\Console;
use Chopper\Tools\GLogger\GLogger;

/**
 * MainCommandTrait
 */
trait MainCommandTrait
{
    /**
     * Method calls mixToFile method
     */
    private function mixtf(): void
    {
        (new Mixer())->mixToFile();
    }

    /**
     * Method calls mix method
     *
     * @return string
     */
    private function mix(): string
    {
        return (new Mixer())->mix();
    }

    /**
     * Makes page temlates
     *
     * @param string $url
     */
    private function page(string $url): void //todo Добавить нормальную структуру c Curl!!!
    {
        $filterMachine = new Filtrator((new BaseFilterFactory())->createFilter(), GLogger::getLogger());

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $fileName = $_ENV['TEMPLATES'] . str_replace(['/', 'https:', 'http:'], '', $url);
            file_put_contents($fileName, $filterMachine->handle(file_get_contents($url)));
        }
        else {
            $tempName = $_ENV['HTML_RESOURCES'] . $url;
            if (!file_exists($tempName)) {
                Console::out()->color(Console::RED)->writeln("Err");

                return;
            }
            file_put_contents($_ENV['TEMPLATES'] . $url, $filterMachine->handle(file_get_contents($tempName)));
        }
        Console::out()->color(Console::GREEN)->writeln('DONE!');
    }
}
