<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216170609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, counterparty_id_id INT NOT NULL, number VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_E98F2859F62BC851 (counterparty_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_product (id INT AUTO_INCREMENT NOT NULL, contract_id_id INT NOT NULL, product_id_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, leftovers DOUBLE PRECISION NOT NULL, INDEX IDX_DB1B79653C450273 (contract_id_id), INDEX IDX_DB1B7965DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, contract_id_id INT NOT NULL, INDEX IDX_F52993983C450273 (contract_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_product (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, contract_id_id INT NOT NULL, order_id_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_223F76D6DE18E50B (product_id_id), INDEX IDX_223F76D63C450273 (contract_id_id), INDEX IDX_223F76D6FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859F62BC851 FOREIGN KEY (counterparty_id_id) REFERENCES counterparty (id)');
        $this->addSql('ALTER TABLE contract_product ADD CONSTRAINT FK_DB1B79653C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE contract_product ADD CONSTRAINT FK_DB1B7965DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993983C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE orders_product ADD CONSTRAINT FK_223F76D6DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orders_product ADD CONSTRAINT FK_223F76D63C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE orders_product ADD CONSTRAINT FK_223F76D6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE counterparty ADD inn INT DEFAULT NULL, ADD kpp INT DEFAULT NULL, ADD okpo INT DEFAULT NULL, ADD ogrn BIGINT DEFAULT NULL, ADD address LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract_product DROP FOREIGN KEY FK_DB1B79653C450273');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993983C450273');
        $this->addSql('ALTER TABLE orders_product DROP FOREIGN KEY FK_223F76D63C450273');
        $this->addSql('ALTER TABLE orders_product DROP FOREIGN KEY FK_223F76D6FCDAEAAA');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE contract_product');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE orders_product');
        $this->addSql('ALTER TABLE counterparty DROP inn, DROP kpp, DROP okpo, DROP ogrn, DROP address');
    }
}
