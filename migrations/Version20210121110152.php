<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121110152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE week_menu DROP FOREIGN KEY FK_B77F3523C86F3B2F');
        $this->addSql('DROP TABLE week');
        $this->addSql('DROP TABLE week_menu');
        $this->addSql('ALTER TABLE menu ADD menu_of_week TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE week (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, start DATE NOT NULL, end DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE week_menu (week_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_B77F3523C86F3B2F (week_id), INDEX IDX_B77F3523CCD7E912 (menu_id), PRIMARY KEY(week_id, menu_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE week_menu ADD CONSTRAINT FK_B77F3523C86F3B2F FOREIGN KEY (week_id) REFERENCES week (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE week_menu ADD CONSTRAINT FK_B77F3523CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu DROP menu_of_week');
    }
}
