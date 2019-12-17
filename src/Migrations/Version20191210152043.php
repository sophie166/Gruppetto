<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210152043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profil_solo_friend (profil_solo_id INT NOT NULL, friend_id INT NOT NULL, INDEX IDX_F4B897989ADD062D (profil_solo_id), INDEX IDX_F4B897986A5458E8 (friend_id), PRIMARY KEY(profil_solo_id, friend_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil_solo_friend ADD CONSTRAINT FK_F4B897989ADD062D FOREIGN KEY (profil_solo_id) REFERENCES profil_solo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_solo_friend ADD CONSTRAINT FK_F4B897986A5458E8 FOREIGN KEY (friend_id) REFERENCES friend (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE profil_solo_friend');
    }
}
