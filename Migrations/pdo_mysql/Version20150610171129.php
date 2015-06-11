<?php

namespace Laurent\SchoolBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/06/10 05:11:31
 */
class Version20150610171129 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            DROP FOREIGN KEY FK_C1FE0911805DB139
        ");
        $this->addSql("
            DROP INDEX IDX_C1FE0911805DB139 ON laurent_school_plan_matiere
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            DROP referentiel_id
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            ADD referentiel_id INT DEFAULT NULL
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            ADD CONSTRAINT FK_C1FE0911805DB139 FOREIGN KEY (referentiel_id) 
            REFERENCES claro_competence (id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911805DB139 ON laurent_school_plan_matiere (referentiel_id)
        ");
    }
}