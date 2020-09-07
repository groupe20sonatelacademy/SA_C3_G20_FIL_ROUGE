<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831071952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fil_discussion ADD livrable_partiel_apprenant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fil_discussion ADD CONSTRAINT FK_C9EFF4FC5467F92D FOREIGN KEY (livrable_partiel_apprenant_id) REFERENCES livrable_partiel_apprenant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9EFF4FC5467F92D ON fil_discussion (livrable_partiel_apprenant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fil_discussion DROP FOREIGN KEY FK_C9EFF4FC5467F92D');
        $this->addSql('DROP INDEX UNIQ_C9EFF4FC5467F92D ON fil_discussion');
        $this->addSql('ALTER TABLE fil_discussion DROP livrable_partiel_apprenant_id');
    }
}
