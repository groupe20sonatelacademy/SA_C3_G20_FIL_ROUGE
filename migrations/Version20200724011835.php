<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200724011835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profils CHANGE archivage archivage INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE archivage archivage INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profils CHANGE archivage archivage INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE archivage archivage TINYINT(1) NOT NULL');
    }
}
