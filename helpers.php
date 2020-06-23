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
    $result = $array;
    $arrayKeys = explode('.', $key);

    foreach ($arrayKeys as $arrayKey) {
        if (!array_key_exists($arrayKey, $result)) {
            break;
        }

        $result = $result[$arrayKey];
    }

    return !is_array($result) ? $result : $default;
}

/**
 * Connect the template and press data into it
 * @param  string $templateName
 * @param  array  $data
 */
function includeView(string $templateName, array $data = [])
{
    if (hasUserSession()) {
        $data['user'] = \App\Models\User::findOrFail($_SESSION['userId']);
    }

    extract($data, EXTR_PREFIX_SAME, 'alt');
    include TEMPLATES_DIR . '/' . str_replace(VIEW_SEPARATOR, '/', $templateName) . '.php';
}

/**
 * Cut the string
 * @param  string $string
 * @param  int $count
 * @return string
 */
function shortLine(string $string, int $count = 100): string
{
    return mb_strimwidth($string, 0, $count, "...");
}

/**
 * Check if a constant exists for this field and return it
 * @param  string $constant
 * @param  string $name
 * @return string
 */
function getConstant(string $constant, string $name): string
{
    if (defined($constant . '_' . mb_strtoupper($name))) {
        return constant($constant . '_' . mb_strtoupper($name));
    }

    return constant($constant);
}

/**
 * Check for user session variable
 * @return boolean
 */
function hasUserSession(): bool
{
    return isset($_SESSION['userId']);
}
