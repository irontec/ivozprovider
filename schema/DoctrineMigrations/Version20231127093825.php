<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127093825 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Queue Pause and Unpause service codes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO Services (
                            iden,
                            name_en,
                            name_es,
                            name_ca,
                            name_it,
                            description_en,
                            description_es,
                            description_ca,
                            description_it,
                            defaultCode,
                            extraArgs
                        ) VALUES (
                            "QueuePause",
                            "Queue pause",
                            "Pausar en colas",
                            "Pausar en colas",
                            "Queue pause",
                            "Pause user in queues to avoid receiving calls",
                            "Pausa el usuario en colas para no recibir llamadas",
                            "Pausa el usuario en colas para no recibir llamadas",
                            "Pause user in queues to avoid receiving calls",
                            "73",
                            0
                        )');

        $this->addSql('INSERT INTO Services (
                            iden,
                            name_en,
                            name_es,
                            name_ca,
                            name_it,
                            description_en,
                            description_es,
                            description_ca,
                            description_it,
                            defaultCode,
                            extraArgs
                        ) VALUES (
                            "QueueUnpause",
                            "Queue unpause",
                            "Despausar en colas",
                            "Despausar en colas",
                            "Queue unpause",
                            "Unpause user in queues to start receiving calls",
                            "Despausa el usuario en colas para comenzar a recibir llamadas",
                            "Despausa el usuario en colas para comenzar a recibir llamadas",
                            "Unpause user in queues to start receiving calls",
                            "74",
                            0
                        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM Services WHERE iden = "QueuePause"');
        $this->addSql('DELETE FROM Services WHERE iden = "QueueUnpause"');
    }
}
