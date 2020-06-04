<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Factory\Filter\FilterFactoryInterface;

/**
 * FiltratorInterface
 */
interface FiltratorInterface
{
    /**
     * Установка Factory.
     *
     * @param FilterFactoryInterface $factory
     *
     * @return Filtrator
     */
    public function setFactory(FilterFactoryInterface $factory): Filtrator;

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
