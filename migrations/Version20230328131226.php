<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328131226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF5B7AF75');
        $this->addSql('ALTER TABLE office DROP FOREIGN KEY FK_74516B02F5B7AF75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP INDEX UNIQ_4FBF094FF5B7AF75 ON company');
        $this->addSql('ALTER TABLE company ADD address LONGTEXT NOT NULL, DROP address_id');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744CF8E4540');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174458E0A285');
        $this->addSql('DROP INDEX IDX_90651744CF8E4540 ON invoice');
        $this->addSql('DROP INDEX IDX_9065174458E0A285 ON invoice');
        $this->addSql('ALTER TABLE invoice ADD user_id INT NOT NULL, ADD office_id INT NOT NULL, DROP userid_id, DROP officeid_id');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744FFA0C224 FOREIGN KEY (office_id) REFERENCES office (id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('CREATE INDEX IDX_90651744FFA0C224 ON invoice (office_id)');
        $this->addSql('DROP INDEX IDX_74516B02F5B7AF75 ON office');
        $this->addSql('ALTER TABLE office DROP address_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955CF8E4540');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495558E0A285');
        $this->addSql('DROP INDEX IDX_42C8495558E0A285 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955CF8E4540 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD user_id INT NOT NULL, ADD office_id INT NOT NULL, DROP userid_id, DROP officeid_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FFA0C224 FOREIGN KEY (office_id) REFERENCES office (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE INDEX IDX_42C84955FFA0C224 ON reservation (office_id)');
        $this->addSql('DROP INDEX IDX_8D93D649F5B7AF75 ON user');
        $this->addSql('ALTER TABLE user DROP address_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, zip_code INT NOT NULL, street VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE company ADD address_id INT NOT NULL, DROP address');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FF5B7AF75 ON company (address_id)');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744A76ED395');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744FFA0C224');
        $this->addSql('DROP INDEX IDX_90651744A76ED395 ON invoice');
        $this->addSql('DROP INDEX IDX_90651744FFA0C224 ON invoice');
        $this->addSql('ALTER TABLE invoice ADD userid_id INT NOT NULL, ADD officeid_id INT NOT NULL, DROP user_id, DROP office_id');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744CF8E4540 FOREIGN KEY (officeid_id) REFERENCES office (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174458E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_90651744CF8E4540 ON invoice (officeid_id)');
        $this->addSql('CREATE INDEX IDX_9065174458E0A285 ON invoice (userid_id)');
        $this->addSql('ALTER TABLE office ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE office ADD CONSTRAINT FK_74516B02F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_74516B02F5B7AF75 ON office (address_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FFA0C224');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955FFA0C224 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD userid_id INT NOT NULL, ADD officeid_id INT NOT NULL, DROP user_id, DROP office_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955CF8E4540 FOREIGN KEY (officeid_id) REFERENCES office (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495558E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C8495558E0A285 ON reservation (userid_id)');
        $this->addSql('CREATE INDEX IDX_42C84955CF8E4540 ON reservation (officeid_id)');
        $this->addSql('ALTER TABLE `user` ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F5B7AF75 ON `user` (address_id)');
    }
}
