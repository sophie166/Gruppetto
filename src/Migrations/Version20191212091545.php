<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212091545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event ADD createur_solo_id INT DEFAULT NULL, ADD createur_club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74FAA2994 FOREIGN KEY (createur_solo_id) REFERENCES profil_solo (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7317AEADA FOREIGN KEY (createur_club_id) REFERENCES profil_club (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74FAA2994 ON event (createur_solo_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7317AEADA ON event (createur_club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74FAA2994');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7317AEADA');
        $this->addSql('DROP INDEX IDX_3BAE0AA74FAA2994 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA7317AEADA ON event');
        $this->addSql('ALTER TABLE event DROP createur_solo_id, DROP createur_club_id');
    }
}
