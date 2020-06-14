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
     * @var string
     */
    private $fileContents;

    /**
     * Конструктор.
     *
     * @param string $filePath
     * @param string $fileContents
     */
    public function __construct(string $filePath, string $fileContents = '')
    {
        $this->filePath     = $filePath;
        $this->fileContents = $fileContents;
    }

    /**
     * @inheritDoc
     */
    public function write(): bool
    {
        return (bool) file_put_contents($this->filePath, $this->fileContents);
    }

    /**
     * @inheritDoc
     */
    public function read(): bool
    {
        $fileContents = file_get_contents($this->filePath);
        if (is_bool($fileContents)) {
            return false;
        }

        $this->fileContents = $fileContents;

        return true;
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
     * Установка FilePath.
     *
     * @param string $filePath
     *
     * @return FileContainer
     */
    public function setFilePath(string $filePath): FileContainerInterface
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Получить FileContents
     *
     * @return string
     */
    public function getFileContents(): string
    {
        return $this->fileContents;
    }

    /**
     * Установка FileContents.
     *
     * @param string $fileContents
     *
     * @return FileContainer
     */
    public function setFileContents(string $fileContents): FileContainerInterface
    {
        $this->fileContents = $fileContents;

        return $this;
    }
}
