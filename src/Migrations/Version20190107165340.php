<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107165340 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DC06A9F55');
        $this->addSql('DROP TABLE img_post');
        $this->addSql('DROP INDEX UNIQ_5A8A6C8DC06A9F55 ON post');
        $this->addSql('ALTER TABLE post ADD image VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, DROP img_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE img_post (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD img_id INT DEFAULT NULL, DROP image, DROP updated_at');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DC06A9F55 FOREIGN KEY (img_id) REFERENCES img_post (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8DC06A9F55 ON post (img_id)');
    }
}
