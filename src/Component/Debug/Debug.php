<?php
declare(strict_types = 1);

namespace Chopper\Component\Debug;

/**
 * Registers all the debug tools.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Debug
{
    /**
     * Method enables php to catch errors
     */
    public static function enable(): void
    {
        error_reporting(-1);

        if (!\in_array(\PHP_SAPI, ['cli', 'phpdbg'], true)) {
            ini_set('display_errors', 0);
        }
        elseif (!filter_var(ini_get('log_errors'), FILTER_VALIDATE_BOOLEAN)) {
            ini_set('display_errors', 1);
        }
        ini_set('display_startup_errors', '1');
        ini_set('assert.active', '1');
        ini_set('assert.warning', '0');
        ini_set('assert.exception', '1');
    }
}
