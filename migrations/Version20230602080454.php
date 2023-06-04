<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602080454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rijles ADD instructeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rijles ADD CONSTRAINT FK_A7DA821225FCA809 FOREIGN KEY (instructeur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A7DA821225FCA809 ON rijles (instructeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rijles DROP FOREIGN KEY FK_A7DA821225FCA809');
        $this->addSql('DROP INDEX IDX_A7DA821225FCA809 ON rijles');
        $this->addSql('ALTER TABLE rijles DROP instructeur_id');
    }
}
