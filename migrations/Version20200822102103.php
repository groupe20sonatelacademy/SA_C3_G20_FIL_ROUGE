<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200822102103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE promo_brief (id INT AUTO_INCREMENT NOT NULL, brief_id INT DEFAULT NULL, promo_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_F6922C91757FABFF (brief_id), INDEX IDX_F6922C91D0C07AFF (promo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo_brief_apprenant (id INT AUTO_INCREMENT NOT NULL, promo_brief_id INT DEFAULT NULL, apprenant_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_A9D0C93CBDA08EC7 (promo_brief_id), INDEX IDX_A9D0C93CC5697D6D (apprenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promo_brief ADD CONSTRAINT FK_F6922C91757FABFF FOREIGN KEY (brief_id) REFERENCES brief (id)');
        $this->addSql('ALTER TABLE promo_brief ADD CONSTRAINT FK_F6922C91D0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
        $this->addSql('ALTER TABLE promo_brief_apprenant ADD CONSTRAINT FK_A9D0C93CBDA08EC7 FOREIGN KEY (promo_brief_id) REFERENCES promo_brief (id)');
        $this->addSql('ALTER TABLE promo_brief_apprenant ADD CONSTRAINT FK_A9D0C93CC5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promo_brief_apprenant DROP FOREIGN KEY FK_A9D0C93CBDA08EC7');
        $this->addSql('DROP TABLE promo_brief');
        $this->addSql('DROP TABLE promo_brief_apprenant');
    }
}
