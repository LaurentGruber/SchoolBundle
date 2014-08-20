<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

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
                id INTEGER NOT NULL, 
                matiere_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911F46CD258 ON laurent_school_plan_matiere (matiere_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_planmatiere_user (
                planmatiere_id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                PRIMARY KEY(planmatiere_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_622F13F492E8E50 ON laurent_school_planmatiere_user (planmatiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_622F13F4A76ED395 ON laurent_school_planmatiere_user (user_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_point_matiere (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                nbPeriode INTEGER DEFAULT NULL, 
                ordre INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE laurent_school_pointmatiere_chapitreplanmatiere (
                pointmatiere_id INTEGER NOT NULL, 
                chapitreplanmatiere_id INTEGER NOT NULL, 
                PRIMARY KEY(
                    pointmatiere_id, chapitreplanmatiere_id
                )
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_F90F73EC1ADE166B ON laurent_school_pointmatiere_chapitreplanmatiere (pointmatiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_F90F73EC5E680512 ON laurent_school_pointmatiere_chapitreplanmatiere (chapitreplanmatiere_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_chapitre_plan_matiere (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                nbPeriode INTEGER DEFAULT NULL, 
                ordre INTEGER DEFAULT NULL, 
                moment INTEGER DEFAULT NULL, 
                annee INTEGER DEFAULT NULL, 
                planMatiere_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_3D3A30C746738D80 ON laurent_school_chapitre_plan_matiere (planMatiere_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_matiere (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INTEGER DEFAULT NULL, 
                nbPeriode INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe (
                id INTEGER NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INTEGER DEFAULT NULL, 
                annee INTEGER DEFAULT NULL, 
                Workspace_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CBC542A19AE5D1E7 ON laurent_school_classe (Workspace_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe_user (
                classe_id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                PRIMARY KEY(classe_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_1386DAEC8F5EA509 ON laurent_school_classe_user (classe_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_1386DAECA76ED395 ON laurent_school_classe_user (user_id)
        ");
    }

    public function down(Schema $schema)
    {
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