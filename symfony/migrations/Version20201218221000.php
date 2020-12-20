<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218221000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, counterparty_id INT NOT NULL, number VARCHAR(255) NOT NULL, date DATE NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_E98F2859DB1FAD05 (counterparty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_product (id INT AUTO_INCREMENT NOT NULL, contract_id INT NOT NULL, product_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, leftovers DOUBLE PRECISION NOT NULL, INDEX IDX_DB1B79652576E0FD (contract_id), INDEX IDX_DB1B79654584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE counterparty (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, fullname LONGTEXT DEFAULT NULL, inn BIGINT DEFAULT NULL, kpp BIGINT DEFAULT NULL, okpo BIGINT DEFAULT NULL, ogrn BIGINT DEFAULT NULL, address LONGTEXT DEFAULT NULL, INDEX IDX_9B3DE79CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, contract_id INT NOT NULL, INDEX IDX_F52993982576E0FD (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_product (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, contract_id INT NOT NULL, order_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_223F76D64584665A (product_id), INDEX IDX_223F76D62576E0FD (contract_id), INDEX IDX_223F76D68D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, fullname LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859DB1FAD05 FOREIGN KEY (counterparty_id) REFERENCES counterparty (id)');
        $this->addSql('ALTER TABLE contract_product ADD CONSTRAINT FK_DB1B79652576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE contract_product ADD CONSTRAINT FK_DB1B79654584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE counterparty ADD CONSTRAINT FK_9B3DE79CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993982576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE orders_product ADD CONSTRAINT FK_223F76D64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orders_product ADD CONSTRAINT FK_223F76D62576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE orders_product ADD CONSTRAINT FK_223F76D68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract_product DROP FOREIGN KEY FK_DB1B79652576E0FD');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993982576E0FD');
        $this->addSql('ALTER TABLE orders_product DROP FOREIGN KEY FK_223F76D62576E0FD');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859DB1FAD05');
        $this->addSql('ALTER TABLE orders_product DROP FOREIGN KEY FK_223F76D68D9F6D38');
        $this->addSql('ALTER TABLE contract_product DROP FOREIGN KEY FK_DB1B79654584665A');
        $this->addSql('ALTER TABLE orders_product DROP FOREIGN KEY FK_223F76D64584665A');
        $this->addSql('ALTER TABLE counterparty DROP FOREIGN KEY FK_9B3DE79CA76ED395');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE contract_product');
        $this->addSql('DROP TABLE counterparty');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE orders_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE `user`');
    }
}
