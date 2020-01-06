<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210154028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE general_chat_club_profil_solo (general_chat_club_id INT NOT NULL, profil_solo_id INT NOT NULL, INDEX IDX_ACA0FCBC902D4FDB (general_chat_club_id), INDEX IDX_ACA0FCBC9ADD062D (profil_solo_id), PRIMARY KEY(general_chat_club_id, profil_solo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE general_chat_club_profil_solo ADD CONSTRAINT FK_ACA0FCBC902D4FDB FOREIGN KEY (general_chat_club_id) REFERENCES general_chat_club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE general_chat_club_profil_solo ADD CONSTRAINT FK_ACA0FCBC9ADD062D FOREIGN KEY (profil_solo_id) REFERENCES profil_solo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE general_chat_club_profil_solo');
    }
}
