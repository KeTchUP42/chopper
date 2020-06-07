<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\StyleCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * StyleCleanerFilterTest
 */
class StyleCleanerFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle()
    {
        $result = $this->filter->handle($this->data);
        static::assertEmpty($result);
    }

    protected function setUp(): void
    {
        $this->filter = new StyleCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/StyleTemplate.txt');
    }
}
