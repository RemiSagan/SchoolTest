<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200228155641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE43471E7B003E9');
        $this->addSql('CREATE TABLE choose_specialty (choose_id INT NOT NULL, specialty_id INT NOT NULL, INDEX IDX_BE68C9092F3F124E (choose_id), INDEX IDX_BE68C9099A353316 (specialty_id), PRIMARY KEY(choose_id, specialty_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choose_specialty ADD CONSTRAINT FK_BE68C9092F3F124E FOREIGN KEY (choose_id) REFERENCES choose (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choose_specialty ADD CONSTRAINT FK_BE68C9099A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE study');
        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE43471A76ED395');
        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE43471E3AC3692');
        $this->addSql('DROP INDEX IDX_8FE43471E7B003E9 ON choose');
        $this->addSql('DROP INDEX IDX_8FE43471E3AC3692 ON choose');
        $this->addSql('DROP INDEX IDX_8FE43471A76ED395 ON choose');
        $this->addSql('ALTER TABLE choose ADD users_id INT DEFAULT NULL, DROP user_id, DROP specialties_id, DROP study_id');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE4347167B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FE4347167B3B43D ON choose (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE study (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, duration SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE choose_specialty');
        $this->addSql('ALTER TABLE choose DROP FOREIGN KEY FK_8FE4347167B3B43D');
        $this->addSql('DROP INDEX IDX_8FE4347167B3B43D ON choose');
        $this->addSql('ALTER TABLE choose ADD specialties_id INT DEFAULT NULL, ADD study_id INT DEFAULT NULL, CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE43471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE43471E3AC3692 FOREIGN KEY (specialties_id) REFERENCES specialty (id)');
        $this->addSql('ALTER TABLE choose ADD CONSTRAINT FK_8FE43471E7B003E9 FOREIGN KEY (study_id) REFERENCES study (id)');
        $this->addSql('CREATE INDEX IDX_8FE43471E7B003E9 ON choose (study_id)');
        $this->addSql('CREATE INDEX IDX_8FE43471E3AC3692 ON choose (specialties_id)');
        $this->addSql('CREATE INDEX IDX_8FE43471A76ED395 ON choose (user_id)');
    }
}
