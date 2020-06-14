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
     * Получить FileContents
     *
     * @return string
     */
    public function getFileContents(): string;

    /**
     * Установка FilePath.
     *
     * @param string $filePath
     *
     * @return FileContainer
     */
    public function setFilePath(string $filePath): FileContainerInterface;

    /**
     * Установка FileContents.
     *
     * @param string $fileContents
     *
     * @return FileContainer
     */
    public function setFileContents(string $fileContents): FileContainerInterface;

    /**
     * Method writes file contents to file
     */
    public function write(): bool;

    /**
     * Method reads file contents from file path
     */
    public function read(): bool;
}
