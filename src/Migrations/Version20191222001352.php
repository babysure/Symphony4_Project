<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191222001352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE new_option (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, surface INTEGER NOT NULL, rooms INTEGER NOT NULL, bedrooms INTEGER NOT NULL, floor INTEGER NOT NULL, price INTEGER NOT NULL, heat INTEGER NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, sold BOOLEAN DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE property_new_option (property_id INTEGER NOT NULL, new_option_id INTEGER NOT NULL, PRIMARY KEY(property_id, new_option_id))');
        $this->addSql('CREATE INDEX IDX_17BD18A9549213EC ON property_new_option (property_id)');
        $this->addSql('CREATE INDEX IDX_17BD18A9955B1800 ON property_new_option (new_option_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE new_option');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_new_option');
        $this->addSql('DROP TABLE user');
    }
}
