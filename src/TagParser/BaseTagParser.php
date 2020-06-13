<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * BaseTagParser
 */
class BaseTagParser extends AbstractTagParser
{
    /**
     * Method returns an array of strings between tags at the required level of nesting without case difference
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    public function parseDeepLvl(string $data, int $deepLvl): array
    {
        if ($deepLvl <= 0) {
            return [$data];
        }

        if ($this->openTag === $this->closeTag) {
            return [];
        }

        $dataMaxLen      = strlen($data);
        $result          = [];
        $resultIndex     = -1;
        $currentDeeptLvl = 0;

        for ($index = 0; $index < $dataMaxLen; $index++) {

            if (strcasecmp(substr($data, $index, strlen($this->openTag)), $this->openTag) === 0) {
                $currentDeeptLvl++;
                if ($currentDeeptLvl === $deepLvl) {
                    $resultIndex++;
                    $result[] .= substr($data, $index, strlen($this->openTag));
                    $index    += strlen($this->openTag) - 1;
                    continue;
                }
            }

            if (strcasecmp(substr($data, $index, strlen($this->closeTag)), $this->closeTag) === 0) {
                $currentDeeptLvl--;
                if ($currentDeeptLvl + 1 === $deepLvl) {
                    $result[$resultIndex] .= substr($data, $index, strlen($this->closeTag));
                    $index                += strlen($this->closeTag) - 1;
                    continue;
                }
            }

            if ($currentDeeptLvl >= $deepLvl) {
                $result[$resultIndex] .= $data[$index];
            }
        }

        return $result;
    }
}
