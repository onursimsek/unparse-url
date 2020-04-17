<?php

namespace UnparseUrl\Test;

use PHPUnit\Framework\TestCase;
use UnparseUrl\UnparseUrl;

class UnparseUrlTest extends TestCase
{
    /**
     * @param string $url
     * @dataProvider basicUrls
     */
    public function test_unparse_basic_url(string $url)
    {
        $this->assertEquals($url, (string)new UnparseUrl(parse_url($url)));
        $this->assertEquals($url, unparse_url(parse_url($url)));
    }

    /**
     * @param string $url
     * @dataProvider urlsWithScheme
     */
    public function test_unparsable_url_with_scheme(string $url)
    {
        $this->assertEquals($url, (string)new UnparseUrl(parse_url($url)));
    }

    /**
     * @param string $url
     * @dataProvider urlsWithUserOrPass
     */
    public function test_unparsable_url_with_user_or_pass(string $url)
    {
        $this->assertEquals($url, UnparseUrl::unparse(parse_url($url)));
    }

    public function test_unparsable_url_with_port()
    {
        $url = '//foo.bar:1985';
        $this->assertEquals($url, UnparseUrl::unparse(parse_url($url)));
    }

    /**
     * @param string $url
     * @dataProvider urlsWithPath
     */
    public function test_unparsable_url_with_path(string $url)
    {
        $this->assertEquals($url, UnparseUrl::unparse(parse_url($url)));
    }

    public function basicUrls()
    {
        return [
            ['//foo'],
            ['//foo.bar'],
            ['//f-o-o.bar'],
        ];
    }

    public function urlsWithScheme()
    {
        return [
            ['http://foo.bar'],
            ['https://foo.bar'],
            // @source: https://en.wikipedia.org/wiki/URI_scheme
            ['ldap://[2001:db8::7]/c=GB?objectClass?one'],
            ['mailto:John.Doe@example.com'],
            ['news:comp.infosystems.www.servers.unix'],
            ['tel:+1-816-555-1212'],
            ['telnet://192.0.2.16:80/'],
            ['urn:oasis:names:specification:docbook:dtd:xml:4.1.2'],
        ];
    }

    public function urlsWithUserOrPass()
    {
        return [
            ['//user@foo'],
            ['//user:pass@foo'],
        ];
    }

    public function urlsWithPath()
    {
        return [
            ['https://foo/bar'],
            ['https://foo.bar/baz'],
            ['https://foo.bar/baz/foo'],
            ['mailto:John.Doe@example.com'],
            ['news:comp.infosystems.www.servers.unix'],
            ['urn:oasis:names:specification:docbook:dtd:xml:4.1.2'],
        ];
    }
}
