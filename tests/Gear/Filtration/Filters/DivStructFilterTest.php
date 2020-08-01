<?php
declare(strict_types = 1);

namespace App\Tests\Gear\Filtration\Filters;

use App\Gear\Filtration\Filters\DivStructFilter;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * DivStructFilterTest
 */
class DivStructFilterTest extends TestCase
{
    private $filter;

    private $data;

    private $expected;

    public function testHandle(): void
    {
        $result = $this->filter->handle($this->data);
        static::assertSame($this->expected, $result);
    }

    protected function setUp(): void
    {
        $this->filter   = new DivStructFilter();
        $this->data     = file_get_contents(__DIR__.'/Templates/DivStructPageTemplate.txt');
        $this->expected = file_get_contents(__DIR__.'/Templates/DivStructTemplate.txt');
    }
}
