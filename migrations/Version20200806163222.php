<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200806163222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_competences_tags (groupe_competences_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_DE300BB9C1218EC1 (groupe_competences_id), INDEX IDX_DE300BB98D7B4FB4 (tags_id), PRIMARY KEY(groupe_competences_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, libell� VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_competences_tags ADD CONSTRAINT FK_DE300BB9C1218EC1 FOREIGN KEY (groupe_competences_id) REFERENCES groupe_competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_competences_tags ADD CONSTRAINT FK_DE300BB98D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competences_tags DROP FOREIGN KEY FK_DE300BB98D7B4FB4');
        $this->addSql('DROP TABLE groupe_competences_tags');
        $this->addSql('DROP TABLE tags');
    }
}
