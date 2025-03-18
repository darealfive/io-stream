<?php
/**
 * FilterableInterface
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\filter;

/**
 * Interface FilterableInterface
 *
 * @package Darealfive\IoStream\filter
 */
interface FilterableInterface
{
    /**
     * Takes a string and returns a filtered one.
     *
     * @param string $content the content to filter
     *
     * @return string the filtered content
     */
    public function filter(string $content): string;
}