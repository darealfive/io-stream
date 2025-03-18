<?php
/**
 * StreamStdin class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\input;

use Generator;

/**
 * Class StreamStdin reads from STDIN
 *
 * @package Darealfive\IoStream\input
 */
readonly class StreamStdin extends Input
{
    public function read(int $offset = null, int $limit = null, bool $filterEmpty = null): Generator
    {
        yield from $this->streamInternal(STDIN, $filterEmpty ?? true, $offset ?? 0, $limit);
    }
}