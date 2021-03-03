<?php

namespace spec\Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

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
     * @var AdministratorDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        BrandInterface $brand,
        CompanyInterface $company,
        TimezoneInterface $timezone
    ) {
        $brandDto = new BrandDto();
        $this->brand = $brand;

        $companyDto = new CompanyDto();
        $this->company = $company;

        $timezoneDto = new TimezoneDto();
        $this->timezone = $timezone;

        $this->dto = $dto = new AdministratorDto();
        $dto
            ->setUsername("admin")
            ->setPass('changeme')
            ->setEmail("admin@example.com")
            ->setActive(true)
            ->setName("admin")
            ->setLastname("ivozprovider")
            ->setBrand($brandDto)
            ->setCompany($companyDto)
            ->setTimezone($timezoneDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand->getWrappedObject()],
            [$companyDto, $company->getWrappedObject()],
            [$timezoneDto, $timezone->getWrappedObject()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
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
