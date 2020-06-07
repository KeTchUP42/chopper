<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FormCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * FormCleanerFilterTest
 */
class FormCleanerFilterTest extends TestCase
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
        $this->filter = new FormCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/FormTemplate.txt');
    }
}
