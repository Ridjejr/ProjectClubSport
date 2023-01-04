<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104121941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adherent (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, telephone INT NOT NULL, email VARCHAR(255) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(255) NOT NULL, cp INT NOT NULL, ville VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, num_rue INT NOT NULL, rue VARCHAR(255) NOT NULL, cp INT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_3F596DCC61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrainement (id INT AUTO_INCREMENT NOT NULL, objectif VARCHAR(255) NOT NULL, equipements VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrainement_adherent (entrainement_id INT NOT NULL, adherent_id INT NOT NULL, INDEX IDX_2F96F96EA15E8FD (entrainement_id), INDEX IDX_2F96F96E25F06C53 (adherent_id), PRIMARY KEY(entrainement_id, adherent_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, adherent_id INT NOT NULL, coach_id INT NOT NULL, club_id INT NOT NULL, date_r DATE NOT NULL, heure_r TIME NOT NULL, INDEX IDX_42C8495525F06C53 (adherent_id), INDEX IDX_42C849553C105691 (coach_id), INDEX IDX_42C8495561190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE entrainement_adherent ADD CONSTRAINT FK_2F96F96EA15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entrainement_adherent ADD CONSTRAINT FK_2F96F96E25F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495525F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849553C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrainement_adherent DROP FOREIGN KEY FK_2F96F96E25F06C53');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495525F06C53');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC61190A32');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495561190A32');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553C105691');
        $this->addSql('ALTER TABLE entrainement_adherent DROP FOREIGN KEY FK_2F96F96EA15E8FD');
        $this->addSql('DROP TABLE adherent');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE entrainement');
        $this->addSql('DROP TABLE entrainement_adherent');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
