<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filtrator;

use Chopper\Gear\Factory\Filter\IFilterFactory;
use Zend\Log\LoggerInterface;

/**
 * Filtrator
 */
class Filtrator implements IFiltrator
{
    /**
     * @var IFilterFactory
     */
    protected $factory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Конструктор.
     *
     * @param IFilterFactory  $factory
     * @param LoggerInterface $logger
     */
    public function __construct(IFilterFactory $factory, LoggerInterface $logger)
    {
        $this->factory = $factory;
        $this->logger  = $logger;
    }

    /**
     * Установка Factory.
     *
     * @param IFilterFactory $factory
     *
     * @return Filtrator
     */
    public function setFactory(IFilterFactory $factory): Filtrator
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        $this->logger->info(sprintf("%s is creating filter with %s.", self::class, get_class($this->factory)));
        $this->logger->info(sprintf("%s is calling filter's handle method.", self::class));
        try {
            $data = $this->factory->createFilter()->handle($data);
            $this->logger->info(sprintf('Success!'));
        } catch (\Exception $exception) {
            $this->logger->err(sprintf('Error! %s', $exception->getMessage()));
        }

        return $data;
    }
}

