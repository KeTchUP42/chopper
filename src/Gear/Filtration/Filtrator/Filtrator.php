<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Filtration\Filters\BaseFilter\IFilter;
use Zend\Log\LoggerInterface;

/**
 * Filtrator
 */
class Filtrator implements IFiltrator
{
    /**
     * @var IFilter
     */
    protected $filter;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Конструктор.
     *
     * @param IFilter         $filter
     * @param LoggerInterface $logger
     */
    public function __construct(IFilter $filter, LoggerInterface $logger)
    {
        $this->filter = $filter;
        $this->logger = $logger;
    }

    /**
     *
     * @param IFilter $filter
     *
     * @return $this|IFiltrator
     */
    public function setFilter(IFilter $filter): IFiltrator
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $this->logger->info(
            sprintf(
                'Filtrator is calling filter %s handle method.',
                get_class($this->filter)
            )
        );
        try {
            $data = $this->filter->handle($data);
            $this->logger->info(sprintf('Success!'));
        } catch (\Exception $exception) {
            $this->logger->err(sprintf('Error! %s', $exception->getMessage()));
        }

        return $data;
    }
}

