<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\ScriptCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * ScriptCleanerFilterTest
 */
class ScriptCleanerFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle(): void
    {
        $result = $this->filter->handle($this->data);
        static::assertEmpty($result);
    }

    protected function setUp(): void
    {
        $this->filter = new ScriptCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/ScriptTemplate.txt');
    }
}
