<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505095944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change the type of latitude and longitude to match fakerphp : decimal --> float';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE latitude latitude DOUBLE PRECISION DEFAULT NULL, CHANGE longitude longitude DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE latitude latitude NUMERIC(10, 8) DEFAULT NULL, CHANGE longitude longitude NUMERIC(11, 8) DEFAULT NULL');
    }
}
