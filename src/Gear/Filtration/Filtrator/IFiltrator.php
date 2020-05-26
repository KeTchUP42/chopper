<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Factory\Filter\IFilterFactory;

/**
 * IFiltrator
 */
interface IFiltrator
{
    /**
     * Установка Factory.
     *
     * @param IFilterFactory $factory
     *
     * @return Filtrator
     */
    public function setFactory(IFilterFactory $factory): Filtrator;

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
