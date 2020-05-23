<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;

/**
 * IFiltrator
 */
interface IFiltrator
{
    /**
     * @param IFilter $filter
     *
     * @return IFiltrator
     */
    public function setFilter(IFilter $filter): IFiltrator;

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
