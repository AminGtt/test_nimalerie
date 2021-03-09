<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303084740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_child TINYINT(1) NOT NULL, parent_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_product (categorie_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_8CC9AA0FBCF5E72D (categorie_id), INDEX IDX_8CC9AA0F4584665A (product_id), PRIMARY KEY(categorie_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, full_adress LONGTEXT NOT NULL, gender TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, product_orders_id INT DEFAULT NULL, client_id INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_F52993985D83CC1 (state_id), INDEX IDX_F5299398A15E2C5B (product_orders_id), INDEX IDX_F529939819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, link LONGTEXT NOT NULL, INDEX IDX_14B784184584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_orders_id INT DEFAULT NULL, brand_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, excltax_price VARCHAR(15) NOT NULL, incltax_price VARCHAR(15) NOT NULL, quantity INT DEFAULT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_D34A04ADA15E2C5B (product_orders_id), INDEX IDX_D34A04AD44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_order (id INT AUTO_INCREMENT NOT NULL, quantity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993985D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A15E2C5B FOREIGN KEY (product_orders_id) REFERENCES product_order (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA15E2C5B FOREIGN KEY (product_orders_id) REFERENCES product_order (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0FBCF5E72D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939819EB6921');
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0F4584665A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A15E2C5B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA15E2C5B');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993985D83CC1');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_product');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_order');
        $this->addSql('DROP TABLE state');
    }
}
