<?php
/**
 * StreamStdout class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output;

use Darealfive\IoStream\output\format\Plain;
use Darealfive\IoStream\output\format\StreamableInterface;

/**
 * Class StreamStdout
 *
 * @package Darealfive\IoStream\output
 */
readonly class StreamStdout extends Output
{
    public function __construct(StreamableInterface $streamable = new Plain())
    {
        parent::__construct($streamable);
    }

    public function write(iterable $content): int
    {
        return $this->_write($content, STDOUT);
    }
}