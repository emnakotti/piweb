<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415111140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE packevenement CHANGE description description LONGTEXT DEFAULT NULL, CHANGE prix prix NUMERIC(10, 2) NOT NULL, CHANGE nbre_invites_max nbre_invites_max INT DEFAULT NULL, CHANGE budget_prevu budget_prevu NUMERIC(10, 2) DEFAULT NULL, CHANGE date_evenement date_evenement DATE DEFAULT NULL, CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE date_modification date_modification DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE statut statut ENUM('actif', 'inactif', 'archivé')
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE packevenement ADD CONSTRAINT FK_B69696F6AB213CC FOREIGN KEY (lieu_id) REFERENCES locaux (id_local)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_pack_lieu ON packevenement
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B69696F6AB213CC ON packevenement (lieu_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE posts DROP FOREIGN KEY posts_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE posts CHANGE description description LONGTEXT DEFAULT NULL, CHANGE nb_Likes nb_likes INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_user ON posts
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_885DBAFA6B3CA4B ON posts (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE posts ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (id_user) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY fk_user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY fk_rating_service
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY fk_rating_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY fk_user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY fk_rating_service
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY fk_rating_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating CHANGE date_rating date_rating DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT FK_D8892622ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id_service)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_user_id ON rating
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D8892622A76ED395 ON rating (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_rating_service ON rating
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D8892622ED5CA9E6 ON rating (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT fk_rating_service FOREIGN KEY (service_id) REFERENCES service (id_service) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT fk_rating_user FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts DROP FOREIGN KEY reacts_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts DROP FOREIGN KEY reacts_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts CHANGE reaction reaction VARCHAR(7) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_post ON reacts
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EDAE8C3FD1AA708F ON reacts (id_post)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_user ON reacts
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EDAE8C3F6B3CA4B ON reacts (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts ADD CONSTRAINT reacts_ibfk_1 FOREIGN KEY (id_post) REFERENCES posts (id_post)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts ADD CONSTRAINT reacts_ibfk_2 FOREIGN KEY (id_user) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation CHANGE user_message user_message LONGTEXT NOT NULL, CHANGE chat_response chat_response LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX user_id ON reclamation
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CE606404A76ED395 ON reclamation (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY reservation_locaux_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY reservation_locaux_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY reservation_locaux_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY reservation_locaux_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT FK_F1774AC26553C9D8 FOREIGN KEY (id_local) REFERENCES locaux (id_local)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT FK_F1774AC26B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_local ON reservation_locaux
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F1774AC26553C9D8 ON reservation_locaux (id_local)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_user ON reservation_locaux
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F1774AC26B3CA4B ON reservation_locaux (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT reservation_locaux_ibfk_2 FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT reservation_locaux_ibfk_1 FOREIGN KEY (id_local) REFERENCES locaux (id_local) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice DROP FOREIGN KEY reservationservice_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice DROP FOREIGN KEY reservationservice_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice ADD CONSTRAINT FK_505F34CAB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation_pack (reservation_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice ADD CONSTRAINT FK_505F34CAED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id_service)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_505F34CAB83297E7 ON reservationservice (reservation_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX service_id ON reservationservice
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_505F34CAED5CA9E6 ON reservationservice (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice ADD CONSTRAINT reservationservice_ibfk_2 FOREIGN KEY (service_id) REFERENCES service (id_service) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP FOREIGN KEY fk_service_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP FOREIGN KEY fk_service_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE type_service type_service ENUM('Matériel', 'Staff'), CHANGE disponibilite disponibilite INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_service_user ON service
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E19D9AD2FB88E14F ON service (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD CONSTRAINT fk_service_user FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX username ON user
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX email ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE role role VARCHAR(5) NOT NULL, CHANGE is_active is_active VARCHAR(255) NOT NULL, CHANGE face_id face_id LONGBLOB DEFAULT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL, CHANGE auth_mode auth_mode VARCHAR(20) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE packevenement DROP FOREIGN KEY FK_B69696F6AB213CC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE packevenement DROP FOREIGN KEY FK_B69696F6AB213CC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE packevenement CHANGE description description LONGTEXT NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL, CHANGE nbre_invites_max nbre_invites_max INT NOT NULL, CHANGE budget_prevu budget_prevu DOUBLE PRECISION NOT NULL, CHANGE date_evenement date_evenement DATE NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE date_creation date_creation DATETIME NOT NULL, CHANGE date_modification date_modification DATETIME NOT NULL, CHANGE statut statut VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_b69696f6ab213cc ON packevenement
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_pack_lieu ON packevenement (lieu_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE packevenement ADD CONSTRAINT FK_B69696F6AB213CC FOREIGN KEY (lieu_id) REFERENCES locaux (id_local)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA6B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE posts CHANGE description description TEXT DEFAULT NULL, CHANGE nb_likes nb_Likes INT DEFAULT 0
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_885dbafa6b3ca4b ON posts
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_user ON posts (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY FK_D8892622ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating DROP FOREIGN KEY FK_D8892622ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating CHANGE date_rating date_rating DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT fk_rating_service FOREIGN KEY (service_id) REFERENCES service (id_service) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT fk_rating_user FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_d8892622ed5ca9e6 ON rating
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_rating_service ON rating (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_d8892622a76ed395 ON rating
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_user_id ON rating (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating ADD CONSTRAINT FK_D8892622ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id_service)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts DROP FOREIGN KEY FK_EDAE8C3FD1AA708F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts DROP FOREIGN KEY FK_EDAE8C3F6B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts CHANGE reaction reaction VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_edae8c3fd1aa708f ON reacts
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_post ON reacts (id_post)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_edae8c3f6b3ca4b ON reacts
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_user ON reacts (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts ADD CONSTRAINT FK_EDAE8C3FD1AA708F FOREIGN KEY (id_post) REFERENCES posts (id_post)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reacts ADD CONSTRAINT FK_EDAE8C3F6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation CHANGE user_message user_message TEXT NOT NULL, CHANGE chat_response chat_response TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_ce606404a76ed395 ON reclamation
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX user_id ON reclamation (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice DROP FOREIGN KEY FK_505F34CAB83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice DROP FOREIGN KEY FK_505F34CAED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_505F34CAB83297E7 ON reservationservice
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice DROP FOREIGN KEY FK_505F34CAED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice ADD CONSTRAINT reservationservice_ibfk_2 FOREIGN KEY (service_id) REFERENCES service (id_service) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_505f34caed5ca9e6 ON reservationservice
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX service_id ON reservationservice (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservationservice ADD CONSTRAINT FK_505F34CAED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id_service)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY FK_F1774AC26553C9D8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY FK_F1774AC26B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY FK_F1774AC26553C9D8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux DROP FOREIGN KEY FK_F1774AC26B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT reservation_locaux_ibfk_2 FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT reservation_locaux_ibfk_1 FOREIGN KEY (id_local) REFERENCES locaux (id_local) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_f1774ac26553c9d8 ON reservation_locaux
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_local ON reservation_locaux (id_local)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_f1774ac26b3ca4b ON reservation_locaux
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_user ON reservation_locaux (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT FK_F1774AC26553C9D8 FOREIGN KEY (id_local) REFERENCES locaux (id_local)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_locaux ADD CONSTRAINT FK_F1774AC26B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service CHANGE utilisateur_id utilisateur_id INT NOT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE type_service type_service VARCHAR(255) DEFAULT NULL, CHANGE disponibilite disponibilite INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD CONSTRAINT fk_service_user FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_e19d9ad2fb88e14f ON service
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_service_user ON service (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE role role VARCHAR(255) DEFAULT NULL, CHANGE is_active is_active VARCHAR(255) DEFAULT 'nok' NOT NULL, CHANGE face_id face_id BLOB DEFAULT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT 0, CHANGE auth_mode auth_mode VARCHAR(255) DEFAULT 'Mot de passe'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX username ON user (username)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX email ON user (email)
        SQL);
    }
}
