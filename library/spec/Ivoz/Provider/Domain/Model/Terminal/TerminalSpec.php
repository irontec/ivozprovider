<?php

namespace spec\Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class TerminalSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;
    protected $company;
    protected $domain;

    private $transformer;

    function let(
        CompanyInterface $company,
        DomainInterface $domain
    ) {
        $this->dto = $dto = new TerminalDto();
        $this->company = $company;
        $this->domain = $domain;

        $companyDto = new CompanyDto();

        $dto
            ->setName('Name')
            ->setDisallow('Disallow')
            ->setAllowAudio('allowAudio')
            ->setDirectMediaMethod('reinvite')
            ->setPassword('HZhN5z*j48')
            ->setCompany($companyDto);

        $company
            ->getId()
            ->willReturn(1);

        $company
            ->getDomain()
            ->willReturn($domain);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company->getWrappedObject()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Terminal::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['name with whitespaces']);

        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['name with $simbols']);
    }

    function it_accepts_valid_name()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['NameWithoutNamespaces1']);
    }

    function it_throws_an_exception_on_invalid_password()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPassword', ['1234']);
    }

    function it_accepts_format_compliant_password()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPassword', ['HZhN5z*j48']);
    }

    function it_sets_domain_by_company()
    {
        $dto = clone $this->dto;
        $dto->setDomain(null);

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getDomain()
            ->shouldBe($this->domain);
    }
}
