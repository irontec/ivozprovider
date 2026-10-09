<?php

namespace spec\Ivoz\Provider\Domain\Service\InvoiceTemplate;

use Ivoz\Provider\Domain\Service\InvoiceTemplate\GetInvoicePdfOptions;
use PhpSpec\ObjectBehavior;

class GetInvoicePdfOptionsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GetInvoicePdfOptions::class);
    }

    function it_sets_header_and_footer()
    {
        $options = $this->execute('<p>header</p>', '<p>footer</p>');

        $options['header-html']->shouldBe('<p>header</p>');
        $options['footer-html']->shouldBe('<p>footer</p>');
    }

    function it_disables_local_file_access()
    {
        $options = $this->execute('', '');

        $options['disable-local-file-access']->shouldBe(true);
        $options->shouldNotHaveKey('enable-local-file-access');
    }

    function it_disables_javascript()
    {
        $options = $this->execute('', '');

        $options['disable-javascript']->shouldBe(true);
        $options->shouldNotHaveKey('enable-javascript');
    }
}
