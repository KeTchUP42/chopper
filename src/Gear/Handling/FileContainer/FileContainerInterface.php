<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\FileContainer;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * FileContainerInterface
 */
interface FileContainerInterface
{
    /**
     * Method writes file contents to file
     *
     * @param string $fileData
     *
     * @return bool
     */
    public function write(string $fileData): bool;

    /**
     * Method reads file contents from file path
     *
     * @return string
     */
    public function read(): string;

    /**
     * Method returns file object
     *
     * @return \SplFileObject
     */
    public function getFileObject(): \SplFileObject;

    /**
     * Получить FilePath
     *
     * @return string
     */
    public function getFilePath(): string;

    /**
     * Получить FileName
     *
     * @return string
     */
    public function getFileName(): string;
}
