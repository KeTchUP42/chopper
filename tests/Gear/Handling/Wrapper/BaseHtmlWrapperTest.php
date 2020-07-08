<?php
declare(strict_types = 1);

namespace Gear\Handling\Wrapper;

use Chopper\Gear\Handling\Wrapper\BaseHtmlWrapper;
use PHPUnit\Framework\TestCase;

/**
 * BaseHtmlWrapperTest
 */
class BaseHtmlWrapperTest extends TestCase
{
    private $expected;

    private $wrapper;

    public function testWrap(): void
    {
        $result = $this->wrapper->wrap('');
        static::assertSame($this->expected, $result);
    }

    protected function setUp(): void
    {
        $this->expected = file_get_contents(__DIR__.'/Templates/BaseHtmlWrap.txt');
        $this->wrapper  = new BaseHtmlWrapper();
    }
}
