<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328131600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495520A48C29');
        $this->addSql('DROP INDEX IDX_42C8495520A48C29 ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE invoiceid_id invoice_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_42C849552989F1FD ON reservation (invoice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552989F1FD');
        $this->addSql('DROP INDEX IDX_42C849552989F1FD ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE invoice_id invoiceid_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495520A48C29 FOREIGN KEY (invoiceid_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_42C8495520A48C29 ON reservation (invoiceid_id)');
    }
}
