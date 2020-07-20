<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720133735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profils (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, archivage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD profil_id INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9275ED078 FOREIGN KEY (profil_id) REFERENCES profils (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9275ED078 ON users (profil_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9275ED078');
        $this->addSql('DROP TABLE profils');
        $this->addSql('DROP INDEX IDX_1483A5E9275ED078 ON users');
        $this->addSql('ALTER TABLE users DROP profil_id');
    }
}
