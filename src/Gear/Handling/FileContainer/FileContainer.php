<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\FileContainer;

/**
 * FileContainer
 */
class FileContainer implements FileContainerInterface
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * Конструктор.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @inheritDoc
     */
    public function write(string $fileData): bool
    {
        return (bool) file_put_contents($this->filePath, $fileData);
    }

    /**
     * @inheritDoc
     */
    public function read(): string
    {
        return file_get_contents($this->filePath);
    }

    /**
     * Получить FilePath
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * Получить FileName
     *
     * @return string
     */
    public function getFileName(): string
    {
        return basename($this->filePath);
    }
}
