<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720131224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_880E0D76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apprenants (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, adresse VARCHAR(100) NOT NULL, statut VARCHAR(20) NOT NULL, info_complementaire VARCHAR(255) DEFAULT NULL, categorie VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_C71C2982A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cm (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_3C0A377EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateurs (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_FD80E574A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, genre VARCHAR(10) NOT NULL, login VARCHAR(50) NOT NULL, pwd VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, telephone VARCHAR(20) NOT NULL, photo VARCHAR(255) NOT NULL, profil VARCHAR(30) NOT NULL, archivage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE apprenants ADD CONSTRAINT FK_C71C2982A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE cm ADD CONSTRAINT FK_3C0A377EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE formateurs ADD CONSTRAINT FK_FD80E574A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76A76ED395');
        $this->addSql('ALTER TABLE apprenants DROP FOREIGN KEY FK_C71C2982A76ED395');
        $this->addSql('ALTER TABLE cm DROP FOREIGN KEY FK_3C0A377EA76ED395');
        $this->addSql('ALTER TABLE formateurs DROP FOREIGN KEY FK_FD80E574A76ED395');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE apprenants');
        $this->addSql('DROP TABLE cm');
        $this->addSql('DROP TABLE formateurs');
        $this->addSql('DROP TABLE users');
    }
}
