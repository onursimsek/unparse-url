<?php

namespace UnparseUrl;

use UnparseUrl\Enums\Glues;

class UnparseUrl
{
    private const DEFAULTS = [
        'scheme' => null,
        'user' => null,
        'pass' => null,
        'host' => null,
        'port' => null,
        'path' => null,
        'query' => null,
        'fragment' => null,
    ];

    private array $defaults;

    public function __construct(private readonly array $parsedUrl, array $defaults = [])
    {
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

        $schemeGlue = match (true) {
            $scheme && $host => Glues::SemiColon->value . Glues::Host->value,
            !$scheme && $host => Glues::Host->value,
            default => Glues::SemiColon->value,
        };

        return sprintf(
            '%1$s%2$s%3$s%4$s%5$s%6$s%7$s%8$s%9$s%10$s',
            $scheme,
            $schemeGlue,
            $user,
            $this->prependGlue($pass, Glues::SemiColon),
            $user || $pass ? Glues::Authority->value : null,
            $host,
            $this->prependGlue($port, Glues::SemiColon),
            $path,
            $this->prependGlue($query, Glues::Query),
            $this->prependGlue($fragment, Glues::Fragment)
        );
    }

    private function prependGlue(?string $component, Glues $glue): ?string
    {
        return $component ? $glue->value . $component : null;
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
