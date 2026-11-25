<?php

namespace spec\Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Service\Ddi\AssertCompanyAllowsDdiImport;
use PhpSpec\ObjectBehavior;

class AssertCompanyAllowsDdiImportSpec extends ObjectBehavior
{
    protected $companyRepository;

    public function let(
        CompanyRepository $companyRepository,
        AdministratorInterface $admin,
        CompanyInterface $company
    ) {
        $this->companyRepository = $companyRepository;
        $this->beConstructedWith($companyRepository);

        $company
            ->getId()
            ->willReturn(1);

        $company
            ->isWholesale()
            ->willReturn(false);

        $companyRepository
            ->getSupervisedCompanyIdsByAdmin($admin)
            ->willReturn([1, 2]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AssertCompanyAllowsDdiImport::class);
    }

    function it_accepts_supervised_non_wholesale_companies(
        AdministratorInterface $admin,
        CompanyInterface $company
    ) {
        $this
            ->shouldNotThrow()
            ->during('execute', [$admin, $company]);
    }

    function it_rejects_companies_not_supervised_by_the_admin(
        AdministratorInterface $admin,
        CompanyInterface $company
    ) {
        $this
            ->companyRepository
            ->getSupervisedCompanyIdsByAdmin($admin)
            ->willReturn([2, 3]);

        $this
            ->shouldThrow(new \DomainException('Forbidden company', 403))
            ->during('execute', [$admin, $company]);
    }

    function it_rejects_wholesale_companies(
        AdministratorInterface $admin,
        CompanyInterface $company
    ) {
        $company
            ->isWholesale()
            ->willReturn(true);

        $this
            ->shouldThrow(new \DomainException('DDIs cannot be imported into wholesale clients', 400))
            ->during('execute', [$admin, $company]);
    }
}
