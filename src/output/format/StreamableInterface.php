<?php
/**
 * StreamableInterface
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

namespace Darealfive\IoStream\output\format;

/**
 * Interface StreamableInterface
 *
 * @package Darealfive\IoStream\output\format
 */
interface StreamableInterface
{
    public function stream(mixed $handle): int|false;
}