<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330102905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office ADD is_fiber TINYINT(1) NOT NULL, ADD is_computer TINYINT(1) NOT NULL, ADD is_screen TINYINT(1) NOT NULL, ADD is_mouse_keyboard TINYINT(1) NOT NULL, ADD is_kitchen TINYINT(1) NOT NULL, ADD is_published TINYINT(1) NOT NULL, DROP duration');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE office ADD duration VARCHAR(255) DEFAULT NULL, DROP is_fiber, DROP is_computer, DROP is_screen, DROP is_mouse_keyboard, DROP is_kitchen, DROP is_published');
    }
}
