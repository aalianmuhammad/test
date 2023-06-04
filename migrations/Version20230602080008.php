<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602080008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mededelingen ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mededelingen ADD CONSTRAINT FK_60896824A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_60896824A76ED395 ON mededelingen (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mededelingen DROP FOREIGN KEY FK_60896824A76ED395');
        $this->addSql('DROP INDEX IDX_60896824A76ED395 ON mededelingen');
        $this->addSql('ALTER TABLE mededelingen DROP user_id');
    }
}
