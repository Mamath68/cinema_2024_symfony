<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616202935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, deathdate DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actors_movies (actors_id INT NOT NULL, movies_id INT NOT NULL, INDEX IDX_B3012DC07168CF59 (actors_id), INDEX IDX_B3012DC053F590A4 (movies_id), PRIMARY KEY(actors_id, movies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actors_roles (actors_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_C35D42057168CF59 (actors_id), INDEX IDX_C35D420538C751C4 (roles_id), PRIMARY KEY(actors_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, synopsis LONGTEXT NOT NULL, release_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_genres (movies_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_DF9737A253F590A4 (movies_id), INDEX IDX_DF9737A26A3B2603 (genres_id), PRIMARY KEY(movies_id, genres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_realisateurs (movies_id INT NOT NULL, realisateurs_id INT NOT NULL, INDEX IDX_43759F8553F590A4 (movies_id), INDEX IDX_43759F853B5668A8 (realisateurs_id), PRIMARY KEY(movies_id, realisateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisateurs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, deathdate DATE DEFAULT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actors_movies ADD CONSTRAINT FK_B3012DC07168CF59 FOREIGN KEY (actors_id) REFERENCES actors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actors_movies ADD CONSTRAINT FK_B3012DC053F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actors_roles ADD CONSTRAINT FK_C35D42057168CF59 FOREIGN KEY (actors_id) REFERENCES actors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actors_roles ADD CONSTRAINT FK_C35D420538C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_genres ADD CONSTRAINT FK_DF9737A253F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_genres ADD CONSTRAINT FK_DF9737A26A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_realisateurs ADD CONSTRAINT FK_43759F8553F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_realisateurs ADD CONSTRAINT FK_43759F853B5668A8 FOREIGN KEY (realisateurs_id) REFERENCES realisateurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actors_movies DROP FOREIGN KEY FK_B3012DC07168CF59');
        $this->addSql('ALTER TABLE actors_movies DROP FOREIGN KEY FK_B3012DC053F590A4');
        $this->addSql('ALTER TABLE actors_roles DROP FOREIGN KEY FK_C35D42057168CF59');
        $this->addSql('ALTER TABLE actors_roles DROP FOREIGN KEY FK_C35D420538C751C4');
        $this->addSql('ALTER TABLE movies_genres DROP FOREIGN KEY FK_DF9737A253F590A4');
        $this->addSql('ALTER TABLE movies_genres DROP FOREIGN KEY FK_DF9737A26A3B2603');
        $this->addSql('ALTER TABLE movies_realisateurs DROP FOREIGN KEY FK_43759F8553F590A4');
        $this->addSql('ALTER TABLE movies_realisateurs DROP FOREIGN KEY FK_43759F853B5668A8');
        $this->addSql('DROP TABLE actors');
        $this->addSql('DROP TABLE actors_movies');
        $this->addSql('DROP TABLE actors_roles');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE movies_genres');
        $this->addSql('DROP TABLE movies_realisateurs');
        $this->addSql('DROP TABLE realisateurs');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
