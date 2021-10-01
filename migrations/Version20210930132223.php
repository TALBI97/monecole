<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210930132223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081679F37AE5');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96571DFEF9');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96571DFEF9 FOREIGN KEY (instituteur_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A4225AB72B27');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A4225AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE mot_passe_oublie CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081679F37AE5');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96571DFEF9');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96571DFEF9 FOREIGN KEY (instituteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE line_class_eleve DROP FOREIGN KEY FK_3D10A4225AB72B27');
        $this->addSql('ALTER TABLE line_class_eleve ADD CONSTRAINT FK_3D10A4225AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mot_passe_oublie CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
