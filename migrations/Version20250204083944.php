<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204083944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_landing_page DROP FOREIGN KEY FK_27B1E39B22B6BAE3');
        $this->addSql('DROP INDEX IDX_27B1E39B22B6BAE3 ON tag_landing_page');
        $this->addSql('ALTER TABLE tag_landing_page DROP landing_page_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_landing_page ADD landing_page_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE tag_landing_page ADD CONSTRAINT FK_27B1E39B22B6BAE3 FOREIGN KEY (landing_page_id_id) REFERENCES landing_page (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_27B1E39B22B6BAE3 ON tag_landing_page (landing_page_id_id)');
    }
}
