<?php
declare(strict_types = 1);

namespace Chopper\Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\BaseFilter\Filter;

/**
 * DivSearchFilter
 */
class DivSearchFilter extends Filter
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string
    {
        return parent::handle($this->divHandle($data));
    }

    /**
     * Method starts handling
     *
     * @param string $data
     *
     * @return string
     */
    private function divHandle(string $data): string
    {
        $divarr = [];
        preg_match_all("~<div[^>]*?>.*?</div>~si", $data, $divarr); //todo test and rewrite
        $result = $this->rhandle($divarr[0]);

        return $this->array_implode("\n\n@@@@@\n\n", $result);
    }

    /**
     * Method searches div tags between main div tags recursive
     *
     * @param array $data
     *
     * @return array
     */
    private function rhandle(array $data): array
    {
        $result = [];
        foreach ($data as $value) {
            $blocks = [];
            preg_match_all("~<div[^>]*?>.*?</div>~si", $this->divCut($value), $blocks); //todo test and rewrite
            if (empty($blocks[0])) {
                $result[] = $value;
            }
            else {
                $result[$value] = $this->rhandle($blocks[0]);
            }
        }

        return $result;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    private function divCut(string $data): string
    {
        $data = mb_substr($data, mb_strpos('<div', $data) + 4);
        $data = mb_substr($data, 0, mb_strrpos($data, '/div>'));

        return $data;
    }

    /**
     * Method implodes array recursive
     *
     * @param string $glue
     * @param array  $array
     *
     * @return string
     */
    private function array_implode(string $glue, array $array): string
    {
        $result = '';
        foreach ($array as $value) {
            if (is_array($value)) {
                $result .= $this->array_implode($glue, $value);
            }
            else {
                $result .= $value.$glue;
            }
        }

        return $result;
    }
}
