<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123095214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cinemas (id INT AUTO_INCREMENT NOT NULL, nom_cinema VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, numero_gsm VARCHAR(255) NOT NULL, horaires VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, age_mini INT NOT NULL, note DOUBLE PRECISION NOT NULL, coup_coeur TINYINT(1) NOT NULL, genre JSON NOT NULL, affiche VARCHAR(255) NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salles (id INT AUTO_INCREMENT NOT NULL, id_cinema INT NOT NULL, qualite_projection VARCHAR(255) NOT NULL, INDEX IDX_799D45AA34FE3891 (id_cinema), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA34FE3891 FOREIGN KEY (id_cinema) REFERENCES cinemas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA34FE3891');
        $this->addSql('DROP TABLE cinemas');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE salles');
    }
}
