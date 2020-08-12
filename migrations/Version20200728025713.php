<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728025713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenants ADD profil_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apprenants ADD CONSTRAINT FK_C71C298265E0C4D3 FOREIGN KEY (profil_de_sortie_id) REFERENCES profils_de_sortie (id)');
        $this->addSql('CREATE INDEX IDX_C71C298265E0C4D3 ON apprenants (profil_de_sortie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenants DROP FOREIGN KEY FK_C71C298265E0C4D3');
        $this->addSql('DROP INDEX IDX_C71C298265E0C4D3 ON apprenants');
        $this->addSql('ALTER TABLE apprenants DROP profil_de_sortie_id');
    }
}
