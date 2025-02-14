<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210132802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail CHANGE city city VARCHAR(255) NOT NULL, CHANGE strikes strikes INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE is_minor is_major TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail CHANGE city city VARCHAR(80) NOT NULL, CHANGE strikes strikes BIGINT NOT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE is_major is_minor TINYINT(1) NOT NULL');
    }
}
