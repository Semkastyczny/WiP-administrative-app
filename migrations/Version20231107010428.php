<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107010428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, id_position_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_verified BOOLEAN NOT NULL, username VARCHAR(255) NOT NULL, testing_systems VARCHAR(255) DEFAULT NULL, raporting_systems VARCHAR(255) DEFAULT NULL, selenium BOOLEAN DEFAULT false NOT NULL, ide_environments VARCHAR(255) DEFAULT NULL, programming_languages VARCHAR(255) DEFAULT NULL, mysql BOOLEAN DEFAULT false, methodologies VARCHAR(255) DEFAULT NULL, scrum BOOLEAN DEFAULT false, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE INDEX IDX_8D93D649C596E3B1 ON "user" (id_position_id)');
        $this->addSql('CREATE TABLE user_position (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649C596E3B1 FOREIGN KEY (id_position_id) REFERENCES user_position (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649C596E3B1');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_position');
    }
}
