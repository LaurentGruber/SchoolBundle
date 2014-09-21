<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/09/17 10:09:16
 */
class Version20140917100914 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_C1FE0911F46CD258
        ");
        $this->addSql("
            DROP INDEX IDX_C1FE0911805DB139
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_plan_matiere AS 
            SELECT id, 
            referentiel_id, 
            matiere_id, 
            name, 
            refProgramme 
            FROM laurent_school_plan_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_plan_matiere
        ");
        $this->addSql("
            CREATE TABLE laurent_school_plan_matiere (
                id INTEGER NOT NULL, 
                referentiel_id INTEGER DEFAULT NULL, 
                matiere_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                refProgramme VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_C1FE0911805DB139 FOREIGN KEY (referentiel_id) 
                REFERENCES claro_competence (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_C1FE0911F46CD258 FOREIGN KEY (matiere_id) 
                REFERENCES laurent_school_matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_plan_matiere (
                id, referentiel_id, matiere_id, name, 
                refProgramme
            ) 
            SELECT id, 
            referentiel_id, 
            matiere_id, 
            name, 
            refProgramme 
            FROM __temp__laurent_school_plan_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_plan_matiere
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911F46CD258 ON laurent_school_plan_matiere (matiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911805DB139 ON laurent_school_plan_matiere (referentiel_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_CBC542A19AE5D1E7
        ");
        $this->addSql("
            DROP INDEX UNIQ_CBC542A1722BB11
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_classe AS 
            SELECT id, 
            code, 
            name, 
            degre, 
            annee, 
            Workspace_id, 
            Group_id 
            FROM laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe (
                id INTEGER NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INTEGER DEFAULT NULL, 
                annee INTEGER DEFAULT NULL, 
                Workspace_id INTEGER DEFAULT NULL, 
                Group_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_CBC542A1722BB11 FOREIGN KEY (Group_id) 
                REFERENCES claro_group (id) 
                ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_CBC542A19AE5D1E7 FOREIGN KEY (Workspace_id) 
                REFERENCES claro_workspace (id) 
                ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_classe (
                id, code, name, degre, annee, Workspace_id, 
                Group_id
            ) 
            SELECT id, 
            code, 
            name, 
            degre, 
            annee, 
            Workspace_id, 
            Group_id 
            FROM __temp__laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_classe
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CBC542A19AE5D1E7 ON laurent_school_classe (Workspace_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CBC542A1722BB11 ON laurent_school_classe (Group_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_CBC542A19AE5D1E7
        ");
        $this->addSql("
            DROP INDEX UNIQ_CBC542A1722BB11
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_classe AS 
            SELECT id, 
            code, 
            name, 
            degre, 
            annee, 
            Workspace_id, 
            Group_id 
            FROM laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe (
                id INTEGER NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INTEGER DEFAULT NULL, 
                annee INTEGER DEFAULT NULL, 
                Workspace_id INTEGER DEFAULT NULL, 
                Group_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_CBC542A19AE5D1E7 FOREIGN KEY (Workspace_id) 
                REFERENCES claro_workspace (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_CBC542A1722BB11 FOREIGN KEY (Group_id) 
                REFERENCES claro_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_classe (
                id, code, name, degre, annee, Workspace_id, 
                Group_id
            ) 
            SELECT id, 
            code, 
            name, 
            degre, 
            annee, 
            Workspace_id, 
            Group_id 
            FROM __temp__laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_classe
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CBC542A19AE5D1E7 ON laurent_school_classe (Workspace_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CBC542A1722BB11 ON laurent_school_classe (Group_id)
        ");
        $this->addSql("
            DROP INDEX IDX_C1FE0911F46CD258
        ");
        $this->addSql("
            DROP INDEX IDX_C1FE0911805DB139
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_plan_matiere AS 
            SELECT id, 
            matiere_id, 
            referentiel_id, 
            name, 
            refProgramme 
            FROM laurent_school_plan_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_plan_matiere
        ");
        $this->addSql("
            CREATE TABLE laurent_school_plan_matiere (
                id INTEGER NOT NULL, 
                matiere_id INTEGER DEFAULT NULL, 
                referentiel_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                refProgramme VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_C1FE0911F46CD258 FOREIGN KEY (matiere_id) 
                REFERENCES laurent_school_matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_C1FE0911805DB139 FOREIGN KEY (referentiel_id) 
                REFERENCES claro_competence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_plan_matiere (
                id, matiere_id, referentiel_id, name, 
                refProgramme
            ) 
            SELECT id, 
            matiere_id, 
            referentiel_id, 
            name, 
            refProgramme 
            FROM __temp__laurent_school_plan_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_plan_matiere
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911F46CD258 ON laurent_school_plan_matiere (matiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911805DB139 ON laurent_school_plan_matiere (referentiel_id)
        ");
    }
}