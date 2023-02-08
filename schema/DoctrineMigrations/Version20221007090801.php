<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20221007090801 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Update Media relay ports from 22223 to 2223';
    }

    public function up(Schema $schema): void
    {
		$this->addSql("UPDATE kam_rtpengine SET url = REPLACE(url, ':22223', ':2223');");
    }

    public function down(Schema $schema): void
    {
		$this->addSql("UPDATE kam_rtpengine SET url = REPLACE(url, ':2223', ':22223');");
    }
}
