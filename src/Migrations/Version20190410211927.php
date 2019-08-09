<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410211927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instalacoes (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, endereco VARCHAR(255) NOT NULL, geolocalizacao VARCHAR(255) DEFAULT NULL, concessionaria VARCHAR(255) NOT NULL, codclienteconc VARCHAR(255) NOT NULL, codinstalacaoconc VARCHAR(255) NOT NULL, titulareouser TINYINT(1) NOT NULL, titular VARCHAR(255) DEFAULT NULL, cpftitular VARCHAR(30) DEFAULT NULL, pessfisica TINYINT(1) DEFAULT NULL, INDEX IDX_233FF0F1DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instalacoes ADD CONSTRAINT FK_233FF0F1DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instalacoes DROP FOREIGN KEY FK_233FF0F1DB38439E');
        $this->addSql('DROP TABLE instalacoes');
        $this->addSql('DROP TABLE user');
    }
}
