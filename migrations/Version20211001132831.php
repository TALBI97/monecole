<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001132831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bultein DROP FOREIGN KEY FK_321C263DA6CC7B2');
        $this->addSql('ALTER TABLE bultein CHANGE eleve_id eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bultein ADD CONSTRAINT FK_321C263DA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96571DFEF9');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96571DFEF9 FOREIGN KEY (instituteur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A4225AB72B27');
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A422F6B192E');
        $this->addSql('ALTER TABLE line_class_eleve CHANGE id_classe_id id_classe_id INT DEFAULT NULL, CHANGE id_eleve_id id_eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A4225AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A422F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bultein DROP FOREIGN KEY FK_321C263DA6CC7B2');
        $this->addSql('ALTER TABLE bultein CHANGE eleve_id eleve_id INT NOT NULL');
        $this->addSql('ALTER TABLE bultein ADD CONSTRAINT FK_321C263DA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96571DFEF9');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96571DFEF9 FOREIGN KEY (instituteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A422F6B192E');
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A4225AB72B27');
        $this->addSql('ALTER TABLE line_class_eleve CHANGE id_classe_id id_classe_id INT NOT NULL, CHANGE id_eleve_id id_eleve_id INT NOT NULL');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A422F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A4225AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES user (id)');
    }
}
