<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330082141 extends AbstractMigration
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
        $this->addSql('ALTER TABLE office ADD description LONGTEXT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, DROP review_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493E2E969B');
        $this->addSql('DROP INDEX IDX_8D93D6493E2E969B ON user');
        $this->addSql('ALTER TABLE user DROP review_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office ADD review_id INT DEFAULT NULL, DROP description, DROP name');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B023E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_74516B023E2E969B ON office (review_id)');
        $this->addSql('ALTER TABLE `user` ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6493E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493E2E969B ON `user` (review_id)');
    }
}
