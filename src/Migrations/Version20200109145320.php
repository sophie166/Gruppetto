<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109145320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, begin_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_event (booking_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_AAD2F7123301C60 (booking_id), INDEX IDX_AAD2F71271F7E88B (event_id), PRIMARY KEY(booking_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_event ADD CONSTRAINT FK_AAD2F7123301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_event ADD CONSTRAINT FK_AAD2F71271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_club ADD general_chat_club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil_club ADD CONSTRAINT FK_B0B62890902D4FDB FOREIGN KEY (general_chat_club_id) REFERENCES general_chat_club (id)');
        $this->addSql('CREATE INDEX IDX_B0B62890902D4FDB ON profil_club (general_chat_club_id)');
        $this->addSql('ALTER TABLE general_chat_club DROP FOREIGN KEY FK_FD46B7B4E40DC563');
        $this->addSql('DROP INDEX UNIQ_FD46B7B4E40DC563 ON general_chat_club');
        $this->addSql('ALTER TABLE general_chat_club DROP profil_club_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking_event DROP FOREIGN KEY FK_AAD2F7123301C60');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_event');
        $this->addSql('ALTER TABLE general_chat_club ADD profil_club_id INT NOT NULL');
        $this->addSql('ALTER TABLE general_chat_club ADD CONSTRAINT FK_FD46B7B4E40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD46B7B4E40DC563 ON general_chat_club (profil_club_id)');
        $this->addSql('ALTER TABLE profil_club DROP FOREIGN KEY FK_B0B62890902D4FDB');
        $this->addSql('DROP INDEX IDX_B0B62890902D4FDB ON profil_club');
        $this->addSql('ALTER TABLE profil_club DROP general_chat_club_id');
    }
}
