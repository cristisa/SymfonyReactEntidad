<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002033140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recetario (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recetario_categoria (recetario_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_67AF6C7A9355025C (recetario_id), INDEX IDX_67AF6C7A3397707A (categoria_id), PRIMARY KEY(recetario_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recetario_categoria ADD CONSTRAINT FK_67AF6C7A9355025C FOREIGN KEY (recetario_id) REFERENCES recetario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recetario_categoria ADD CONSTRAINT FK_67AF6C7A3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recetario_categoria DROP FOREIGN KEY FK_67AF6C7A9355025C');
        $this->addSql('ALTER TABLE recetario_categoria DROP FOREIGN KEY FK_67AF6C7A3397707A');
        $this->addSql('DROP TABLE recetario');
        $this->addSql('DROP TABLE recetario_categoria');
    }
}
