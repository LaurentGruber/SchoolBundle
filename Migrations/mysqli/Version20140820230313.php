<?php

namespace Laurent\SchoolBundle\Migrations\mysqli;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/08/20 11:03:14
 */
class Version20140820230313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_plan_matiere (
                id INT AUTO_INCREMENT NOT NULL, 
                matiere_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                INDEX IDX_C1FE0911F46CD258 (matiere_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_planmatiere_user (
                planmatiere_id INT NOT NULL, 
                user_id INT NOT NULL, 
                INDEX IDX_622F13F492E8E50 (planmatiere_id), 
                INDEX IDX_622F13F4A76ED395 (user_id), 
                PRIMARY KEY(planmatiere_id, user_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_point_matiere (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                nbPeriode INT DEFAULT NULL, 
                ordre INT DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_pointmatiere_chapitreplanmatiere (
                pointmatiere_id INT NOT NULL, 
                chapitreplanmatiere_id INT NOT NULL, 
                INDEX IDX_F90F73EC1ADE166B (pointmatiere_id), 
                INDEX IDX_F90F73EC5E680512 (chapitreplanmatiere_id), 
                PRIMARY KEY(
                    pointmatiere_id, chapitreplanmatiere_id
                )
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_chapitre_plan_matiere (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                nbPeriode INT DEFAULT NULL, 
                ordre INT DEFAULT NULL, 
                moment INT DEFAULT NULL, 
                annee INT DEFAULT NULL, 
                planMatiere_id INT DEFAULT NULL, 
                INDEX IDX_3D3A30C746738D80 (planMatiere_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_matiere (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INT DEFAULT NULL, 
                nbPeriode INT DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe (
                id INT AUTO_INCREMENT NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INT DEFAULT NULL, 
                annee INT DEFAULT NULL, 
                Workspace_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_CBC542A19AE5D1E7 (Workspace_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe_user (
                classe_id INT NOT NULL, 
                user_id INT NOT NULL, 
                INDEX IDX_1386DAEC8F5EA509 (classe_id), 
                INDEX IDX_1386DAECA76ED395 (user_id), 
                PRIMARY KEY(classe_id, user_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            ADD CONSTRAINT FK_C1FE0911F46CD258 FOREIGN KEY (matiere_id) 
            REFERENCES laurent_school_matiere (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_planmatiere_user 
            ADD CONSTRAINT FK_622F13F492E8E50 FOREIGN KEY (planmatiere_id) 
            REFERENCES laurent_school_plan_matiere (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_planmatiere_user 
            ADD CONSTRAINT FK_622F13F4A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            ADD CONSTRAINT FK_F90F73EC1ADE166B FOREIGN KEY (pointmatiere_id) 
            REFERENCES laurent_school_point_matiere (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            ADD CONSTRAINT FK_F90F73EC5E680512 FOREIGN KEY (chapitreplanmatiere_id) 
            REFERENCES laurent_school_chapitre_plan_matiere (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_chapitre_plan_matiere 
            ADD CONSTRAINT FK_3D3A30C746738D80 FOREIGN KEY (planMatiere_id) 
            REFERENCES laurent_school_plan_matiere (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            ADD CONSTRAINT FK_CBC542A19AE5D1E7 FOREIGN KEY (Workspace_id) 
            REFERENCES claro_workspace (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe_user 
            ADD CONSTRAINT FK_1386DAEC8F5EA509 FOREIGN KEY (classe_id) 
            REFERENCES laurent_school_classe (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe_user 
            ADD CONSTRAINT FK_1386DAECA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_planmatiere_user 
            DROP FOREIGN KEY FK_622F13F492E8E50
        ");
        $this->addSql("
            ALTER TABLE laurent_school_chapitre_plan_matiere 
            DROP FOREIGN KEY FK_3D3A30C746738D80
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            DROP FOREIGN KEY FK_F90F73EC1ADE166B
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            DROP FOREIGN KEY FK_F90F73EC5E680512
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            DROP FOREIGN KEY FK_C1FE0911F46CD258
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe_user 
            DROP FOREIGN KEY FK_1386DAEC8F5EA509
        ");
        $this->addSql("
            DROP TABLE laurent_school_plan_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_planmatiere_user
        ");
        $this->addSql("
            DROP TABLE laurent_school_point_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_pointmatiere_chapitreplanmatiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_chapitre_plan_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe_user
        ");
    }
}