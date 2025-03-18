<?php
/**
 * ReadableInterface
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\input;

/**
 * Interface ReadableInterface
 *
 * @package Darealfive\IoStream\input
 */
interface ReadableInterface
{
    /**
     * Reads a file and returns its content line-by-line.
     *
     * @param int|null  $offset      optional skips first lines. <NULL> meaning 0 meaning no offset.
     * @param int|null  $limit       optional limits lines returned. <NULL> meaning no limit.
     * @param bool|null $filterEmpty optional filters empty lines. Empty lines being read does not count to the "$limit"
     *                               argument. <NULL> meaning unspecified.
     *
     * @return iterable some iterable element where each element represents a single line.
     */
    public function read(?int $offset = null, ?int $limit = null, ?bool $filterEmpty = null): iterable;
}