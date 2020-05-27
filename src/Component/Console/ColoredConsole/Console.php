<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\ColoredConsole;

use Chopper\Component\Traits\ClosedConstructorTrait;

/**
 * Console
 */
final class Console
{
    use ClosedConstructorTrait;

    public const BLACK     = 'black';
    public const RED       = 'red';
    public const GREEN     = 'green';
    public const YELLOW    = 'yellow';
    public const DARK_BLUE = 'dark blue';
    public const PURPLE    = 'purple';
    public const BLUE      = 'blue';
    public const WHITE     = 'white';

    /**
     * @var string
     */
    private static $resetCode = "\e[0m";

    /**
     * @var string[]
     */
    private $colors = [
        'black'     => "\x1b[30",
        'red'       => "\x1b[31",
        'green'     => "\x1b[32",
        'yellow'    => "\x1b[33",
        'dark blue' => "\x1b[34",
        'purple'    => "\x1b[35",
        'blue'      => "\x1b[36",
        'white'     => "\x1b[37",
    ];

    /**
     * @var string[]
     */
    private $bgcolors = [
        'black'     => ";40",
        'red'       => ";41",
        'green'     => ";42",
        'yellow'    => ";43",
        'dark blue' => ";44",
        'purple'    => ";45",
        'blue'      => ";46",
        'white'     => ";47",
    ];

    /**
     * @var
     */
    private $color = "\x1b[30";

    /**
     * @var string
     */
    private $bgcolor = "";

    /**
     * Entry point method
     *
     * @return static
     */
    public static function out(): self
    {
        return new self();
    }

    /**
     * Установка ResetCode.
     *
     * @param string $resetCode
     *
     */
    public static function setResetCode(string $resetCode): void
    {
        self::$resetCode = $resetCode;
    }

    /**
     * Method configures text color
     *
     * @param string $color
     *
     * @return $this
     */
    public function color(string $color): self
    {
        $this->color = $this->colors[$color] ?? $this->colors[self::BLACK];

        return $this;
    }

    /**
     * Method configures back ground color
     *
     * @param string $color
     *
     * @return $this
     */
    public function bgcolor(string $color): self
    {
        $this->bgcolor = $this->bgcolors[$color] ?? '';

        return $this;
    }

    /**
     * Method writes message
     *
     * @param string $message
     */
    public function writeln(string $message): void
    {
        $this->write($message);
        echo "\n";
    }

    /**
     * Method writes message
     *
     * @param string $message
     */
    public function write(string $message): void
    {
        echo $this->colorPrefix().$message;
        echo self::$resetCode;
    }

    /**
     * Method returns color console code
     *
     * @return string
     */
    private function colorPrefix(): string
    {
        return $this->color.$this->bgcolor."m";
    }
}
