<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\Wrapper;

/**
 * WrapperInterface
 *
 * Classes wraps data with something.
 */
interface WrapperInterface
{
    /**
     * Base wrap method
     *
     * @param string $data
     *
     * @return string
     */
    public function wrap(string $data): string;
}
