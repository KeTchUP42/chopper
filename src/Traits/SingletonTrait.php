<?php
declare(strict_types = 1);

namespace Chopper\Traits;

/**
 * SingletonTrait
 */
trait SingletonTrait
{
    /**
     * Конструктор.
     */
    protected function __construct()
    {
    }

    /**
     * Closed __wakeup method
     */
    protected function __wakeup()
    {
    }
}
