<?php
/**
 * StreamStdout class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output;

/**
 * Class StreamStdout
 *
 * @package Darealfive\IoStream\output
 */
readonly class StreamStdout extends Output
{
    public function write(iterable|string $content, ?string $newLine = PHP_EOL): int
    {
        return Output::stream(is_string($content) ? [$content] : $content, STDOUT, $newLine);
    }
}