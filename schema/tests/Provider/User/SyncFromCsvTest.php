<?php

namespace Tests\Provider\User;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UsersMassImportResult;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class SyncFromCsvTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    private const COMPANY_ID = 1;
    private const OTHER_BRAND_ID = 2;
    private const OTHER_BRAND_DDI_CSV = "Dan,Imported,dan@import.test,dan_import,Zx9*abc123DEF,YealinkT21P_E2,"
        . "001565aabb04,2005,ES,127,DDIProviderName\n";

    private const CSV = "Ada,Imported,ada@import.test,ada_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb01,2002,,,\n"
        . "Ben,Imported,ben@import.test,ben_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb02,2003,,,\n"
        . "Cid,Imported,cid@import.test,cid_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb03,2004,"
        . "ES,944000304,DDIProviderName\n";

    /**
     * @test
     */
    public function imported_terminals_get_a_complete_ps_endpoint()
    {
        $result = $this->importCsv();

        $this->assertSame([], $result->getErrors());
        $this->assertSame(3, $result->getCreatedCount());

        $this->assertPsEndpoint('ada_import', 'Ada Imported <2002>', '2002');
        $this->assertPsEndpoint('ben_import', 'Ben Imported <2003>', '2003');
        $this->assertPsEndpoint('cid_import', 'Cid Imported <2004>', '2004');
        $this->assertDdiRoutedToUser('944000304', 'Cid');
    }

    /**
     * @test
     */
    public function reimported_terminals_keep_a_complete_ps_endpoint()
    {
        $this->importCsv();
        $result = $this->importCsv();

        $this->assertSame([], $result->getErrors());
        $this->assertSame(3, $result->getUpdatedCount());

        $this->assertPsEndpoint('ada_import', 'Ada Imported <2002>', '2002');
        $this->assertPsEndpoint('ben_import', 'Ben Imported <2003>', '2003');
        $this->assertPsEndpoint('cid_import', 'Cid Imported <2004>', '2004');
        $this->assertDdiRoutedToUser('944000304', 'Cid');
    }

    /**
     * @test
     */
    public function a_ddi_of_another_brand_fails_the_row_and_is_left_untouched()
    {
        $result = $this->importCsv(self::OTHER_BRAND_DDI_CSV);

        $this->assertSame(
            [['line' => 1, 'message' => 'DDI 127 belongs to another brand']],
            $result->getErrors()
        );
        $this->assertSame(0, $result->getCreatedCount());

        $ddi = $this->findDdi('127');
        $this->assertSame(self::OTHER_BRAND_ID, $ddi->getBrand()->getId());
        $this->assertNull($ddi->getCompany());
        $this->assertNull($ddi->getUser());
    }

    private function importCsv(string $csv = self::CSV): UsersMassImportResult
    {
        /** @var CompanyInterface $company */
        $company = $this->em
            ->getRepository(Company::class)
            ->find(self::COMPANY_ID);

        /** @var SyncFromCsv $syncFromCsv */
        $syncFromCsv = $this->serviceContainer->get(SyncFromCsv::class);
        $result = $syncFromCsv->execute($company, $csv);

        $this->em->clear();

        return $result;
    }

    private function assertPsEndpoint(
        string $terminalName,
        string $callerid,
        string $hintExtension
    ): void {
        /** @var TerminalInterface|null $terminal */
        $terminal = $this->em
            ->getRepository(Terminal::class)
            ->findOneByCompanyAndName(self::COMPANY_ID, $terminalName);
        $this->assertInstanceOf(TerminalInterface::class, $terminal);

        /** @var PsEndpointInterface|null $endpoint */
        $endpoint = $this->em
            ->getRepository(PsEndpoint::class)
            ->findOneByTerminalId($terminal->getId());
        $this->assertInstanceOf(PsEndpointInterface::class, $endpoint);

        $this->assertSame($callerid, $endpoint->getCallerid());
        $this->assertSame($hintExtension, $endpoint->getHintExtension());
        $this->assertNotEmpty($endpoint->getMailboxes());
    }

    private function assertDdiRoutedToUser(string $ddiNumber, string $userName): void
    {
        $ddi = $this->findDdi($ddiNumber);

        $this->assertSame(self::COMPANY_ID, $ddi->getCompany()->getId());
        $this->assertSame($userName, $ddi->getUser()->getName());
    }

    private function findDdi(string $ddiNumber): DdiInterface
    {
        /** @var CountryInterface $country */
        $country = $this->em
            ->getRepository(Country::class)
            ->findOneByCode('ES');

        /** @var DdiInterface|null $ddi */
        $ddi = $this->em
            ->getRepository(Ddi::class)
            ->findOneByDdiAndCountry($ddiNumber, $country->getId());
        $this->assertInstanceOf(DdiInterface::class, $ddi);

        return $ddi;
    }
}
