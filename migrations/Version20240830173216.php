<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830173216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lagerort (id INT AUTO_INCREMENT NOT NULL, kurzbeschreibung VARCHAR(255) NOT NULL, etage VARCHAR(255) NOT NULL, raum VARCHAR(255) NOT NULL, schranknummer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mikroskop ADD lagerort_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mikroskop ADD CONSTRAINT FK_DFD0B063D37F7C24 FOREIGN KEY (lagerort_id) REFERENCES lagerort (id)');
        $this->addSql('CREATE INDEX IDX_DFD0B063D37F7C24 ON mikroskop (lagerort_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mikroskop DROP FOREIGN KEY FK_DFD0B063D37F7C24');
        $this->addSql('DROP TABLE lagerort');
        $this->addSql('DROP INDEX IDX_DFD0B063D37F7C24 ON mikroskop');
        $this->addSql('ALTER TABLE mikroskop DROP lagerort_id');
    }
}
