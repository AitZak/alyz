<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201027194003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE artist_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE chart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE curator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE platform_music_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE playlist_curator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE playlist_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE track_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tracks_chart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tracks_playlist_curator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tracks_playlist_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE artist (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE chart (id INT NOT NULL, platform_music_id_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E5562A2A576AE338 ON chart (platform_music_id_id)');
        $this->addSql('CREATE TABLE chart_country (chart_id INT NOT NULL, country_id INT NOT NULL, PRIMARY KEY(chart_id, country_id))');
        $this->addSql('CREATE INDEX IDX_1EA39312BEF83E0A ON chart_country (chart_id)');
        $this->addSql('CREATE INDEX IDX_1EA39312F92F3E70 ON chart_country (country_id)');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE curator (id INT NOT NULL, platform_music_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_73C39149576AE338 ON curator (platform_music_id_id)');
        $this->addSql('CREATE TABLE platform_music (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE playlist_curator (id INT NOT NULL, name VARCHAR(255) NOT NULL, id_in_platform VARCHAR(255) NOT NULL, curator_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE playlist_user (id INT NOT NULL, name VARCHAR(255) NOT NULL, id_in_platform INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sing (id INT NOT NULL, artist_id_id INT DEFAULT NULL, track_id_id INT DEFAULT NULL, role INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_376092131F48AE04 ON sing (artist_id_id)');
        $this->addSql('CREATE INDEX IDX_37609213FB33CF0 ON sing (track_id_id)');
        $this->addSql('CREATE TABLE track (id INT NOT NULL, title VARCHAR(255) NOT NULL, isrc VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tracks_chart (id INT NOT NULL, track_id_id INT DEFAULT NULL, chart_id_id INT DEFAULT NULL, position INT NOT NULL, publication_date VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB154B7FB33CF0 ON tracks_chart (track_id_id)');
        $this->addSql('CREATE INDEX IDX_2FB154B79975210B ON tracks_chart (chart_id_id)');
        $this->addSql('CREATE TABLE tracks_playlist_curator (id INT NOT NULL, playlist_curator_id_id INT DEFAULT NULL, position INT NOT NULL, publication_date VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83CE38F615C58B9B ON tracks_playlist_curator (playlist_curator_id_id)');
        $this->addSql('CREATE TABLE tracks_playlist_curator_track (tracks_playlist_curator_id INT NOT NULL, track_id INT NOT NULL, PRIMARY KEY(tracks_playlist_curator_id, track_id))');
        $this->addSql('CREATE INDEX IDX_7BA02195BC4B999D ON tracks_playlist_curator_track (tracks_playlist_curator_id)');
        $this->addSql('CREATE INDEX IDX_7BA021955ED23C43 ON tracks_playlist_curator_track (track_id)');
        $this->addSql('CREATE TABLE tracks_playlist_user (id INT NOT NULL, playlist_id_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8DBC303DDC588714 ON tracks_playlist_user (playlist_id_id)');
        $this->addSql('ALTER TABLE chart ADD CONSTRAINT FK_E5562A2A576AE338 FOREIGN KEY (platform_music_id_id) REFERENCES platform_music (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chart_country ADD CONSTRAINT FK_1EA39312BEF83E0A FOREIGN KEY (chart_id) REFERENCES chart (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chart_country ADD CONSTRAINT FK_1EA39312F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE curator ADD CONSTRAINT FK_73C39149576AE338 FOREIGN KEY (platform_music_id_id) REFERENCES platform_music (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sing ADD CONSTRAINT FK_376092131F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sing ADD CONSTRAINT FK_37609213FB33CF0 FOREIGN KEY (track_id_id) REFERENCES track (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tracks_chart ADD CONSTRAINT FK_2FB154B7FB33CF0 FOREIGN KEY (track_id_id) REFERENCES track (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tracks_chart ADD CONSTRAINT FK_2FB154B79975210B FOREIGN KEY (chart_id_id) REFERENCES chart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tracks_playlist_curator ADD CONSTRAINT FK_83CE38F615C58B9B FOREIGN KEY (playlist_curator_id_id) REFERENCES playlist_curator (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tracks_playlist_curator_track ADD CONSTRAINT FK_7BA02195BC4B999D FOREIGN KEY (tracks_playlist_curator_id) REFERENCES tracks_playlist_curator (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tracks_playlist_curator_track ADD CONSTRAINT FK_7BA021955ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tracks_playlist_user ADD CONSTRAINT FK_8DBC303DDC588714 FOREIGN KEY (playlist_id_id) REFERENCES playlist_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sing DROP CONSTRAINT FK_376092131F48AE04');
        $this->addSql('ALTER TABLE chart_country DROP CONSTRAINT FK_1EA39312BEF83E0A');
        $this->addSql('ALTER TABLE tracks_chart DROP CONSTRAINT FK_2FB154B79975210B');
        $this->addSql('ALTER TABLE chart_country DROP CONSTRAINT FK_1EA39312F92F3E70');
        $this->addSql('ALTER TABLE chart DROP CONSTRAINT FK_E5562A2A576AE338');
        $this->addSql('ALTER TABLE curator DROP CONSTRAINT FK_73C39149576AE338');
        $this->addSql('ALTER TABLE tracks_playlist_curator DROP CONSTRAINT FK_83CE38F615C58B9B');
        $this->addSql('ALTER TABLE tracks_playlist_user DROP CONSTRAINT FK_8DBC303DDC588714');
        $this->addSql('ALTER TABLE sing DROP CONSTRAINT FK_37609213FB33CF0');
        $this->addSql('ALTER TABLE tracks_chart DROP CONSTRAINT FK_2FB154B7FB33CF0');
        $this->addSql('ALTER TABLE tracks_playlist_curator_track DROP CONSTRAINT FK_7BA021955ED23C43');
        $this->addSql('ALTER TABLE tracks_playlist_curator_track DROP CONSTRAINT FK_7BA02195BC4B999D');
        $this->addSql('DROP SEQUENCE artist_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE chart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE curator_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE platform_music_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE playlist_curator_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE playlist_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sing_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE track_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tracks_chart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tracks_playlist_curator_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tracks_playlist_user_id_seq CASCADE');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE chart');
        $this->addSql('DROP TABLE chart_country');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE curator');
        $this->addSql('DROP TABLE platform_music');
        $this->addSql('DROP TABLE playlist_curator');
        $this->addSql('DROP TABLE playlist_user');
        $this->addSql('DROP TABLE sing');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE tracks_chart');
        $this->addSql('DROP TABLE tracks_playlist_curator');
        $this->addSql('DROP TABLE tracks_playlist_curator_track');
        $this->addSql('DROP TABLE tracks_playlist_user');
    }
}
