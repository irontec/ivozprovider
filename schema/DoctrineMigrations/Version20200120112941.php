<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200120112941 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
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
                            "CallForwardInconditional",
                            "Inconditional call forward",
                            "Desvío incondicional",
                            "Desvío incondicional",
                            "Inconditional call forward",
                            "Enable or disable inconditional call forward",
                            "Habilita o deshabilita el desvío incondicional",
                            "Habilita o deshabilita el desvío incondicional",
                            "Enable or disable inconditional call forward",
                            "80",
                            1
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
                            "CallForwardBusy",
                            "Busy call forward",
                            "Desvío si ocupado",
                            "Desvío si ocupado",
                            "Busy call forward",
                            "Enable or disable busy call forward",
                            "Habilita o deshabilita el desvío si ocupado",
                            "Habilita o deshabilita el desvío si ocupado",
                            "Enable or disable busy call forward",
                            "81",
                            1
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
                            "CallForwardNoAnswer",
                            "No answer call forward",
                            "Desvío si no contesta",
                            "Desvío si no contesta",
                            "No answer call forward",
                            "Enable or disable no answer call forward",
                            "Habilita o deshabilita el desvío si no contesta",
                            "Habilita o deshabilita el desvío si no contesta",
                            "Enable or disable no answer call forward",
                            "82",
                            1
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
                            "CallForwardUnreachable",
                            "Unreachable call forward",
                            "Desvío si inalcanzable",
                            "Desvío si inalcanzable",
                            "Unreachable call forward",
                            "Enable or disable unreachable call forward",
                            "Habilita o deshabilita el desvío si inalcanzable",
                            "Habilita o deshabilita el desvío si inalcanzable",
                            "Enable or disable unreachable call forward",
                            "83",
                            1
                        )');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DELETE FROM Services WHERE iden = "CallForwardInconditional"');
        $this->addSql('DELETE FROM Services WHERE iden = "CallForwardBusy"');
        $this->addSql('DELETE FROM Services WHERE iden = "CallForwardNoAnswer"');
        $this->addSql('DELETE FROM Services WHERE iden = "CallForwardUnreachable"');
    }
}
