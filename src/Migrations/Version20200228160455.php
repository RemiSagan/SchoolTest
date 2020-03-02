<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200228160455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE4347167B3B43D');
        $this->addSql('DROP INDEX IDX_8FE4347167B3B43D ON choose');
        $this->addSql('ALTER TABLE choose CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE43471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FE43471A76ED395 ON choose (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE43471A76ED395');
        $this->addSql('DROP INDEX IDX_8FE43471A76ED395 ON choose');
        $this->addSql('ALTER TABLE choose CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE4347167B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FE4347167B3B43D ON choose (users_id)');
    }
}
