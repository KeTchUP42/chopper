<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * AbstractTagParser
 */
abstract class AbstractTagParser implements TagParserInterface
{
    /**
     * @var string
     */
    protected $openTag;

    /**
     * @var string
     */
    protected $closeTag;

    /**
     * Конструктор.
     *
     * @param string $openTag
     * @param string $closeTag
     */
    public function __construct(string $openTag, string $closeTag)
    {
        $this->openTag  = $openTag;
        $this->closeTag = $closeTag;
    }

    /**
     * Method starts analysing tag struct
     *
     * @param string $data
     *
     * @return array
     */
    public function parseTagStruct(string $data): array
    {
        return $this->rhandle($this->parseDeepLvlNoCase($data, 1));
    }

    /**
     * Method analysing tag struct and searches content between tags recursive
     *
     * @param array $tagData
     *
     * @return array
     */
    protected function rhandle(array $tagData): array
    {
        $result = [];
        foreach ($tagData as $value) {
            $blocks = $this->parseDeepLvlNoCase($value, 2);
            if (empty($blocks)) {
                $result[] = $value;
            }
            else {
                $result[$value] = $this->rhandle($blocks);
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
    abstract public function parseDeepLvlNoCase(string $data, int $deepLvl): array;

    /**
     * Method returns array of strings between tags on needed deep level
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    abstract public function parseDeepLvl(string $data, int $deepLvl): array;
}
