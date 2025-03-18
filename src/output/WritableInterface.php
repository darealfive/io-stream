<?php
/**
 * WritableInterface
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

namespace Darealfive\IoStream\output;

/**
 * Interface WritableInterface
 *
 * @package Darealfive\IoStream\output
 */
interface WritableInterface
{
    /**
     * @param iterable $content the content to be written
     *
     * @return int number of bytes written
     */
    public function write(iterable $content, ?string $newLine = PHP_EOL): int;
}