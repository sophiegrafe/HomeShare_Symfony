<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502151540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Address/city/country relations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F818BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_D4E6F818BAC62AF ON address (city_id)');
        $this->addSql('ALTER TABLE city ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_2D5B0234F92F3E70 ON city (country_id)');
        $this->addSql('ALTER TABLE `option` CHANGE libelle option_name VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE property ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEF5B7AF75 ON property (address_id)');
        $this->addSql('ALTER TABLE stay CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE score score NUMERIC(2, 1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F818BAC62AF');
        $this->addSql('DROP INDEX IDX_D4E6F818BAC62AF ON address');
        $this->addSql('ALTER TABLE address DROP city_id');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234F92F3E70');
        $this->addSql('DROP INDEX IDX_2D5B0234F92F3E70 ON city');
        $this->addSql('ALTER TABLE city DROP country_id');
        $this->addSql('ALTER TABLE `option` CHANGE option_name libelle VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEF5B7AF75');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEF5B7AF75 ON property');
        $this->addSql('ALTER TABLE property DROP address_id');
        $this->addSql('ALTER TABLE stay CHANGE start_date start_date DATETIME NOT NULL, CHANGE score score NUMERIC(2, 1) NOT NULL');
    }
}
