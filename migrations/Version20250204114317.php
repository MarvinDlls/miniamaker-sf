<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204114317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3C3B7E4BA');
        $this->addSql('DROP INDEX UNIQ_A3C664D3C3B7E4BA ON subscription');
        $this->addSql('ALTER TABLE subscription DROP pro_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription ADD pro_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3C3B7E4BA FOREIGN KEY (pro_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A3C664D3C3B7E4BA ON subscription (pro_id)');
    }
}
