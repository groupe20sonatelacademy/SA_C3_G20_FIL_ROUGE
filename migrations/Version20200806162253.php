<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200806162253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_competences_competences (groupe_competences_id INT NOT NULL, competences_id INT NOT NULL, INDEX IDX_FF48A1E1C1218EC1 (groupe_competences_id), INDEX IDX_FF48A1E1A660B158 (competences_id), PRIMARY KEY(groupe_competences_id, competences_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_competences_competences ADD CONSTRAINT FK_FF48A1E1C1218EC1 FOREIGN KEY (groupe_competences_id) REFERENCES groupe_competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_competences_competences ADD CONSTRAINT FK_FF48A1E1A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE groupe_competence_competence');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_competence_competence (competence_id INT NOT NULL, groupe_competence_id INT NOT NULL, INDEX IDX_F64AE85C15761DAB (competence_id), INDEX IDX_F64AE85C89034830 (groupe_competence_id), PRIMARY KEY(competence_id, groupe_competence_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85C15761DAB FOREIGN KEY (competence_id) REFERENCES competences (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85C89034830 FOREIGN KEY (groupe_competence_id) REFERENCES groupe_competences (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE groupe_competences_competences');
    }
}
