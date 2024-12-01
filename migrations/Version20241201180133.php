<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201180133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA34FE3891');
        $this->addSql('DROP INDEX FK_799D45AA34FE3891 ON salles');
        $this->addSql('ALTER TABLE salles CHANGE id_cinema INT NOT NULL');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA34FE3891 FOREIGN KEY (id_cinema) REFERENCES cinemas (id)');
        $this->addSql('CREATE INDEX IDX_799D45AA34FE3891 ON salles (id_cinema)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA34FE3891');
        $this->addSql('DROP INDEX IDX_799D45AA34FE3891 ON salles');
        $this->addSql('ALTER TABLE salles CHANGE id_cinema INT NOT NULL');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA34FE3891 FOREIGN KEY (id_cinema) REFERENCES cinemas (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX FK_799D45AA34FE3891 ON salles (id_cinema)');
    }
}
