<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/10/30 10:28:32
 */
class Version20141030102831 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_prof_matiere_group (
                id INTEGER NOT NULL, 
                matiere_id INTEGER DEFAULT NULL, 
                group_id INTEGER DEFAULT NULL, 
                prof_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_6DC8DD32F46CD258 ON laurent_school_prof_matiere_group (matiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_6DC8DD32FE54D947 ON laurent_school_prof_matiere_group (group_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_6DC8DD32ABC1F7FE ON laurent_school_prof_matiere_group (prof_id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD COLUMN annee INTEGER DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_group
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__laurent_school_matiere AS 
            SELECT id, 
            name, 
            officialName, 
            viewName, 
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
                officialName VARCHAR(255) NOT NULL, 
                viewName VARCHAR(255) NOT NULL, 
                degre INTEGER NOT NULL, 
                nbPeriode INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO laurent_school_matiere (
                id, name, officialName, viewName, degre, 
                nbPeriode
            ) 
            SELECT id, 
            name, 
            officialName, 
            viewName, 
            degre, 
            nbPeriode 
            FROM __temp__laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE __temp__laurent_school_matiere
        ");
    }
}