<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180307193902 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        // Check if delta  077-conditional-locks.sql is already applied
        $deltaApplied = $this->connection->query('SELECT 1 FROM changelog WHERE change_number = 77')->rowCount();
        if ($deltaApplied) {
            $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks DROP FOREIGN KEY ConditionalRoutesConditionsRelRouteLocks_ibfk_1');
            $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks DROP FOREIGN KEY ConditionalRoutesConditionsRelRouteLocks_ibfk_2');
            $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks ADD CONSTRAINT FK_7654179F128AE9F0 FOREIGN KEY (conditionId) REFERENCES ConditionalRoutesConditions (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks ADD CONSTRAINT FK_7654179FC308783B FOREIGN KEY (routeLockId) REFERENCES RouteLocks (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks RENAME INDEX conditionid TO IDX_7654179F128AE9F0');
            $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks RENAME INDEX routelockid TO IDX_7654179FC308783B');
            $this->addSql('ALTER TABLE RouteLocks RENAME INDEX companyid TO IDX_82CD30DD2480E723');
            $this->connection->query('DELETE FROM changelog WHERE change_number = 77')->execute();
            return;
        }

        $this->addSql('CREATE TABLE RouteLocks (
                         id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                         companyId INT UNSIGNED NOT NULL,
                         name VARCHAR(50) NOT NULL,
                         description VARCHAR(100) DEFAULT \'\' NOT NULL,
                         open TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\',
                         INDEX IDX_82CD30DD2480E723 (companyId),
                         PRIMARY KEY(id)
                       ) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('CREATE TABLE ConditionalRoutesConditionsRelRouteLocks (
                         id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                         conditionId INT UNSIGNED NOT NULL,
                         routeLockId INT UNSIGNED NOT NULL,
                         INDEX IDX_7654179F128AE9F0 (conditionId),
                         INDEX IDX_7654179FC308783B (routeLockId),
                         PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks ADD CONSTRAINT FK_7654179F128AE9F0 FOREIGN KEY (conditionId) REFERENCES ConditionalRoutesConditions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks ADD CONSTRAINT FK_7654179FC308783B FOREIGN KEY (routeLockId) REFERENCES RouteLocks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RouteLocks ADD CONSTRAINT FK_82CD30DD2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');

        $this->addSql('INSERT INTO Services (iden, name_en, name_es, description_en, description_es, defaultCode, extraArgs)
                        VALUES ("CloseLock", "Close Lock", "Cerrar candado", "Disables a routes with the lock", "Deshabilita rutas configuradas con el candado", "70", 1)');

        $this->addSql('INSERT INTO Services (iden, name_en, name_es, description_en, description_es, defaultCode, extraArgs)
                        VALUES ("OpenLock", "Open Lock", "Abrir candado", "Enables a routes with the lock", "Habilita rutas configuradas con el candado", "71", 1)');

        $this->addSql('INSERT INTO Services (iden, name_en, name_es, description_en, description_es, defaultCode, extraArgs)
                        VALUES ("ToggleLock", "Toggle Lock", "Alternar candado", "Switch current lock status", "Alterna el estado de un candado", "72", 1)');


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ConditionalRoutesConditionsRelRouteLocks DROP FOREIGN KEY FK_7654179FC308783B');
        $this->addSql('DROP TABLE ConditionalRoutesConditionsRelRouteLocks');
        $this->addSql('DROP TABLE RouteLocks');
        $this->addSql('DELETE FROM Services WHERE iden = "CloseLock"');
        $this->addSql('DELETE FROM Services WHERE iden = "OpenLock"');
        $this->addSql('DELETE FROM Services WHERE iden = "ToggleLock"');
    }
}
