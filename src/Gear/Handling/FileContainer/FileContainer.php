<?php
declare(strict_types = 1);

namespace App\Gear\Handling\FileContainer;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * FileContainer
 */
class FileContainer implements FileContainerInterface
{
    /**
     * @var \SplFileObject
     */
    private $fileObject;

    /**
     * Конструктор.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->fileObject = new \SplFileObject($filePath);
    }

    /**
     * @inheritDoc
     */
    public function write(string $fileData): bool
    {
        return (bool) file_put_contents($this->fileObject->getPathname(), $fileData);
    }

    /**
     * @inheritDoc
     */
    public function read(): string
    {
        return file_get_contents($this->fileObject->getPathname());
    }

    /**
     * Method returns file object
     *
     * @return \SplFileObject
     */
    public function getFileObject(): \SplFileObject
    {
        return $this->fileObject;
    }

    /**
     * Получить FilePath
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->fileObject->getPathname();
    }

    /**
     * Получить FileName
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileObject->getFilename();
    }
}
