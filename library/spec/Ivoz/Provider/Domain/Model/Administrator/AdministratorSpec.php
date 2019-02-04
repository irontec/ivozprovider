<?php

namespace spec\Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class AdministratorSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @var CarrierServerDto
     */
    protected $dto;

    function let(
        BrandInterface $brand,
        CompanyInterface $company,
        TimezoneInterface $timezone
    ) {
        $this->brand = $brand;
        $this->company = $company;
        $this->timezone = $timezone;

        $this->dto = $dto = new AdministratorDto();
        $dto->setUsername("admin");
        $dto->setPass('changeme');
        $dto->setEmail("admin@example.com");
        $dto->setActive(true);
        $dto->setName("admin");
        $dto->setLastname("ivozprovider");

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject(),
                'company' => $company->getWrappedObject(),
                'timezone' => $timezone->getWrappedObject(),
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Administrator::class);
    }

    function it_tells_if_its_a_super_admins()
    {
        $this
            ->dto
            ->setBrand(null);

        $this
            ->dto
            ->setCompany(null);

        $this
            ->isSuperAdmin()
            ->shouldReturn(true);
    }

    /**
     * @return bool
     */
    public function it_gets_company_timezone_if_null(
        TimezoneInterface $timezone
    ) {
        $this
            ->dto
            ->setTimezone(null);

        $this->getterProphecy(
            $this->company,
            [
                'getId' => 1,
                'getDefaultTimezone' => $timezone,
            ],
            true
        );

        $this
            ->getTimezone()
            ->shouldReturn($timezone);
    }
}
