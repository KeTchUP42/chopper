<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\FileContainer;

/**
 * FileContainerInterface
 */
interface FileContainerInterface
{
    /**
     * Получить FilePath
     *
     * @return string
     */
    public function getFilePath(): string;

    /**
     * Получить FileData
     *
     * @return string
     */
    public function getFileData(): string;

    /**
     * Установка FilePath.
     *
     * @param string $filePath
     *
     * @return FileContainer
     */
    public function setFilePath(string $filePath): FileContainerInterface;

    /**
     * Установка FileData.
     *
     * @param string $fileData
     *
     * @return FileContainer
     */
    public function setFileData(string $fileData): FileContainerInterface;

    /**
     * Method writes file contents to file
     */
    public function write(): bool;

    /**
     * Method reads file contents from file path
     */
    public function read(): bool;
}
