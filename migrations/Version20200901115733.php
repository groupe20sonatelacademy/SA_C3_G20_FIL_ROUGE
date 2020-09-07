<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901115733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistique DROP FOREIGN KEY FK_73A038ADC72617F3');
        $this->addSql('DROP INDEX IDX_73A038ADC72617F3 ON statistique');
        $this->addSql('ALTER TABLE statistique CHANGE commetence_id competence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT FK_73A038AD15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_73A038AD15761DAB ON statistique (competence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistique DROP FOREIGN KEY FK_73A038AD15761DAB');
        $this->addSql('DROP INDEX IDX_73A038AD15761DAB ON statistique');
        $this->addSql('ALTER TABLE statistique CHANGE competence_id commetence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT FK_73A038ADC72617F3 FOREIGN KEY (commetence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_73A038ADC72617F3 ON statistique (commetence_id)');
    }
}
