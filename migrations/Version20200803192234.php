<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803192234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competence_competence DROP FOREIGN KEY FK_F64AE85C85F3B994');
        $this->addSql('ALTER TABLE groupe_competence_competence DROP FOREIGN KEY FK_F64AE85CAB5ECCCE');
        $this->addSql('DROP INDEX IDX_F64AE85C85F3B994 ON groupe_competence_competence');
        $this->addSql('DROP INDEX IDX_F64AE85CAB5ECCCE ON groupe_competence_competence');
        $this->addSql('ALTER TABLE groupe_competence_competence DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD competence_id INT NOT NULL, ADD groupe_competence_id INT NOT NULL, DROP id_competence_id, DROP id_groupe_competence_id');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85C15761DAB FOREIGN KEY (competence_id) REFERENCES competences (id)');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85C89034830 FOREIGN KEY (groupe_competence_id) REFERENCES groupe_competences (id)');
        $this->addSql('CREATE INDEX IDX_F64AE85C15761DAB ON groupe_competence_competence (competence_id)');
        $this->addSql('CREATE INDEX IDX_F64AE85C89034830 ON groupe_competence_competence (groupe_competence_id)');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD PRIMARY KEY (competence_id, groupe_competence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competence_competence DROP FOREIGN KEY FK_F64AE85C15761DAB');
        $this->addSql('ALTER TABLE groupe_competence_competence DROP FOREIGN KEY FK_F64AE85C89034830');
        $this->addSql('DROP INDEX IDX_F64AE85C15761DAB ON groupe_competence_competence');
        $this->addSql('DROP INDEX IDX_F64AE85C89034830 ON groupe_competence_competence');
        $this->addSql('ALTER TABLE groupe_competence_competence DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD id_competence_id INT NOT NULL, ADD id_groupe_competence_id INT NOT NULL, DROP competence_id, DROP groupe_competence_id');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85C85F3B994 FOREIGN KEY (id_groupe_competence_id) REFERENCES groupe_competences (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD CONSTRAINT FK_F64AE85CAB5ECCCE FOREIGN KEY (id_competence_id) REFERENCES competences (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F64AE85C85F3B994 ON groupe_competence_competence (id_groupe_competence_id)');
        $this->addSql('CREATE INDEX IDX_F64AE85CAB5ECCCE ON groupe_competence_competence (id_competence_id)');
        $this->addSql('ALTER TABLE groupe_competence_competence ADD PRIMARY KEY (id_competence_id, id_groupe_competence_id)');
    }
}
