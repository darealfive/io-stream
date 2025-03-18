<?php
/**
 * InputFile class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\input;

use Darealfive\IoStream\exception\Exception;
use Darealfive\IoStream\filter\FilterableInterface;

/**
 * Class InputFile
 *
 * @package Darealfive\IoStream\input
 */
readonly abstract class InputFile extends Input
{
    /**
     * @throws Exception
     */
    public function __construct(public string $file, FilterableInterface ...$filters)
    {
        parent::__construct(...$filters);
        if (!is_file($file) || !is_readable($file)) {

            throw new Exception("Cannot read from file '$file'.");
        }
    }
}