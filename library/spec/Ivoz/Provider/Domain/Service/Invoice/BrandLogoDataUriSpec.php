<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Service\Invoice\BrandLogoDataUri;
use PhpSpec\ObjectBehavior;

class BrandLogoDataUriSpec extends ObjectBehavior
{
    /** @var string */
    protected $logoPath;

    function let()
    {
        $this->logoPath = (string) tempnam(sys_get_temp_dir(), 'brand-logo-');
        file_put_contents($this->logoPath, 'logo-content');
    }

    function letGo()
    {
        if (is_file($this->logoPath)) {
            unlink($this->logoPath);
        }
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BrandLogoDataUri::class);
    }

    function it_encodes_logo_as_data_uri()
    {
        $this
            ->execute($this->logoPath, 'image/png')
            ->shouldBe('data:image/png;base64,' . base64_encode('logo-content'));
    }

    function it_returns_empty_string_without_logo()
    {
        $this
            ->execute(null, null)
            ->shouldBe('');
    }

    function it_returns_empty_string_without_mime_type()
    {
        $this
            ->execute($this->logoPath, null)
            ->shouldBe('');
    }

    function it_returns_empty_string_when_logo_file_is_missing()
    {
        $this
            ->execute('/nonexistent/brand-logo.png', 'image/png')
            ->shouldBe('');
    }
}
