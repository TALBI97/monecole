<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723134027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A422F6B192E');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A422F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A422F6B192E');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A422F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
    }
}
