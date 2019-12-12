<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210143320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profil_club_sport (profil_club_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_812D9E9EE40DC563 (profil_club_id), INDEX IDX_812D9E9EAC78BCF8 (sport_id), PRIMARY KEY(profil_club_id, sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil_club_sport ADD CONSTRAINT FK_812D9E9EE40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_club_sport ADD CONSTRAINT FK_812D9E9EAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE profil_club_sport');
    }
}
