<?php
/**
 * OutputFile class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\output;

use Darealfive\IoStream\exception\Exception;

/**
 * Class OutputFile
 *
 * @package Darealfive\IoStream\output
 */
readonly abstract class OutputFile extends Output
{
    /**
     * @throws Exception
     */
    public function __construct(public string $file)
    {
        if (file_exists($file)) {

            throw new Exception("Will not overwrite file '$file'.");
        }
        if (!is_writable(($directory = dirname(realpath($file))))) {

            throw new Exception("Cannot write into directory '$directory'.");
        }
    }
}