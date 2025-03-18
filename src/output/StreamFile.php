<?php
/**
 * StreamFile class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output;

/**
 * Class StreamFile
 *
 * @package Darealfive\IoStream\output
 */
readonly class StreamFile extends OutputFile
{
    public function write(iterable $content): int
    {
        return $this->_write($content, fopen($this->file, 'x'));
    }
}