<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/12/17 09:46:31
 */
class Version20141217214630 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD COLUMN color VARCHAR(255) NOT NULL
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
                annee VARCHAR(255) DEFAULT NULL, 
                nbPeriode INTEGER NOT NULL, 
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