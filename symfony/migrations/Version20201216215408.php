<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216215408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859F62BC851');
        $this->addSql('DROP INDEX IDX_E98F2859F62BC851 ON contract');
        $this->addSql('ALTER TABLE contract CHANGE counterparty_id_id counterparty_id INT NOT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859DB1FAD05 FOREIGN KEY (counterparty_id) REFERENCES counterparty (id)');
        $this->addSql('CREATE INDEX IDX_E98F2859DB1FAD05 ON contract (counterparty_id)');
        $this->addSql('ALTER TABLE counterparty DROP FOREIGN KEY FK_9B3DE79CA76ED395');
        $this->addSql('DROP INDEX IDX_9B3DE79CA76ED395 ON counterparty');
        $this->addSql('ALTER TABLE counterparty CHANGE user_id user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE counterparty ADD CONSTRAINT FK_9B3DE79C8D93D649 FOREIGN KEY (user) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_9B3DE79C8D93D649 ON counterparty (user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859DB1FAD05');
        $this->addSql('DROP INDEX IDX_E98F2859DB1FAD05 ON contract');
        $this->addSql('ALTER TABLE contract CHANGE counterparty_id counterparty_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859F62BC851 FOREIGN KEY (counterparty_id_id) REFERENCES counterparty (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E98F2859F62BC851 ON contract (counterparty_id_id)');
        $this->addSql('ALTER TABLE counterparty DROP FOREIGN KEY FK_9B3DE79C8D93D649');
        $this->addSql('DROP INDEX IDX_9B3DE79C8D93D649 ON counterparty');
        $this->addSql('ALTER TABLE counterparty CHANGE user user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE counterparty ADD CONSTRAINT FK_9B3DE79CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9B3DE79CA76ED395 ON counterparty (user_id)');
    }
}
