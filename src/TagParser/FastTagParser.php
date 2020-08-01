<?php
declare(strict_types = 1);

namespace App\TagParser;

use App\Exceptions\RuntimeException;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * This class has faster algorithm but tag case matters
 */
class FastTagParser extends AbstractTagParser
{
    /**
     * @inheritDoc
     */
    protected function configure(string $openTag, string $closeTag)
    {
        if ($openTag === $closeTag) {
            throw new RuntimeException(sprintf("Tags %s and %s are identical.", $openTag, $closeTag));
        }
        parent::configure($openTag, $closeTag);
    }

    /**
     * Method returns an array of strings between tags at the required level of nesting
     *
     * @param string $data
     * @param int    $depthLvl
     *
     * @return array
     */
    public function parseDepthLvl(string $data, int $depthLvl): array
    {
        if ($depthLvl <= 0) {
            return [$data];
        }

        $dataMaxLen       = strlen($data);
        $result           = [];
        $resultIndex      = -1;
        $currentDepthtLvl = 0;

        $openTagLen  = strlen($this->openTag);
        $closeTagLen = strlen($this->closeTag);

        $openTagId  = 0;
        $closeTagId = 0;

        for ($index = 0; $index < $dataMaxLen; $index++, $openTagId = 0, $closeTagId = 0) {

            while (($index + $openTagId < $dataMaxLen) && ($openTagId < $openTagLen)
                && ($data[$index + $openTagId] === $this->openTag[$openTagId])) {
                $openTagId++;
            }
            if ($openTagId === $openTagLen) {
                $currentDepthtLvl++;
                if ($currentDepthtLvl === $depthLvl) {
                    $resultIndex++;
                    $result[] .= $this->openTag;
                    $index    += $openTagLen - 1;
                    continue;
                }
            }

            while (($index + $closeTagId < $dataMaxLen) && ($closeTagId < $closeTagLen)
                && ($data[$index + $closeTagId] === $this->closeTag[$closeTagId])) {
                $closeTagId++;
            }
            if ($closeTagId === $closeTagLen) {
                $currentDepthtLvl--;
                if ($currentDepthtLvl + 1 === $depthLvl) {
                    $result[$resultIndex] .= $this->closeTag;
                    $index                += $closeTagLen - 1;
                    continue;
                }
            }

            if ($currentDepthtLvl >= $depthLvl) {
                $result[$resultIndex] .= $data[$index];
            }
        }

        return $result;
    }
}
