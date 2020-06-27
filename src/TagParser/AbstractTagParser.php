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
        return $this->rhandle($this->parseDeepLvl($data, 1));
    }

    /**
     * Method analyses struct of tags and recursively searches for content between tags
     *
     * @param array $tagdata
     *
     * @return array
     */
    protected function rhandle(array $tagdata): array
    {
        $result = [];
        foreach ($tagdata as $value) {
            $blocks = $this->parseDeepLvl($value, 2);
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
     * @inheritDoc
     */
    abstract public function parseDeepLvl(string $data, int $deepLvl): array;
}
