<?php

namespace Laurent\SchoolBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/10/30 10:28:33
 */
class Version20141030102831 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_prof_matiere_group (
                id INT IDENTITY NOT NULL, 
                matiere_id INT, 
                group_id INT, 
                prof_id INT, 
                PRIMARY KEY (id)
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
            ALTER TABLE laurent_school_prof_matiere_group 
            ADD CONSTRAINT FK_6DC8DD32F46CD258 FOREIGN KEY (matiere_id) 
            REFERENCES laurent_school_matiere (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_prof_matiere_group 
            ADD CONSTRAINT FK_6DC8DD32FE54D947 FOREIGN KEY (group_id) 
            REFERENCES claro_group (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_prof_matiere_group 
            ADD CONSTRAINT FK_6DC8DD32ABC1F7FE FOREIGN KEY (prof_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            ADD annee INT
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_group
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP COLUMN annee
        ");
    }
}