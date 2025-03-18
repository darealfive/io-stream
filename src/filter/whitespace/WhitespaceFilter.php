<?php
/**
 * WhitespaceFilter class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\filter\whitespace;

use Darealfive\IoStream\filter\Filter;

/**
 * Class WhitespaceFilter
 *
 * @package Darealfive\IoStream\filter
 */
readonly class WhitespaceFilter extends Filter
{
    public const ALL = " \n\r\t\v\0";
    public const LINE_BREAKS = "\n\r";
    public const EXCEPT_LINE_BREAKS = " \t\v\0";

    /**
     * Convenient method to instantiate a whitespace filter.
     *
     * @param WhitespaceFilterType $type       defines the function to be applied
     * @param string               $characters the characters to filter
     *
     * @return self
     */
    public static function instantiate(WhitespaceFilterType $type = WhitespaceFilterType::TRIM,
                                       string               $characters = self::EXCEPT_LINE_BREAKS): self
    {
        return new self($type->filter($characters));
    }
}