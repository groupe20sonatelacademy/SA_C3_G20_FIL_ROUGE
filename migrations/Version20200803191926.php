<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803191926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, descriptif VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_competence_competence (id_competence_id INT NOT NULL, id_groupe_competence_id INT NOT NULL, INDEX IDX_F64AE85CAB5ECCCE (id_competence_id), INDEX IDX_F64AE85C85F3B994 (id_groupe_competence_id), PRIMARY KEY(id_competence_id, id_groupe_competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_competences (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, descriptif VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85CAB5ECCCE FOREIGN KEY (id_competence_id) REFERENCES competences (id)');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85C85F3B994 FOREIGN KEY (id_groupe_competence_id) REFERENCES groupe_competences (id)');
        $this->addSql('ALTER TABLE profils_de_sortie CHANGE archivage archivage TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competence_competence DROP FOREIGN KEY FK_F64AE85CAB5ECCCE');
        $this->addSql('ALTER TABLE groupe_competence_competence DROP FOREIGN KEY FK_F64AE85C85F3B994');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE groupe_competence_competence');
        $this->addSql('DROP TABLE groupe_competences');
        $this->addSql('ALTER TABLE profils_de_sortie CHANGE archivage archivage TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
