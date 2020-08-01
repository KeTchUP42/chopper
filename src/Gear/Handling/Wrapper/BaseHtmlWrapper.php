<?php
declare(strict_types = 1);

namespace App\Gear\Handling\Wrapper;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * BaseHtmlWrapper
 */
class BaseHtmlWrapper implements WrapperInterface
{
    /**
     * Result wrap
     */
    private $htmlHeader;

    private $htmlFooter;

    /**
     * Конструктор.
     */
    public function __construct()
    {
        $this->configure();
    }

    /**
     * BaseHtmlWrapper configuring data from template files
     */
    private function configure(): void
    {
        $this->htmlHeader = file_get_contents(__DIR__.'/Templates/BaseHtmlWrapper/BasePageHeader.txt');
        $this->htmlFooter = file_get_contents(__DIR__.'/Templates/BaseHtmlWrapper/BasePageFooter.txt');
    }

    /**
     * @inheritDoc
     */
    public function wrap(string $data): string
    {
        return $this->htmlHeader.$data.$this->htmlFooter;
    }
}
