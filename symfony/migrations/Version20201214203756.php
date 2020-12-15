<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201214203756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE counterparty DROP FOREIGN KEY FK_9B3DE79C9D86650F');
        $this->addSql('DROP INDEX UNIQ_9B3DE79C9D86650F ON counterparty');
        $this->addSql('ALTER TABLE counterparty ADD user_id INT DEFAULT NULL, DROP user_id_id');
        $this->addSql('ALTER TABLE counterparty ADD CONSTRAINT FK_9B3DE79CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_9B3DE79CA76ED395 ON counterparty (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE counterparty DROP FOREIGN KEY FK_9B3DE79CA76ED395');
        $this->addSql('DROP INDEX IDX_9B3DE79CA76ED395 ON counterparty');
        $this->addSql('ALTER TABLE counterparty ADD user_id_id INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE counterparty ADD CONSTRAINT FK_9B3DE79C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B3DE79C9D86650F ON counterparty (user_id_id)');
    }
}
