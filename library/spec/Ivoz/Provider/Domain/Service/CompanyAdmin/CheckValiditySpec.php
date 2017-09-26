<?php

namespace spec\Ivoz\Provider\Domain\Service\CompanyAdmin;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyAdmin\CompanyAdminInterface;
use Ivoz\Provider\Domain\Model\CompanyAdmin\CompanyAdminRepository;
use Ivoz\Provider\Domain\Service\CompanyAdmin\CheckValidity;
use PhpSpec\ObjectBehavior;
use spec\SpecHelperTrait;

class CheckValiditySpec extends ObjectBehavior
{
    protected $companyAdminRepository;
    protected $entity;

    function let(
        CompanyAdminRepository $companyAdminRepository,
        CompanyAdminInterface $entity
    ) {
        $this->companyAdminRepository = $companyAdminRepository;
        $this->entity = $entity;

        $this->beConstructedWith($companyAdminRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckValidity::class);
    }

    function it_returns_on_already_persisted_entity()
    {
        $this
            ->entity
            ->getCompany()
            ->shouldNotBeCalled();

        $this->execute($this->entity, false);
    }

    function it_searches_for_duplicated_company_admins(
          CompanyInterface $company
    ) {
        $this->prepareCompanyAdminQuery($company);

        $this
            ->companyAdminRepository
            ->findOneBy([
                'username' => 'testUsername',
                'company' => 1
            ])
            ->shouldBeCalled();

        $this->execute($this->entity, true);
    }

    function it_throws_an_Exception_on_duplicated_company_admin(
        CompanyInterface $company,
        CompanyAdminInterface $aCompanyAdmin
    ) {
        $this->prepareCompanyAdminQuery($company);

        $this
            ->companyAdminRepository
            ->findOneBy([
                'username' => 'testUsername',
                'company' => 1
            ])
            ->shouldBeCalled()
            ->willReturn($aCompanyAdmin);

        $this
            ->shouldThrow('\Exception')
            ->during('execute', [$this->entity, true]);
    }

    /**
     * @param CompanyInterface $company
     */
    private function prepareCompanyAdminQuery(CompanyInterface $company)
    {
        $company
            ->getId()
            ->shouldBeCalled()
            ->willReturn(1);

        $this
            ->entity
            ->getUsername()
            ->shouldBeCalled()
            ->willReturn('testUsername');

        $this
            ->entity
            ->getCompany()
            ->shouldBeCalled()
            ->willReturn($company);
    }
}
