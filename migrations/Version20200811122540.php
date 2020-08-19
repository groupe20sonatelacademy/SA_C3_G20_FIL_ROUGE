<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811122540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFB7A45358C');
        $this->addSql('DROP INDEX IDX_B0139AFB7A45358C ON promo');
        $this->addSql('ALTER TABLE promo DROP groupe_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promo ADD groupe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFB7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_B0139AFB7A45358C ON promo (groupe_id)');
    }
}
