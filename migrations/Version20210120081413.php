<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120081413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_service (event_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_64CA337D71F7E88B (event_id), INDEX IDX_64CA337DED5CA9E6 (service_id), PRIMARY KEY(event_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, more LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_option (service_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_64410586ED5CA9E6 (service_id), INDEX IDX_64410586A7C41D6F (option_id), PRIMARY KEY(service_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_picture (service_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_D95F1D15ED5CA9E6 (service_id), INDEX IDX_D95F1D15EE45BDBF (picture_id), PRIMARY KEY(service_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, adress LONGTEXT DEFAULT NULL, adress_event LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE week (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, start DATE NOT NULL, end DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE week_menu (week_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_B77F3523C86F3B2F (week_id), INDEX IDX_B77F3523CCD7E912 (menu_id), PRIMARY KEY(week_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_service ADD CONSTRAINT FK_64CA337D71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_service ADD CONSTRAINT FK_64CA337DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_option ADD CONSTRAINT FK_64410586ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_option ADD CONSTRAINT FK_64410586A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_picture ADD CONSTRAINT FK_D95F1D15ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_picture ADD CONSTRAINT FK_D95F1D15EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE week_menu ADD CONSTRAINT FK_B77F3523C86F3B2F FOREIGN KEY (week_id) REFERENCES week (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE week_menu ADD CONSTRAINT FK_B77F3523CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_service DROP FOREIGN KEY FK_64CA337D71F7E88B');
        $this->addSql('ALTER TABLE week_menu DROP FOREIGN KEY FK_B77F3523CCD7E912');
        $this->addSql('ALTER TABLE service_option DROP FOREIGN KEY FK_64410586A7C41D6F');
        $this->addSql('ALTER TABLE service_picture DROP FOREIGN KEY FK_D95F1D15EE45BDBF');
        $this->addSql('ALTER TABLE event_service DROP FOREIGN KEY FK_64CA337DED5CA9E6');
        $this->addSql('ALTER TABLE service_option DROP FOREIGN KEY FK_64410586ED5CA9E6');
        $this->addSql('ALTER TABLE service_picture DROP FOREIGN KEY FK_D95F1D15ED5CA9E6');
        $this->addSql('ALTER TABLE week_menu DROP FOREIGN KEY FK_B77F3523C86F3B2F');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_service');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_option');
        $this->addSql('DROP TABLE service_picture');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE week');
        $this->addSql('DROP TABLE week_menu');
    }
}
