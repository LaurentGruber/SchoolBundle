<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlsrv;

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
                id INT IDENTITY NOT NULL, 
                matiere_id INT, 
                classe_id INT, 
                prof_id INT, 
                PRIMARY KEY (id)
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
            ALTER TABLE laurent_school_prof_matiere_classe 
            ADD CONSTRAINT FK_AC5ED0B0F46CD258 FOREIGN KEY (matiere_id) 
            REFERENCES laurent_school_matiere (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_prof_matiere_classe 
            ADD CONSTRAINT FK_AC5ED0B08F5EA509 FOREIGN KEY (classe_id) 
            REFERENCES laurent_school_classe (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_prof_matiere_classe 
            ADD CONSTRAINT FK_AC5ED0B0ABC1F7FE FOREIGN KEY (prof_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD officialName NVARCHAR(255) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD viewName NVARCHAR(255) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER COLUMN degre INT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER COLUMN nbPeriode INT NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_classe
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP COLUMN officialName
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP COLUMN viewName
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER COLUMN degre INT
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER COLUMN nbPeriode INT
        ");
    }
}