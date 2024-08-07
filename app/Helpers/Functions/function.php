<?php

if (! function_exists('translation')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $value
     * @param string|null $locale
     * @return string|null
     */
    function translation(?string $value, ?string $locale = null): ?string
    {
        if (is_null($locale)) {
            $locale = app()->getLocale();
        }

        $data = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
            return $data[$locale] ?? $data['en'] ?? $value;
        }

        return $value;
    }
}
