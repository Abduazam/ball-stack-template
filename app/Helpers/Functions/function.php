<?php

if (! function_exists('translation')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $string
     * @return string|null
     */
    function translation(?string $string): ?string
    {
        if ($string === null) {
            return null;
        }

        $locale = app()->getLocale();

        $data = json_decode($string, true);

        return $data[$locale] ?? null;
    }
}
