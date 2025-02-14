<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204095952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE landing_page_tag (landing_page_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_838CFB02DF122DC5 (landing_page_id), INDEX IDX_838CFB02BAD26311 (tag_id), PRIMARY KEY(landing_page_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE landing_page_tag ADD CONSTRAINT FK_838CFB02DF122DC5 FOREIGN KEY (landing_page_id) REFERENCES landing_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_page_tag ADD CONSTRAINT FK_838CFB02BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_landing_page DROP FOREIGN KEY FK_27B1E39BBAD26311');
        $this->addSql('ALTER TABLE tag_landing_page DROP FOREIGN KEY FK_27B1E39BDF122DC5');
        $this->addSql('DROP TABLE tag_landing_page');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_landing_page (id INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, landing_page_id INT NOT NULL, INDEX IDX_27B1E39BBAD26311 (tag_id), INDEX IDX_27B1E39BDF122DC5 (landing_page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tag_landing_page ADD CONSTRAINT FK_27B1E39BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tag_landing_page ADD CONSTRAINT FK_27B1E39BDF122DC5 FOREIGN KEY (landing_page_id) REFERENCES landing_page (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE landing_page_tag DROP FOREIGN KEY FK_838CFB02DF122DC5');
        $this->addSql('ALTER TABLE landing_page_tag DROP FOREIGN KEY FK_838CFB02BAD26311');
        $this->addSql('DROP TABLE landing_page_tag');
    }
}
