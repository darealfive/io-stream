<?php
/**
 * Filter class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\filter;

use Closure;

/**
 * Class Filter
 *
 * @package Darealfive\IoStream\filter
 */
abstract readonly class Filter implements FilterableInterface
{
    /**
     * @param Closure $callback a callback with the following structure: fn(string: $content): string
     */
    protected function __construct(public Closure $callback)
    {
    }

    /**
     * Applies filter logic by using a callback.
     *
     * @param string $content
     *
     * @return string
     */
    public function filter(string $content): string
    {
        return call_user_func($this->callback, $content);
    }
}