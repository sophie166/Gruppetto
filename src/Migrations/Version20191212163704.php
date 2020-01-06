<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212163704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE general_chat_club ADD profil_solo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE general_chat_club ADD CONSTRAINT FK_FD46B7B49ADD062D FOREIGN KEY (profil_solo_id) REFERENCES profil_solo (id)');
        $this->addSql('CREATE INDEX IDX_FD46B7B49ADD062D ON general_chat_club (profil_solo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE general_chat_club DROP FOREIGN KEY FK_FD46B7B49ADD062D');
        $this->addSql('DROP INDEX IDX_FD46B7B49ADD062D ON general_chat_club');
        $this->addSql('ALTER TABLE general_chat_club DROP profil_solo_id');
    }
}
