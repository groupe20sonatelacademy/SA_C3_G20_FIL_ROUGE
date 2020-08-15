<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200812182043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_apprenants DROP FOREIGN KEY FK_7FF1185E7A45358C');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_apprenants');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, formateur_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_4B98C21155D8F51 (formateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE groupe_apprenants (groupe_id INT NOT NULL, apprenants_id INT NOT NULL, INDEX IDX_7FF1185E7A45358C (groupe_id), INDEX IDX_7FF1185ED4B7C9BD (apprenants_id), PRIMARY KEY(groupe_id, apprenants_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe_apprenants ADD CONSTRAINT FK_7FF1185E7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_apprenants ADD CONSTRAINT FK_7FF1185ED4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES apprenants (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
