<?php
/**
 * StreamFile class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\input;

use Generator;

/**
 * Class StreamFile
 *
 * @package Darealfive\IoStream\input
 */
readonly class StreamFile extends InputFile
{
    /**
     * @param int|null  $offset
     * @param int|null  $limit
     * @param bool|null $filterEmpty
     *
     * @return Generator<string>
     */
    public function read(?int $offset = null, ?int $limit = null, ?bool $filterEmpty = null): Generator
    {
        try {

            $fileHandle = fopen($this->file, 'rb');
            yield from $this->streamInternal($fileHandle, $filterEmpty ?? true, $offset ?? 0, $limit);
        } finally {

            /*
             * Allows us to close the handle even if the caller has called “break” prematurely during the iteration.
             */
            fclose($fileHandle);
        }
    }
}