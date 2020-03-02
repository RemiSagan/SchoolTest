<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200228182508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE study (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, duration SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choose ADD study_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE43471E7B003E9 FOREIGN KEY (study_id) REFERENCES study (id)');
        $this->addSql('CREATE INDEX IDX_8FE43471E7B003E9 ON choose (study_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE43471E7B003E9');
        $this->addSql('DROP TABLE study');
        $this->addSql('DROP INDEX IDX_8FE43471E7B003E9 ON choose');
        $this->addSql('ALTER TABLE choose DROP study_id');
    }
}
