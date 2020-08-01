<?php
declare(strict_types = 1);

namespace App\Traits;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * ClosedConstructorTrait
 */
trait ClosedConstructorTrait
{
    /**
     * Конструктор.
     */
    protected function __construct()
    {
    }
}
