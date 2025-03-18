<?php
/**
 * Output class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output;

use Darealfive\IoStream\exception\InvalidArgumentException;
use Darealfive\IoStream\exception\RuntimeException;

/**
 * Class Output
 *
 * @package Darealfive\IoStream\output
 */
readonly abstract class Output implements WritableInterface
{
    /**
     * Implements basically the {@link WritableInterface::write()} interface to be used by child classes.
     *
     * @param iterable    $content the content to be written
     * @param mixed       $handle  a resource to write into
     * @param string|null $newLine a new-line character to be appended. <NULL> if no new-line should be added.
     *
     * @return int
     * @see WritableInterface::write() for documentation
     */
    public static function stream(iterable $content, mixed $handle, ?string $newLine): int
    {
        if (!is_resource($handle)) {
            throw new InvalidArgumentException("Argument 'handle' must be a resource, '" . gettype($handle) .
                                               "' given!");
        }

        $bytesWrittenTotal = 0;
        foreach ($content as $data) {

            $bytesWritten = fwrite($handle, "$data$newLine");
            if ($bytesWritten === false) {

                throw new RuntimeException("Could not write to handle after '$bytesWrittenTotal' written bytes!");
            }

            $bytesWrittenTotal += $bytesWritten;
        }

        return $bytesWrittenTotal;
    }
}