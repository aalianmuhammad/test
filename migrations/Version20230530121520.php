<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530121520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE examen_aanvrag (id INT AUTO_INCREMENT NOT NULL, datum DATE NOT NULL, tijd TIME NOT NULL, geslaagd TINYINT(1) NOT NULL, mededelingen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rijles (id INT AUTO_INCREMENT NOT NULL, datum DATE NOT NULL, tijd TIME NOT NULL, ophaal_locatie VARCHAR(255) NOT NULL, lesdoel VARCHAR(255) NOT NULL, annuleren VARCHAR(255) NOT NULL, annuleer_reden VARCHAR(255) DEFAULT NULL, opmerkingen_instructeur VARCHAR(255) DEFAULT NULL, opmerkingen_leerling VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ziekmelding (id INT AUTO_INCREMENT NOT NULL, datum_ziek DATE NOT NULL, datum_beter DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE examen_aanvrag');
        $this->addSql('DROP TABLE rijles');
        $this->addSql('DROP TABLE ziekmelding');
    }
}
