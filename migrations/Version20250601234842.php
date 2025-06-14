<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250601234842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE project ADD is_viewable TINYINT(1) DEFAULT 1 NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE project DROP is_viewable
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL
        SQL);
    }
}
