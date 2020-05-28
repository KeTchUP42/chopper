<?php
declare(strict_types = 1);

namespace Chopper\Component\Tag;

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
        $this->tagCheck($openTag, $closeTag);
        parent::__construct($openTag, $closeTag);
    }

    /**
     * Base tag validation
     *
     * @param string $openTag
     * @param string $closeTag
     */
    protected function tagCheck(string $openTag, string $closeTag): void
    {
        if ($openTag === $closeTag) {
            throw new \RuntimeException(sprintf('Tags %s and %s can not be same', $openTag, $closeTag));
        }
    }

    /**
     * Method returns array of content between tags on needed deep level
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    public function parseDeepLvl(string $data, int $deepLvl): array
    {
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
                if ($currentDeeptLvl === $deepLvl) {
                    $result[$resultIndex] .= $this->closeTag;
                }
                $currentDeeptLvl--;
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
     * Method returns array of content between tags on needed deep level
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    public function parseDeepLvlNoCase(string $data, int $deepLvl): array
    {
        $dataMaxLen      = strlen($data);
        $result          = [];
        $resultIndex     = -1;
        $currentDeeptLvl = 0;

        for ($index = 0; $index < $dataMaxLen; $index++) {

            if (strtolower(substr($data, $index, strlen($this->openTag))) === strtolower($this->openTag)) {
                $currentDeeptLvl++;
                if ($currentDeeptLvl === $deepLvl) {
                    $resultIndex++;
                }
            }

            if (strtolower(substr($data, $index, strlen($this->closeTag))) === strtolower($this->closeTag)) {
                if ($currentDeeptLvl === $deepLvl) {
                    $result[$resultIndex] .= substr($data, $index, strlen($this->closeTag));
                }
                $currentDeeptLvl--;
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
