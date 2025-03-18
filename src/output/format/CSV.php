<?php
/**
 * CSV class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output\format;

/**
 * Class CSV
 *
 * @package Darealfive\IoStream\output\format
 */
readonly class CSV implements StreamableInterface
{
    public function __construct(public string $separator = ",",
                                public string $enclosure = '"',
                                public string $escape = "\\",
                                public string $eol = PHP_EOL)
    {
    }

    public function stream(mixed $handle, array $data = []): int|false
    {
        return fputcsv($handle, $data, $this->separator, $this->enclosure, $this->escape, $this->eol);
    }
}