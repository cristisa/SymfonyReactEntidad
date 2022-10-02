<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002042549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categor (id INT AUTO_INCREMENT NOT NULL, nombre_categoria VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receta_categor (receta_id INT NOT NULL, categor_id INT NOT NULL, INDEX IDX_E73FC3EB54F853F8 (receta_id), INDEX IDX_E73FC3EB35731581 (categor_id), PRIMARY KEY(receta_id, categor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE receta_categor ADD CONSTRAINT FK_E73FC3EB54F853F8 FOREIGN KEY (receta_id) REFERENCES receta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receta_categor ADD CONSTRAINT FK_E73FC3EB35731581 FOREIGN KEY (categor_id) REFERENCES categor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recetario_categoria DROP FOREIGN KEY FK_67AF6C7A3397707A');
        $this->addSql('ALTER TABLE recetario_categoria DROP FOREIGN KEY FK_67AF6C7A9355025C');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE recetario');
        $this->addSql('DROP TABLE recetario_categoria');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre_categoria VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recetario (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recetario_categoria (recetario_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_67AF6C7A9355025C (recetario_id), INDEX IDX_67AF6C7A3397707A (categoria_id), PRIMARY KEY(recetario_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recetario_categoria ADD CONSTRAINT FK_67AF6C7A3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recetario_categoria ADD CONSTRAINT FK_67AF6C7A9355025C FOREIGN KEY (recetario_id) REFERENCES recetario (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receta_categor DROP FOREIGN KEY FK_E73FC3EB54F853F8');
        $this->addSql('ALTER TABLE receta_categor DROP FOREIGN KEY FK_E73FC3EB35731581');
        $this->addSql('DROP TABLE categor');
        $this->addSql('DROP TABLE receta_categor');
    }
}
