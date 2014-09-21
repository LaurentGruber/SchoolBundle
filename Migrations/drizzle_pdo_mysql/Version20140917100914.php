<?php

namespace Laurent\SchoolBundle\Migrations\drizzle_pdo_mysql;

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
            ALTER TABLE laurent_school_plan_matiere CHANGE refProgramme refProgramme VARCHAR(255) DEFAULT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            DROP FOREIGN KEY FK_CBC542A1722BB11
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            DROP FOREIGN KEY FK_CBC542A19AE5D1E7
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            ADD CONSTRAINT FK_CBC542A1722BB11 FOREIGN KEY (Group_id) 
            REFERENCES claro_group (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            ADD CONSTRAINT FK_CBC542A19AE5D1E7 FOREIGN KEY (Workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE SET NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            DROP FOREIGN KEY FK_CBC542A19AE5D1E7
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            DROP FOREIGN KEY FK_CBC542A1722BB11
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            ADD CONSTRAINT FK_CBC542A19AE5D1E7 FOREIGN KEY (Workspace_id) 
            REFERENCES claro_workspace (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            ADD CONSTRAINT FK_CBC542A1722BB11 FOREIGN KEY (Group_id) 
            REFERENCES claro_group (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere CHANGE refProgramme refProgramme VARCHAR(255) NOT NULL
        ");
    }
}