<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519183528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere ADD color VARCHAR(7) DEFAULT NULL');
        $this->addSql('ALTER TABLE modele_matiere ADD CONSTRAINT FK_9599AD98AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_matiere ADD CONSTRAINT FK_9599AD98F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_gamme_usinage ADD CONSTRAINT FK_8C6E4E07AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_gamme_usinage ADD CONSTRAINT FK_8C6E4E074AA88651 FOREIGN KEY (gamme_usinage_id) REFERENCES gamme_usinage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_energie ADD CONSTRAINT FK_270A2072AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_energie ADD CONSTRAINT FK_270A2072B732A364 FOREIGN KEY (energie_id) REFERENCES energie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_accessoire ADD CONSTRAINT FK_FBAA159BAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_accessoire ADD CONSTRAINT FK_FBAA159BD23B67ED FOREIGN KEY (accessoire_id) REFERENCES accessoire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere DROP color');
        $this->addSql('ALTER TABLE modele_accessoire DROP FOREIGN KEY FK_FBAA159BAC14B70A');
        $this->addSql('ALTER TABLE modele_accessoire DROP FOREIGN KEY FK_FBAA159BD23B67ED');
        $this->addSql('ALTER TABLE modele_energie DROP FOREIGN KEY FK_270A2072AC14B70A');
        $this->addSql('ALTER TABLE modele_energie DROP FOREIGN KEY FK_270A2072B732A364');
        $this->addSql('ALTER TABLE modele_gamme_usinage DROP FOREIGN KEY FK_8C6E4E07AC14B70A');
        $this->addSql('ALTER TABLE modele_gamme_usinage DROP FOREIGN KEY FK_8C6E4E074AA88651');
        $this->addSql('ALTER TABLE modele_matiere DROP FOREIGN KEY FK_9599AD98AC14B70A');
        $this->addSql('ALTER TABLE modele_matiere DROP FOREIGN KEY FK_9599AD98F46CD258');
    }
}
