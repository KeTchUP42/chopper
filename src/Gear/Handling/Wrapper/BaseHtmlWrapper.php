<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\Wrapper;

/**
 * BaseHtmlWrapper
 */
class BaseHtmlWrapper implements WrapperInterface
{
    /**
     * Result wrap
     */
    private const HTML_WRAP_1 = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n<meta charset=\"UTF-8\">\n<title>Result</title>\n</head>\n<body>\n";
    private const HTML_WRAP_2 = "\n</body>\n</html>";

    /**
     * @inheritDoc
     */
    public function wrap(string $data): string
    {
        return self::HTML_WRAP_1.$data.self::HTML_WRAP_2;
    }
}
