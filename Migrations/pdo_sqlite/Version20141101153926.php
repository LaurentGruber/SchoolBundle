<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/01 03:39:27
 */
class Version20141101153926 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_matiere AS 
            SELECT id, 
            name, 
            degre, 
            nbPeriode, 
            officialName, 
            viewName, 
            annee 
            FROM laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_matiere
        ");
        $this->addSql("
            CREATE TABLE laurent_school_matiere (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INTEGER NOT NULL, 
                nbPeriode INTEGER NOT NULL, 
                officialName VARCHAR(255) NOT NULL, 
                viewName VARCHAR(255) NOT NULL, 
                annee VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_matiere (
                id, name, degre, nbPeriode, officialName, 
                viewName, annee
            ) 
            SELECT id, 
            name, 
            degre, 
            nbPeriode, 
            officialName, 
            viewName, 
            annee 
            FROM __temp__laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_matiere
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_matiere AS 
            SELECT id, 
            name, 
            officialName, 
            viewName, 
            degre, 
            annee, 
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
                officialName VARCHAR(255) NOT NULL, 
                viewName VARCHAR(255) NOT NULL, 
                degre INTEGER NOT NULL, 
                nbPeriode INTEGER NOT NULL, 
                annee INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_matiere (
                id, name, officialName, viewName, degre, 
                annee, nbPeriode
            ) 
            SELECT id, 
            name, 
            officialName, 
            viewName, 
            degre, 
            annee, 
            nbPeriode 
            FROM __temp__laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_matiere
        ");
    }
}