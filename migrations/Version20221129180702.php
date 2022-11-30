<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129180702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38723C105691');
        // $this->addSql('DROP INDEX IDX_B8EE38723C105691 ON club');
        // $this->addSql('ALTER TABLE club DROP coach_id');
        // $this->addSql('ALTER TABLE coach ADD club_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC61190A32 ON coach (club_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club ADD coach_id INT NOT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38723C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('CREATE INDEX IDX_B8EE38723C105691 ON club (coach_id)');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC61190A32');
        $this->addSql('DROP INDEX IDX_3F596DCC61190A32 ON coach');
        $this->addSql('ALTER TABLE coach DROP club_id');
    }
}
