<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423000724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE consumo (id INT AUTO_INCREMENT NOT NULL, instalacoes_id_id INT NOT NULL, usuario_id_id INT NOT NULL, credito TINYINT(1) NOT NULL, consumo DOUBLE PRECISION NOT NULL, datareferencia DATE NOT NULL, INDEX IDX_DE7C314FF1C5F864 (instalacoes_id_id), INDEX IDX_DE7C314F629AF449 (usuario_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consumo ADD CONSTRAINT FK_DE7C314FF1C5F864 FOREIGN KEY (instalacoes_id_id) REFERENCES instalacoes (id)');
        $this->addSql('ALTER TABLE consumo ADD CONSTRAINT FK_DE7C314F629AF449 FOREIGN KEY (usuario_id_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE consumo');
        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
