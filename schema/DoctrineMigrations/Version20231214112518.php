<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214112518 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added color into WebPortal';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE WebPortals ADD color VARCHAR(10) DEFAULT \'#000000\' NOT NULL ');

        $colorMaps = [
            'god' => '#2D333B',
            'brand' => '#248475',
            'admin' => '#0277BD',
            'user' => '#BF360C',
        ];

        foreach ($colorMaps as $urlType => $color ) {
            $this->addSql("UPDATE `WebPortals` SET color='$color' WHERE urlType='$urlType'");
        }

        $klearThemes = [
            'irontec-red' => '#4B4949',
            'irontec-blue' => '#2060B2',
            'absolution' => '#3496CB',
            'absolution-green' => '#00833F',
            'absolution-red' => '#D30000',
            'aristo' => '#96C0D9',
            'aristo-dark' => '#3A0B0C',
            'aristo-green' => '#00833F',
            'aristo-red' => '#D30000',
            'delta' => '#FFFFFF',
            'redmond-red' => '#C50000',
            'twitter' => '#DDDDDD',
            'tedra' => '#1F7068',
            'pinkpat' => '#AF0764',
            'redinn' => '#BF4B4B',
            'grayidec' => '#586977',
            'base' => '#CCCCCC',
            'black-tie' => '#333333',
            'blitzer' => '#CC0000',
            'cupertino' => '#3EABE3',
            'dark-hive' => '#1076A7',
            'dot-luv' => '#0B3E6F',
            'eggplant' => '#30273A',
            'excite-bike' => '#E69700',
            'flick' => '#FF0084',
            'hot-sneaks' => '#DD506C',
            'humanity' => '#D09042',
            'le-frog' => '#285C00',
            'mint-choc' => '#201913',
            'overcast' => '#999999',
            'pepper-grinder' => '#E4E2D8',
            'redmond' => '#70A8D2',
            'smoothness' => '#CCCCCC',
            'south-street' => '#F0EDE2',
            'start' => '#7EB543',
            'sunny' => '#8F8776',
            'swanky-purse' => '#291B06',
            'trontastic' => '#AFE075',
            'ui-darkness' => '#F58400',
            'ui-lightness' => '#F6AE38',
            'vader' => '#888888'
        ];

        foreach ($klearThemes as $theme => $color ) {
            $this->addSql("UPDATE `WebPortals` SET color='$color' WHERE klearTheme='$theme'");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE WebPortals DROP color');
    }
}
