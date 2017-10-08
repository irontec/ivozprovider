<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Provider\Domain\Service\CompanyService\RemoveByBrandService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoveByBrandServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveByBrandService::class);
    }
}
