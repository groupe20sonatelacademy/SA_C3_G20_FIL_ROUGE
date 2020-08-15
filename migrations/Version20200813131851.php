<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200813131851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_formateur (groupe_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_BDE2AD787A45358C (groupe_id), INDEX IDX_BDE2AD78155D8F51 (formateur_id), PRIMARY KEY(groupe_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_formateur ADD CONSTRAINT FK_BDE2AD787A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_formateur ADD CONSTRAINT FK_BDE2AD78155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21155D8F51');
        $this->addSql('DROP INDEX IDX_4B98C21155D8F51 ON groupe');
        $this->addSql('ALTER TABLE groupe CHANGE formateur_id promotion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('CREATE INDEX IDX_4B98C21139DF194 ON groupe (promotion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE groupe_formateur');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21139DF194');
        $this->addSql('DROP INDEX IDX_4B98C21139DF194 ON groupe');
        $this->addSql('ALTER TABLE groupe CHANGE promotion_id formateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4B98C21155D8F51 ON groupe (formateur_id)');
    }
}
