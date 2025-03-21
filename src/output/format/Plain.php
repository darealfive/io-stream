<?php
/**
 * Plain class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output\format;

/**
 * Class Plain
 *
 * @package Darealfive\IoStream\output\format
 */
class Plain implements StreamableInterface
{
    public function __construct(public ?int $length = null, public ?string $eol = PHP_EOL)
    {
    }

    public function stream(mixed $handle, mixed $data): int|false
    {
        return fwrite($handle, "$data$this->eol", $this->length);
    }
}