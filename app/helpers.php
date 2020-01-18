<?php

if (! function_exists('array_convert_nulls_to_empty')) {
    /**
     * Convert the null values of an array to empty strings recursively.
     */
    function array_convert_nulls_to_empty(array $data = []): array
    {
        return array_map(function ($item) {
            if (is_array($item)) {
                return array_convert_nulls_to_empty($item);
            }

            return $item === null ? '' : $item;
        }, $data);
    }
}
