<?php

namespace Tests\Provider\User;

use Ivoz\Provider\Application\Service\User\ExportToCsv;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UsersMassImportResult;
use Ivoz\Provider\Domain\Service\User\CsvRowsParser;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class ExportToCsvTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    private const COMPANY_ID = 2;

    private const CSV = "Ada,Imported,ada@import.test,ada_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb01,2002,,,\n"
        . "Ben,Imported,ben@import.test,ben_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb02,2003,,,\n"
        . "Cid,Imported,cid@import.test,cid_import,Zx9*abc123DEF,YealinkT21P_E2,001565aabb03,2004,"
        . "ES,944000304,DDIProviderName\n";

    /**
     * @test
     */
    public function importing_the_exported_file_changes_nothing()
    {
        $this->importCsv(self::CSV);
        $before = $this->snapshot();

        $exported = $this->export();
        $result = $this->importCsv($exported);

        $this->assertSame([], $result->getErrors());
        $this->assertSame(0, $result->getCreatedCount());
        $this->assertSame(3, $result->getUpdatedCount());
        $this->assertSame($before, $this->snapshot());
    }

    /**
     * @test
     */
    public function exported_file_has_no_terminal_passwords()
    {
        $this->importCsv(self::CSV);

        $rows = (new CsvRowsParser())->parse($this->export());
        $passwordColumn = array_search('terminal password', CsvStaticValidator::COLUMNS, true);

        $this->assertCount(3, $rows);
        foreach ($rows as $row) {
            $this->assertSame('', $row[$passwordColumn]);
        }
    }

    /**
     * @test
     */
    public function a_client_with_two_users_with_the_same_name_cannot_be_exported()
    {
        $this->importCsv(self::CSV);
        $this->em
            ->getConnection()
            ->executeStatement(
                'UPDATE Users SET name = "Ada" WHERE companyId = ' . self::COMPANY_ID . ' AND name = "Ben"'
            );
        $this->em->clear();

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Duplicated full name found: Ada Imported');

        $this->export();
    }

    private function importCsv(string $csv): UsersMassImportResult
    {
        /** @var SyncFromCsv $syncFromCsv */
        $syncFromCsv = $this->serviceContainer->get(SyncFromCsv::class);
        $result = $syncFromCsv->execute($this->company(), $csv);

        $this->em->clear();

        return $result;
    }

    private function export(): string
    {
        /** @var ExportToCsv $exportToCsv */
        $exportToCsv = $this->serviceContainer->get(ExportToCsv::class);
        $csv = $exportToCsv->execute($this->company());

        $this->em->clear();

        return $csv;
    }

    private function company(): CompanyInterface
    {
        /** @var CompanyInterface $company */
        $company = $this->em
            ->getRepository(Company::class)
            ->find(self::COMPANY_ID);

        return $company;
    }

    /**
     * @return array<string, list<array<string, mixed>>>
     */
    private function snapshot(): array
    {
        $companyId = self::COMPANY_ID;
        $queries = [
            'users' => "SELECT * FROM Users WHERE companyId = $companyId ORDER BY id",
            'terminals' => "SELECT * FROM Terminals WHERE companyId = $companyId ORDER BY id",
            'extensions' => "SELECT * FROM Extensions WHERE companyId = $companyId ORDER BY id",
            'ddis' => "SELECT * FROM DDIs WHERE companyId = $companyId ORDER BY id",
            'ps_endpoints' => "SELECT * FROM ast_ps_endpoints WHERE terminalId IN "
                . "(SELECT id FROM Terminals WHERE companyId = $companyId) ORDER BY id",
        ];

        $snapshot = [];
        foreach ($queries as $table => $sql) {
            $snapshot[$table] = $this->em
                ->getConnection()
                ->fetchAllAssociative($sql);
        }

        $this->assertNotEmpty($snapshot['users']);
        $this->assertNotEmpty($snapshot['ps_endpoints']);

        return $snapshot;
    }
}
