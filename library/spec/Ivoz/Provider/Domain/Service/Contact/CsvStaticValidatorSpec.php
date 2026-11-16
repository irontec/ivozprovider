<?php

namespace spec\Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Provider\Domain\Service\Contact\CsvStaticValidator;
use PhpSpec\ObjectBehavior;

class CsvStaticValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CsvStaticValidator::class);
    }

    function it_accepts_a_header_with_all_the_columns()
    {
        $this
            ->shouldNotThrow()
            ->during('execute', [CsvStaticValidator::COLUMNS]);
    }

    function it_accepts_a_header_with_some_columns_in_any_order()
    {
        $this
            ->shouldNotThrow()
            ->during('execute', [['workPhone', 'id']]);
    }

    function it_rejects_unknown_columns()
    {
        $exception = new \DomainException(
            'Unknown column "workPhoneE164" in the header. Allowed columns: '
            . 'id, name, lastname, email, workPhoneCountry, workPhone, mobilePhoneCountry, mobilePhone, otherPhone'
        );

        $this
            ->shouldThrow($exception)
            ->during('execute', [['id', 'workPhoneE164']]);
    }
}
