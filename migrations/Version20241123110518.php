<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123110518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, id_reservation_id INT DEFAULT NULL, note SMALLINT NOT NULL, commentaire VARCHAR(500) DEFAULT NULL, date_avis DATE NOT NULL, validation_avis TINYINT(1) NOT NULL, INDEX IDX_8F91ABF085542AE1 (id_reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, email_id INT NOT NULL, id_seance_id INT NOT NULL, nb_places INT NOT NULL, prix_total DOUBLE PRECISION NOT NULL, qr_code VARCHAR(255) NOT NULL, INDEX IDX_4DA239A832C1C9 (email_id), INDEX IDX_4DA239634CC6B3 (id_seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations_places (id INT AUTO_INCREMENT NOT NULL, id_place_id INT NOT NULL, id_reservation_id INT NOT NULL, INDEX IDX_CED0474A5D7D4E8C (id_place_id), INDEX IDX_CED0474A85542AE1 (id_reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF085542AE1 FOREIGN KEY (id_reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239A832C1C9 FOREIGN KEY (email_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239634CC6B3 FOREIGN KEY (id_seance_id) REFERENCES seances (id)');
        $this->addSql('ALTER TABLE reservations_places ADD CONSTRAINT FK_CED0474A5D7D4E8C FOREIGN KEY (id_place_id) REFERENCES places (id)');
        $this->addSql('ALTER TABLE reservations_places ADD CONSTRAINT FK_CED0474A85542AE1 FOREIGN KEY (id_reservation_id) REFERENCES reservations (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF085542AE1');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239A832C1C9');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239634CC6B3');
        $this->addSql('ALTER TABLE reservations_places DROP FOREIGN KEY FK_CED0474A5D7D4E8C');
        $this->addSql('ALTER TABLE reservations_places DROP FOREIGN KEY FK_CED0474A85542AE1');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reservations_places');
    }
}
