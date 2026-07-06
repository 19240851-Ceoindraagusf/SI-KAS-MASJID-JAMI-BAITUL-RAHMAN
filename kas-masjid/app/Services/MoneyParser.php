<?php

namespace App\Services;

class MoneyParser
{
    /**
     * Parse a localized currency/number string into a normalized decimal string (dot as decimal separator, 2 decimals).
     * Returns null when input can't be parsed.
     */
    public static function parse(mixed $input): ?string
    {
        $s = (string) $input;
        $normalized = preg_replace('/[^0-9\.,\-]/u', '', $s);

        if ($normalized === '') {
            return null;
        }

        $hasDot = strpos($normalized, '.') !== false;
        $hasComma = strpos($normalized, ',') !== false;

        if ($hasDot && $hasComma) {
            // Determine which is decimal separator by looking at last positions
            if (strrpos($normalized, '.') < strrpos($normalized, ',')) {
                // dot as thousands, comma as decimal (e.g. 1.234,56)
                $normalized = str_replace('.', '', $normalized);
                $normalized = str_replace(',', '.', $normalized);
            } else {
                // comma as thousands, dot as decimal (e.g. 1,234.56)
                $normalized = str_replace(',', '', $normalized);
            }
        } elseif ($hasComma && ! $hasDot) {
            // comma as decimal separator (e.g. 1234,56)
            $normalized = str_replace(',', '.', $normalized);
        } elseif ($hasDot && ! $hasComma) {
            // ambiguous: dot may be thousands or decimal. Heuristic: if last group after dot has length 3 => thousands
            $parts = explode('.', $normalized);
            $last = end($parts);
            if (strlen($last) === 3) {
                $normalized = str_replace('.', '', $normalized);
            }
            // otherwise keep dot as decimal
        }

        // Final numeric check
        if (! is_numeric($normalized)) {
            return null;
        }

        // Return as string with 2 decimals (dot separator)
        return number_format((float) $normalized, 2, '.', '');
    }
}
