<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328100722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, logo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, officeid_id INT NOT NULL, INDEX IDX_9065174458E0A285 (userid_id), INDEX IDX_90651744CF8E4540 (officeid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE office (id INT AUTO_INCREMENT NOT NULL, review_id INT DEFAULT NULL, officeid INT NOT NULL, price INT NOT NULL, surface NUMERIC(10, 0) NOT NULL, duration VARCHAR(255) DEFAULT NULL, INDEX IDX_74516B023E2E969B (review_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, officeid_id INT NOT NULL, invoiceid_id INT NOT NULL, date DATE NOT NULL, time_slot VARCHAR(255) NOT NULL, INDEX IDX_42C8495558E0A285 (userid_id), INDEX IDX_42C84955CF8E4540 (officeid_id), INDEX IDX_42C8495520A48C29 (invoiceid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, message VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174458E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744CF8E4540 FOREIGN KEY (officeid_id) REFERENCES office (id)');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B023E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495558E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955CF8E4540 FOREIGN KEY (officeid_id) REFERENCES office (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495520A48C29 FOREIGN KEY (invoiceid_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE user ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493E2E969B ON user (review_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6493E2E969B');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174458E0A285');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744CF8E4540');
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B023E2E969B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495558E0A285');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955CF8E4540');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495520A48C29');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE office');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP INDEX IDX_8D93D6493E2E969B ON `user`');
        $this->addSql('ALTER TABLE `user` DROP review_id');
    }
}
