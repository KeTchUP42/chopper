<?php
declare(strict_types = 1);

namespace App\Tests\Gear\Filtration\Filters;

use App\Gear\Filtration\Filters\SvgCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * SvgCleanerFilterTest
 */
class SvgCleanerFilterTest extends TestCase
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
        $this->filter = new SvgCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/SvgTemplate.txt');
    }
}
