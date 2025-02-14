<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212093110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, subject VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_archived TINYINT(1) NOT NULL, INDEX IDX_C0B9F90FF624B39D (sender_id), INDEX IDX_C0B9F90FCD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FF624B39D FOREIGN KEY (sender_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD discussion_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F1ADED311 ON message (discussion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1ADED311');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FF624B39D');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FCD53EDB6');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP INDEX IDX_B6BD307F1ADED311 ON message');
        $this->addSql('ALTER TABLE message DROP discussion_id');
    }
}
