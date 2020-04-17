<?php

use UnparseUrl\UnparseUrl;

if (!function_exists('unparse_url')) {
    function unparse_url(array $parsedUrl, array $defaults = []): string
    {
        return (string)new UnparseUrl($parsedUrl, $defaults);
    }
}
