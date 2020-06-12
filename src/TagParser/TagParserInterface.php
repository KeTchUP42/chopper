<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * TagParserInterface
 */
interface TagParserInterface
{
    /**
     * Method starts analysing tag struct
     *
     * @param string $data
     *
     * @return array
     */
    public function parseTagStruct(string $data): array;

    /**
     * Method returns array of strings between tags on needed deep level
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    public function parseDeepLvl(string $data, int $deepLvl): array;
}
