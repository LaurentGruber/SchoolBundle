<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/09/28 04:52:15
 */
class Version20140928165214 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_prof_matiere_classe (
                id INTEGER NOT NULL, 
                matiere_id INTEGER DEFAULT NULL, 
                classe_id INTEGER DEFAULT NULL, 
                prof_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_AC5ED0B0F46CD258 ON laurent_school_prof_matiere_classe (matiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_AC5ED0B08F5EA509 ON laurent_school_prof_matiere_classe (classe_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_AC5ED0B0ABC1F7FE ON laurent_school_prof_matiere_classe (prof_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_matiere AS 
            SELECT id, 
            name, 
            degre, 
            nbPeriode 
            FROM laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_matiere
        ");
        $this->addSql("
            CREATE TABLE laurent_school_matiere (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                nbPeriode INTEGER NOT NULL, 
                degre INTEGER NOT NULL, 
                officialName VARCHAR(255) NOT NULL, 
                viewName VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_matiere (id, name, degre, nbPeriode) 
            SELECT id, 
            name, 
            degre, 
            nbPeriode 
            FROM __temp__laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_matiere
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_classe
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_matiere AS 
            SELECT id, 
            name, 
            degre, 
            nbPeriode 
            FROM laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_matiere
        ");
        $this->addSql("
            CREATE TABLE laurent_school_matiere (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                nbPeriode INTEGER DEFAULT NULL, 
                degre INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_matiere (id, name, degre, nbPeriode) 
            SELECT id, 
            name, 
            degre, 
            nbPeriode 
            FROM __temp__laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_matiere
        ");
    }
}