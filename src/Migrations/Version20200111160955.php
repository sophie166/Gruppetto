<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200111160955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profil_solo ADD profil_club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil_solo ADD CONSTRAINT FK_75814F3E40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id)');
        $this->addSql('CREATE INDEX IDX_75814F3E40DC563 ON profil_solo (profil_club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profil_solo DROP FOREIGN KEY FK_75814F3E40DC563');
        $this->addSql('DROP INDEX IDX_75814F3E40DC563 ON profil_solo');
        $this->addSql('ALTER TABLE profil_solo DROP profil_club_id');
    }
}
