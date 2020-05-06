<?php

/**
 * Get the key value from the array
 * @param  array  $array
 * @param  string $key
 * @param  $default
 * @return string|$default
 */
function array_get(array $array, string $key, $default = null)
{
    $result    = $array;
    $arrayKeys = explode('.', $key);

    foreach ($arrayKeys as $arrayKey) {
        if (!array_key_exists($arrayKey, $result)) {
            break;
        }

        $result = $result[$arrayKey];
    }

    return !is_array($result) ? $result : $default;
}
