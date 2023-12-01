<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115173418 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Operator Panel feature ';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'INSERT INTO Features VALUES (
                    13,
                    "operatorPanel",
                    "Operator Panel",
                    "Panel de operador",
                    "Panell d\'operador",
                    "Pannello operatore"
                )'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'DELETE FROM Features WHERE iden = "operatorPanel"'
        );
    }
}
