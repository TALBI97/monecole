<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719133639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE line_class_eleve (id INT AUTO_INCREMENT NOT NULL, id_classe_id INT DEFAULT NULL, id_eleve_id INT DEFAULT NULL, INDEX IDX_3D10A422F6B192E (id_classe_id), INDEX IDX_3D10A4225AB72B27 (id_eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A422F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A4225AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE line_class_eleve');
    }
}
