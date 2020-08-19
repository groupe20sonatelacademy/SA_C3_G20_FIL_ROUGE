<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810205524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE competence_niveau');
        $this->addSql('ALTER TABLE competence ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_94D4687FB3E9C81 ON competence (niveau_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence_niveau (competence_id INT NOT NULL, niveau_id INT NOT NULL, INDEX IDX_23C967715761DAB (competence_id), INDEX IDX_23C9677B3E9C81 (niveau_id), PRIMARY KEY(competence_id, niveau_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competence_niveau ADD CONSTRAINT FK_23C967715761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_niveau ADD CONSTRAINT FK_23C9677B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FB3E9C81');
        $this->addSql('DROP INDEX IDX_94D4687FB3E9C81 ON competence');
        $this->addSql('ALTER TABLE competence DROP niveau_id');
    }
}
