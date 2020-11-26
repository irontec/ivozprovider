<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20201126114632 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX billableCall_caller_idx ON BillableCalls (caller)');
        $this->addSql('CREATE INDEX billableCall_callee_idx ON BillableCalls (callee)');
        $this->addSql('CREATE INDEX billableCall_brand_company_idx ON BillableCalls (brandId, companyId)');
        $this->addSql('DROP INDEX IDX_E6F2DA359CBEC244 ON BillableCalls');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX IDX_E6F2DA359CBEC244 ON BillableCalls (brandId)');
        $this->addSql('DROP INDEX billableCall_caller_idx ON BillableCalls');
        $this->addSql('DROP INDEX billableCall_callee_idx ON BillableCalls');
        $this->addSql('DROP INDEX billableCall_brand_company_idx ON BillableCalls');
    }
}
