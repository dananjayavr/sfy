<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190617121021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE friend_hobby (friend_id INT NOT NULL, hobby_id INT NOT NULL, INDEX IDX_99F46B936A5458E8 (friend_id), INDEX IDX_99F46B93322B2123 (hobby_id), PRIMARY KEY(friend_id, hobby_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friend_hobby ADD CONSTRAINT FK_99F46B936A5458E8 FOREIGN KEY (friend_id) REFERENCES friend (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE friend_hobby ADD CONSTRAINT FK_99F46B93322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE friend_hobby');
    }
}
