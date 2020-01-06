<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210153252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sport ADD sport_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE sport ADD CONSTRAINT FK_1A85EFD27173D9A4 FOREIGN KEY (sport_category_id) REFERENCES sport_category (id)');
        $this->addSql('CREATE INDEX IDX_1A85EFD27173D9A4 ON sport (sport_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sport DROP FOREIGN KEY FK_1A85EFD27173D9A4');
        $this->addSql('DROP INDEX IDX_1A85EFD27173D9A4 ON sport');
        $this->addSql('ALTER TABLE sport DROP sport_category_id');
    }
}
