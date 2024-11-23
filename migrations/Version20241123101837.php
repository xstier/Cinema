<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123101837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, handicap TINYINT(1) NOT NULL, rangee INT NOT NULL, INDEX IDX_FEAF6C558CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seances (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, id_film_id INT NOT NULL, date_seance DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_FC699FF18CEBACA0 (id_salle_id), INDEX IDX_FC699FF188E2F8F3 (id_film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C558CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE seances ADD CONSTRAINT FK_FC699FF18CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE seances ADD CONSTRAINT FK_FC699FF188E2F8F3 FOREIGN KEY (id_film_id) REFERENCES films (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C558CEBACA0');
        $this->addSql('ALTER TABLE seances DROP FOREIGN KEY FK_FC699FF18CEBACA0');
        $this->addSql('ALTER TABLE seances DROP FOREIGN KEY FK_FC699FF188E2F8F3');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP TABLE seances');
    }
}
