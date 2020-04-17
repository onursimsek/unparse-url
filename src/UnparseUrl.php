<?php

namespace UnparseUrl;

class UnparseUrl
{
    const SCHEME_GLUE = ':';

    const HOST_GLUE = '//';

    const AUTHORITY_GLUE = '@';

    const PORT_GLUE = ':';

    const QUERY_GLUE = '?';

    const FRAGMENT_GLUE = '#';

    const DEFAULTS = [
        'scheme' => null,
        'user' => null,
        'pass' => null,
        'host' => null,
        'port' => null,
        'path' => null,
        'query' => null,
        'fragment' => null,
    ];

    /**
     * @var array
     */
    private $parsedUrl;

    /**
     * @var array
     */
    private $defaults;

    public function __construct(array $parsedUrl, array $defaults = [])
    {
        $this->parsedUrl = $parsedUrl;
        $this->defaults = $defaults;
    }

    /**
     * @param array $defaults
     * @return array
     */
    private function getDefaults(array $defaults): array
    {
        return array_merge(self::DEFAULTS, array_intersect_key(self::DEFAULTS, $defaults));
    }

    /**
     * @param array $values
     * @return string
     */
    private function implode(array $values): string
    {
        [$scheme, $user, $pass, $host, $port, $path, $query, $fragment] = array_values($values);

        switch (true) {
            case $scheme && $host:
                $schemeGlue = self::SCHEME_GLUE . self::HOST_GLUE;
                break;
            case !$scheme && $host:
                $schemeGlue = self::HOST_GLUE;
                break;
            default:
                $schemeGlue = self::SCHEME_GLUE;
                break;
        }

        return $scheme . $schemeGlue
            . $user
            . ($pass ? ':' . $pass : null)
            . ($user || $pass ? self::AUTHORITY_GLUE : null)
            . $host
            . ($port ? self::PORT_GLUE . $port : null)
            . $path
            . ($query ? self::QUERY_GLUE . $query : null)
            . ($fragment ? self::FRAGMENT_GLUE . $fragment : null);
    }

    /**
     * @param array $parsedUrl
     * @param array $defaults
     * @return string
     */
    public static function unparse(array $parsedUrl, array $defaults = []): string
    {
        return (string)new static($parsedUrl, $defaults);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $defaults = $this->getDefaults($this->defaults);

        return $this->implode(array_merge($defaults, array_intersect_key($this->parsedUrl, $defaults)));
    }
}
