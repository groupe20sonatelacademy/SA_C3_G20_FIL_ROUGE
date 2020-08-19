<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200808150001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, profilsortie_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, statut VARCHAR(25) NOT NULL, categorie VARCHAR(30) NOT NULL, infocomplementaitre VARCHAR(255) NOT NULL, INDEX IDX_C4EB462EFE5BE99E (profilsortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profilsortie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, archivage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EFE5BE99E FOREIGN KEY (profilsortie_id) REFERENCES profilsortie (id)');
        $this->addSql('ALTER TABLE user ADD Profil VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EFE5BE99E');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE profilsortie');
        $this->addSql('ALTER TABLE user DROP Profil');
    }
}
