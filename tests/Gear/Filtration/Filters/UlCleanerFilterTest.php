<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\UlCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * UlCleanerFilterTest
 */
class UlCleanerFilterTest extends TestCase
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
        $this->filter = new UlCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/UITemplate.txt');
    }
}
