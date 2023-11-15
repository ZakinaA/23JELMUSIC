<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115084937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve_responsable (eleve_id INT NOT NULL, responsable_id INT NOT NULL, INDEX IDX_D7350730A6CC7B2 (eleve_id), INDEX IDX_D735073053C59D72 (responsable_id), PRIMARY KEY(eleve_id, responsable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve_responsable ADD CONSTRAINT FK_D7350730A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_responsable ADD CONSTRAINT FK_D735073053C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat_pret ADD eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat_pret ADD CONSTRAINT FK_1FB84C67A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_1FB84C67A6CC7B2 ON contrat_pret (eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve_responsable DROP FOREIGN KEY FK_D7350730A6CC7B2');
        $this->addSql('ALTER TABLE eleve_responsable DROP FOREIGN KEY FK_D735073053C59D72');
        $this->addSql('DROP TABLE eleve_responsable');
        $this->addSql('ALTER TABLE contrat_pret DROP FOREIGN KEY FK_1FB84C67A6CC7B2');
        $this->addSql('DROP INDEX IDX_1FB84C67A6CC7B2 ON contrat_pret');
        $this->addSql('ALTER TABLE contrat_pret DROP eleve_id');
    }
}
