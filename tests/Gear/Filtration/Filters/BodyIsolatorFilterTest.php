<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BodyIsolatorFilter;
use PHPUnit\Framework\TestCase;

/**
 * BodyIsolatorFilterTest
 */
class BodyIsolatorFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle(): void
    {
        $result = $this->filter->handle($this->data);
        static::assertSame('<body>Content: Test </body>', $result);
    }

    protected function setUp(): void
    {
        $this->filter = new BodyIsolatorFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/BodyTemplate.txt');
    }
}
