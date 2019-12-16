<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210160505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_profil_club (user_id INT NOT NULL, profil_club_id INT NOT NULL, INDEX IDX_19ADE105A76ED395 (user_id), INDEX IDX_19ADE105E40DC563 (profil_club_id), PRIMARY KEY(user_id, profil_club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_profil_club ADD CONSTRAINT FK_19ADE105A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_profil_club ADD CONSTRAINT FK_19ADE105E40DC563 FOREIGN KEY (profil_club_id) REFERENCES profil_club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD profil_solo_id INT DEFAULT NULL, ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499ADD062D FOREIGN KEY (profil_solo_id) REFERENCES profil_solo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499ADD062D ON user (profil_solo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_profil_club');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499ADD062D');
        $this->addSql('DROP INDEX UNIQ_8D93D6499ADD062D ON user');
        $this->addSql('ALTER TABLE user DROP profil_solo_id, DROP roles');
    }
}
