<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181220200513 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE collection (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, politicid_id INT NOT NULL, INDEX IDX_FC4D653258E0A285 (userid_id), INDEX IDX_FC4D6532A69A7486 (politicid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE politic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, party VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, rarity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, ballots_number INT DEFAULT NULL, last_claim DATETIME DEFAULT NULL, is_admin TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D653258E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532A69A7486 FOREIGN KEY (politicid_id) REFERENCES politic (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D6532A69A7486');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D653258E0A285');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE politic');
        $this->addSql('DROP TABLE user');
    }
}
