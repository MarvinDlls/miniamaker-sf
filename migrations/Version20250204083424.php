<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204083424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ip_content (id INT AUTO_INCREMENT NOT NULL, landing_page_id INT NOT NULL, content LONGTEXT NOT NULL, excerpt VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D1748AA4DF122DC5 (landing_page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE landing_page (id INT AUTO_INCREMENT NOT NULL, detail_id INT NOT NULL, type VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_87A7C899D8D003BB (detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo (id INT AUTO_INCREMENT NOT NULL, subscription_id INT NOT NULL, name VARCHAR(80) NOT NULL, percent BIGINT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B0139AFB9A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, pro_id INT NOT NULL, is_active TINYINT(1) NOT NULL, amount BIGINT NOT NULL, frequency VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_A3C664D3C3B7E4BA (pro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_landing_page (id INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, landing_page_id_id INT NOT NULL, INDEX IDX_27B1E39BBAD26311 (tag_id), INDEX IDX_27B1E39B22B6BAE3 (landing_page_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ip_content ADD CONSTRAINT FK_D1748AA4DF122DC5 FOREIGN KEY (landing_page_id) REFERENCES landing_page (id)');
        $this->addSql('ALTER TABLE landing_page ADD CONSTRAINT FK_87A7C899D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFB9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3C3B7E4BA FOREIGN KEY (pro_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE tag_landing_page ADD CONSTRAINT FK_27B1E39BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE tag_landing_page ADD CONSTRAINT FK_27B1E39B22B6BAE3 FOREIGN KEY (landing_page_id_id) REFERENCES landing_page (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ip_content DROP FOREIGN KEY FK_D1748AA4DF122DC5');
        $this->addSql('ALTER TABLE landing_page DROP FOREIGN KEY FK_87A7C899D8D003BB');
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFB9A1887DC');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3C3B7E4BA');
        $this->addSql('ALTER TABLE tag_landing_page DROP FOREIGN KEY FK_27B1E39BBAD26311');
        $this->addSql('ALTER TABLE tag_landing_page DROP FOREIGN KEY FK_27B1E39B22B6BAE3');
        $this->addSql('DROP TABLE ip_content');
        $this->addSql('DROP TABLE landing_page');
        $this->addSql('DROP TABLE promo');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_landing_page');
    }
}
