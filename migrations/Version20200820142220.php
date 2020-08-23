<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200820142220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brief_livrable_attendus (brief_id INT NOT NULL, livrable_attendus_id INT NOT NULL, INDEX IDX_2402D7A2757FABFF (brief_id), INDEX IDX_2402D7A275D62BB4 (livrable_attendus_id), PRIMARY KEY(brief_id, livrable_attendus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brief_tag (brief_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_452A4F36757FABFF (brief_id), INDEX IDX_452A4F36BAD26311 (tag_id), PRIMARY KEY(brief_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brief_groupe (brief_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_5496297B757FABFF (brief_id), INDEX IDX_5496297B7A45358C (groupe_id), PRIMARY KEY(brief_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE brief_livrable_attendus ADD CONSTRAINT FK_2402D7A2757FABFF FOREIGN KEY (brief_id) REFERENCES brief (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief_livrable_attendus ADD CONSTRAINT FK_2402D7A275D62BB4 FOREIGN KEY (livrable_attendus_id) REFERENCES livrable_attendus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief_tag ADD CONSTRAINT FK_452A4F36757FABFF FOREIGN KEY (brief_id) REFERENCES brief (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief_tag ADD CONSTRAINT FK_452A4F36BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief_groupe ADD CONSTRAINT FK_5496297B757FABFF FOREIGN KEY (brief_id) REFERENCES brief (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief_groupe ADD CONSTRAINT FK_5496297B7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief ADD formateur_id INT DEFAULT NULL, ADD referentiel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE brief ADD CONSTRAINT FK_1FBB1007155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE brief ADD CONSTRAINT FK_1FBB1007805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id)');
        $this->addSql('CREATE INDEX IDX_1FBB1007155D8F51 ON brief (formateur_id)');
        $this->addSql('CREATE INDEX IDX_1FBB1007805DB139 ON brief (referentiel_id)');
        $this->addSql('ALTER TABLE niveau ADD brief_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B757FABFF FOREIGN KEY (brief_id) REFERENCES brief (id)');
        $this->addSql('CREATE INDEX IDX_4BDFF36B757FABFF ON niveau (brief_id)');
        $this->addSql('ALTER TABLE ressource ADD brief_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F4544757FABFF FOREIGN KEY (brief_id) REFERENCES brief (id)');
        $this->addSql('CREATE INDEX IDX_939F4544757FABFF ON ressource (brief_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE brief_livrable_attendus');
        $this->addSql('DROP TABLE brief_tag');
        $this->addSql('DROP TABLE brief_groupe');
        $this->addSql('ALTER TABLE brief DROP FOREIGN KEY FK_1FBB1007155D8F51');
        $this->addSql('ALTER TABLE brief DROP FOREIGN KEY FK_1FBB1007805DB139');
        $this->addSql('DROP INDEX IDX_1FBB1007155D8F51 ON brief');
        $this->addSql('DROP INDEX IDX_1FBB1007805DB139 ON brief');
        $this->addSql('ALTER TABLE brief DROP formateur_id, DROP referentiel_id');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B757FABFF');
        $this->addSql('DROP INDEX IDX_4BDFF36B757FABFF ON niveau');
        $this->addSql('ALTER TABLE niveau DROP brief_id');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F4544757FABFF');
        $this->addSql('DROP INDEX IDX_939F4544757FABFF ON ressource');
        $this->addSql('ALTER TABLE ressource DROP brief_id');
    }
}
