<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328105514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B023E2E969B');
        $this->addSql('DROP INDEX IDX_74516B023E2E969B ON office');
        $this->addSql('ALTER TABLE office ADD image VARCHAR(255) DEFAULT NULL, CHANGE review_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B02A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_74516B02A76ED395 ON office (user_id)');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD telephone_number VARCHAR(255) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B02A76ED395');
        $this->addSql('DROP INDEX IDX_74516B02A76ED395 ON office');
        $this->addSql('ALTER TABLE office DROP image, CHANGE user_id review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B023E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_74516B023E2E969B ON office (review_id)');
        $this->addSql('ALTER TABLE `user` DROP first_name, DROP last_name, DROP telephone_number, DROP description');
    }
}
