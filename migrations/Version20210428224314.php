<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428224314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coment ADD user_id INT NOT NULL, ADD blogpost_id INT NOT NULL, ADD reply_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coment ADD CONSTRAINT FK_F86E9D2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coment ADD CONSTRAINT FK_F86E9D227F5416E FOREIGN KEY (blogpost_id) REFERENCES blogpost (id)');
        $this->addSql('ALTER TABLE coment ADD CONSTRAINT FK_F86E9D28A0E4E7F FOREIGN KEY (reply_id) REFERENCES coment (id)');
        $this->addSql('CREATE INDEX IDX_F86E9D2A76ED395 ON coment (user_id)');
        $this->addSql('CREATE INDEX IDX_F86E9D227F5416E ON coment (blogpost_id)');
        $this->addSql('CREATE INDEX IDX_F86E9D28A0E4E7F ON coment (reply_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coment DROP FOREIGN KEY FK_F86E9D2A76ED395');
        $this->addSql('ALTER TABLE coment DROP FOREIGN KEY FK_F86E9D227F5416E');
        $this->addSql('ALTER TABLE coment DROP FOREIGN KEY FK_F86E9D28A0E4E7F');
        $this->addSql('DROP INDEX IDX_F86E9D2A76ED395 ON coment');
        $this->addSql('DROP INDEX IDX_F86E9D227F5416E ON coment');
        $this->addSql('DROP INDEX IDX_F86E9D28A0E4E7F ON coment');
        $this->addSql('ALTER TABLE coment DROP user_id, DROP blogpost_id, DROP reply_id');
    }
}
