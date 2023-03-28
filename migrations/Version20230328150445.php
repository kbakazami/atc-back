<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328150445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office ADD review_id INT DEFAULT NULL, DROP officeid');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B023E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_74516B023E2E969B ON office (review_id)');
        $this->addSql('ALTER TABLE review ADD userid_id INT NOT NULL, ADD officeid_id INT DEFAULT NULL, ADD note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C658E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6CF8E4540 FOREIGN KEY (officeid_id) REFERENCES office (id)');
        $this->addSql('CREATE INDEX IDX_794381C658E0A285 ON review (userid_id)');
        $this->addSql('CREATE INDEX IDX_794381C6CF8E4540 ON review (officeid_id)');
        $this->addSql('ALTER TABLE user ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493E2E969B ON user (review_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B023E2E969B');
        $this->addSql('DROP INDEX IDX_74516B023E2E969B ON office');
        $this->addSql('ALTER TABLE office ADD officeid INT NOT NULL, DROP review_id');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C658E0A285');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6CF8E4540');
        $this->addSql('DROP INDEX IDX_794381C658E0A285 ON review');
        $this->addSql('DROP INDEX IDX_794381C6CF8E4540 ON review');
        $this->addSql('ALTER TABLE review DROP userid_id, DROP officeid_id, DROP note');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6493E2E969B');
        $this->addSql('DROP INDEX IDX_8D93D6493E2E969B ON `user`');
        $this->addSql('ALTER TABLE `user` DROP review_id');
    }
}
