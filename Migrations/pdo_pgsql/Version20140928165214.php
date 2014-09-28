<?php

namespace Laurent\SchoolBundle\Migrations\pdo_pgsql;

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
                id SERIAL NOT NULL, 
                matiere_id INT DEFAULT NULL, 
                classe_id INT DEFAULT NULL, 
                prof_id INT DEFAULT NULL, 
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
            ALTER TABLE laurent_school_prof_matiere_classe 
            ADD CONSTRAINT FK_AC5ED0B0F46CD258 FOREIGN KEY (matiere_id) 
            REFERENCES laurent_school_matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_prof_matiere_classe 
            ADD CONSTRAINT FK_AC5ED0B08F5EA509 FOREIGN KEY (classe_id) 
            REFERENCES laurent_school_classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_prof_matiere_classe 
            ADD CONSTRAINT FK_AC5ED0B0ABC1F7FE FOREIGN KEY (prof_id) 
            REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD officialName VARCHAR(255) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD viewName VARCHAR(255) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER degre 
            SET 
                NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER nbPeriode 
            SET 
                NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_classe
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP officialName
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP viewName
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER degre 
            DROP NOT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere ALTER nbPeriode 
            DROP NOT NULL
        ");
    }
}