<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210153736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE general_chat_club ADD profil_club_id INT NOT NULL');
        $this->addSql('ALTER TABLE general_chat_club ADD CONSTRAINT FK_FD46B7B4E40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD46B7B4E40DC563 ON general_chat_club (profil_club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE general_chat_club DROP FOREIGN KEY FK_FD46B7B4E40DC563');
        $this->addSql('DROP INDEX UNIQ_FD46B7B4E40DC563 ON general_chat_club');
        $this->addSql('ALTER TABLE general_chat_club DROP profil_club_id');
    }
}
