<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827112956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD formateur_id INT DEFAULT NULL, ADD fildiscussion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC1A5762D FOREIGN KEY (fildiscussion_id) REFERENCES fil_discussion (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC155D8F51 ON commentaire (formateur_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC1A5762D ON commentaire (fildiscussion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC155D8F51');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC1A5762D');
        $this->addSql('DROP INDEX IDX_67F068BC155D8F51 ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BC1A5762D ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP formateur_id, DROP fildiscussion_id');
    }
}
