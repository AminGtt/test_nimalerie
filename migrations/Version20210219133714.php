<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219133714 extends AbstractMigration
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
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, user_id_id INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_F52993985D83CC1 (state_id), INDEX IDX_F52993989D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, link LONGTEXT NOT NULL, INDEX IDX_14B784184584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, excltax_price VARCHAR(15) NOT NULL, incltax_price VARCHAR(15) NOT NULL, quantity INT NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_D34A04AD4827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_order (product_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_5475E8C44584665A (product_id), INDEX IDX_5475E8C48D9F6D38 (order_id), PRIMARY KEY(product_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, full_adress VARCHAR(255) NOT NULL, gender TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993985D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C44584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C48D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0FBCF5E72D');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4827B9B2');
        $this->addSql('ALTER TABLE product_order DROP FOREIGN KEY FK_5475E8C48D9F6D38');
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0F4584665A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184584665A');
        $this->addSql('ALTER TABLE product_order DROP FOREIGN KEY FK_5475E8C44584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993985D83CC1');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989D86650F');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_product');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_order');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE `user`');
    }
}
