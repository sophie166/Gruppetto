<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213110051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration_event ADD profil_solo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration_event ADD CONSTRAINT FK_B404AA4F9ADD062D FOREIGN KEY (profil_solo_id) REFERENCES profil_solo (id)');
        $this->addSql('CREATE INDEX IDX_B404AA4F9ADD062D ON registration_event (profil_solo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration_event DROP FOREIGN KEY FK_B404AA4F9ADD062D');
        $this->addSql('DROP INDEX IDX_B404AA4F9ADD062D ON registration_event');
        $this->addSql('ALTER TABLE registration_event DROP profil_solo_id');
    }
}
