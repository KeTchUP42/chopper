<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * TagParser
 */
class BaseTagParser extends TagParser
{
    /**
     * Конструктор.
     *
     * @param string $openTag
     * @param string $closeTag
     */
    public function __construct(string $openTag, string $closeTag)
    {
        $this->tagValidation($openTag, $closeTag);
        parent::__construct($openTag, $closeTag);
    }

    /**
     * Base tag validation
     *
     * @param string $openTag
     * @param string $closeTag
     */
    protected function tagValidation(string $openTag, string $closeTag): void
    {
        if ($openTag === $closeTag) {
            throw new \RuntimeException(sprintf('Tags can\'t be same'));
        }
    }

    /**
     * Method returns array of strings between tags on needed deep level
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
        $dataMaxLen      = strlen($data);
        $result          = [];
        $resultIndex     = -1;
        $currentDeeptLvl = 0;

        for ($index = 0; $index < $dataMaxLen; $index++) {

            if (substr($data, $index, strlen($this->openTag)) === $this->openTag) {
                $currentDeeptLvl++;
                if ($currentDeeptLvl === $deepLvl) {
                    $resultIndex++;
                }
            }

            if (substr($data, $index, strlen($this->closeTag)) === $this->closeTag) {
                $currentDeeptLvl--;
                if ($currentDeeptLvl + 1 === $deepLvl) {
                    $result[$resultIndex] .= $this->closeTag;
                    $index                += strlen($this->closeTag) - 1;
                    continue;
                }
            }

            if ($currentDeeptLvl >= $deepLvl) {
                if (isset($result[$resultIndex])) {
                    $result[$resultIndex] .= $data[$index];
                }
                else {
                    $result[] = $data[$index];
                }
            }
        }

        return $result;
    }

    /**
     * Method returns array of strings between tags on needed deep level
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    public function parseDeepLvlNoCase(string $data, int $deepLvl): array
    {
        if ($deepLvl <= 0) {
            return [$data];
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
                if (isset($result[$resultIndex])) {
                    $result[$resultIndex] .= $data[$index];
                }
                else {
                    $result[] = $data[$index];
                }
            }
        }

        return $result;
    }
}
