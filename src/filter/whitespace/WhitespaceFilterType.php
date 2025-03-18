<?php
/**
 * WhitespaceFilterEnum
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

namespace Darealfive\IoStream\filter\whitespace;

enum WhitespaceFilterType: string
{
    case TRIM = 'trim';
    case L_TRIM = 'ltrim';
    case R_TRIM = 'rtrim';

    public function filter(string $characters): callable
    {
        return match ($this) {
            self::TRIM => static fn(string $value) => trim($value, $characters),
            self::L_TRIM => static fn(string $value) => ltrim($value, $characters),
            self::R_TRIM => static fn(string $value) => rtrim($value, $characters),
        };
    }
}
