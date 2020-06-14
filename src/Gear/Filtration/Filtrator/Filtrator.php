<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Filtration\FilterCell\FilterCellInterface;
use Zend\Log\LoggerInterface;

/**
 * Filtrator
 */
class Filtrator implements FiltratorInterface
{
    /**
     * @var FilterCellInterface
     */
    protected $filterCell;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Конструктор.
     *
     * @param FilterCellInterface $filterCell
     * @param LoggerInterface     $logger
     */
    public function __construct(FilterCellInterface $filterCell, LoggerInterface $logger)
    {
        $this->filterCell = $filterCell;
        $this->logger     = $logger;
    }

    /**
     * Установка FilterCell.
     *
     * @param FilterCellInterface $filterCell
     *
     * @return FiltratorInterface
     */
    public function setFilterCell(FilterCellInterface $filterCell): FiltratorInterface
    {
        $this->filterCell = $filterCell;

        return $this;
    }

    /**
     * Method starts handling
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $this->logger->info(sprintf("%s is calling %s handle method.", self::class, get_class($this->filterCell)));
        $this->logger->info(sprintf("%s is calling filter's handle method.", get_class($this->filterCell)));
        try {
            $data = $this->filterCell->handle($data);
            $this->logger->info(sprintf('Success!'));
        } catch (\Exception $exception) {
            $this->logger->err(sprintf('Error! %s', $exception->getMessage()));
        }

        return $data;
    }
}

