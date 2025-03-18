<?php
/**
 * Input class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\input;

use Darealfive\IoStream\exception\DomainException;
use Darealfive\IoStream\exception\InvalidArgumentException;
use Darealfive\IoStream\filter\FilterableInterface;
use Darealfive\IoStream\filter\whitespace\WhitespaceFilter;
use Darealfive\IoStream\filter\whitespace\WhitespaceFilterType;
use Generator;

/**
 * Class Input
 *
 * @package Darealfive\IoStream\input
 */
readonly abstract class Input implements ReadableInterface
{
    /**
     * @var FilterableInterface[]
     */
    public array $filters;

    /**
     * @param FilterableInterface ...$filters list of filters to be applied on each line
     */
    public function __construct(FilterableInterface ...$filters)
    {
        $this->filters = $filters;
    }

    /**
     * Applies configured filters to the stream.
     *
     * @param mixed    $handle
     * @param bool     $filterEmpty
     * @param int      $offset
     * @param int|null $count
     *
     * @return Generator
     * @see self::stream() for documentation
     */
    protected function streamInternal(mixed $handle, bool $filterEmpty, int $offset, ?int $count = null): Generator
    {
        return yield from self::stream($handle, $filterEmpty, $offset, $count, ...$this->filters);
    }

    /**
     * Implements basically the {@link ReadableInterface::read()} interface to be used by child classes.
     *
     * @param mixed               $handle     a resource from where to read
     * @param bool                $filterEmpty
     * @param int                 $offset
     * @param int|null            $count
     * @param FilterableInterface ...$filters list of filters to be applied on each line before it gets yielded
     *
     * @return Generator
     * @see ReadableInterface::read() for documentation
     */
    public static function stream(mixed               $handle, bool $filterEmpty, int $offset, ?int $count = null,
                                  FilterableInterface ...$filters): Generator
    {
        if (!is_resource($handle)) {
            throw new InvalidArgumentException("Argument 'handle' must be a resource, '" . gettype($handle) .
                                               "' given!");
        }
        if ($offset < 0) {
            throw new DomainException("Argument 'offset' must be a positive integer, '$offset' given");
        }
        if ($count < 0) {
            throw new DomainException("Argument 'count' must be a positive integer, '$count' given");
        }

        $filterLineBreaks = WhitespaceFilter::instantiate(WhitespaceFilterType::R_TRIM, WhitespaceFilter::LINE_BREAKS);
        $yieldedLines     = 0;
        $lineNumber       = 0;
        while (!feof($handle)) {

            if (($line = fgets($handle)) === false) {
                break;
            }
            $lineNumber++;

            foreach ($filters as $filter) {

                $line = $filter->filter($line);
            }

            /*
             * Empty lines contains nothing or line-breaks ("\n"|"\n\r") dependent on the operating system with
             * which the file was created.
             */
            if ($filterEmpty && $filterLineBreaks->filter($line) === '') {
                continue;
            }

            if ($lineNumber <= $offset) {
                continue;
            }

            if ($count !== null && $yieldedLines === $count) {
                break;
            }

            yield $lineNumber => $line;
            $yieldedLines++;
        }
    }
}