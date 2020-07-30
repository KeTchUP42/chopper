<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
     * Method returns an array of strings between tags at the required level of nesting
     *
     * @param string $data
     * @param int    $depthLvl
     *
     * @return array
     */
    public function parseDepthLvl(string $data, int $depthLvl): array;
}
