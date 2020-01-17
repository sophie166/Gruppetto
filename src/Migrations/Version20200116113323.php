<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116113323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profil_solo_sport ADD CONSTRAINT FK_9D2D6873AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE user_profil_club ADD CONSTRAINT FK_19ADE105A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_profil_club ADD CONSTRAINT FK_19ADE105E40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration_event ADD CONSTRAINT FK_B404AA4F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE profil_club DROP FOREIGN KEY FK_B0B62890902D4FDB');
        $this->addSql('DROP INDEX IDX_B0B62890902D4FDB ON profil_club');
        $this->addSql('ALTER TABLE profil_club DROP general_chat_club_id, CHANGE logo_club logo_club VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profil_club_sport ADD CONSTRAINT FK_812D9E9EE40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_club_sport ADD CONSTRAINT FK_812D9E9EAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7EF8BB346 FOREIGN KEY (creator_club_id) REFERENCES profil_club (id)');
        $this->addSql('ALTER TABLE booking_event ADD CONSTRAINT FK_AAD2F71271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE general_chat_club ADD profil_club_id INT NOT NULL');
        $this->addSql('ALTER TABLE general_chat_club ADD CONSTRAINT FK_FD46B7B4E40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id)');
        $this->addSql('CREATE INDEX IDX_FD46B7B4E40DC563 ON general_chat_club (profil_club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking_event DROP FOREIGN KEY FK_AAD2F71271F7E88B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C71F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7AC78BCF8');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7EF8BB346');
        $this->addSql('ALTER TABLE general_chat_club DROP FOREIGN KEY FK_FD46B7B4E40DC563');
        $this->addSql('DROP INDEX IDX_FD46B7B4E40DC563 ON general_chat_club');
        $this->addSql('ALTER TABLE general_chat_club DROP profil_club_id');
        $this->addSql('ALTER TABLE profil_club ADD general_chat_club_id INT DEFAULT NULL, CHANGE logo_club logo_club VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE profil_club ADD CONSTRAINT FK_B0B62890902D4FDB FOREIGN KEY (general_chat_club_id) REFERENCES general_chat_club (id)');
        $this->addSql('CREATE INDEX IDX_B0B62890902D4FDB ON profil_club (general_chat_club_id)');
        $this->addSql('ALTER TABLE profil_club_sport DROP FOREIGN KEY FK_812D9E9EE40DC563');
        $this->addSql('ALTER TABLE profil_club_sport DROP FOREIGN KEY FK_812D9E9EAC78BCF8');
        $this->addSql('ALTER TABLE profil_solo_sport DROP FOREIGN KEY FK_9D2D6873AC78BCF8');
        $this->addSql('ALTER TABLE registration_event DROP FOREIGN KEY FK_B404AA4F71F7E88B');
        $this->addSql('ALTER TABLE user_profil_club DROP FOREIGN KEY FK_19ADE105A76ED395');
        $this->addSql('ALTER TABLE user_profil_club DROP FOREIGN KEY FK_19ADE105E40DC563');
    }
}
