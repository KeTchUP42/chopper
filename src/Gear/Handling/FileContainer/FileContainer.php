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
    private $fileData;

    /**
     * Конструктор.
     *
     * @param string $filePath
     * @param string $fileData
     */
    public function __construct(string $filePath, string $fileData = '')
    {
        $this->filePath = $filePath;
        $this->fileData = $fileData;
    }

    /**
     * @inheritDoc
     */
    public function write(): bool
    {
        return (bool) file_put_contents($this->filePath, $this->fileData);
    }

    /**
     * @inheritDoc
     */
    public function read(): bool
    {
        $fileData = file_get_contents($this->filePath);
        if (!$fileData) {
            return false;
        }

        $this->fileData = $fileData;

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
     * Получить FileData
     *
     * @return string
     */
    public function getFileData(): string
    {
        return $this->fileData;
    }

    /**
     * Установка FileData.
     *
     * @param string $fileData
     *
     * @return FileContainer
     */
    public function setFileData(string $fileData): FileContainerInterface
    {
        $this->fileData = $fileData;

        return $this;
    }
}
