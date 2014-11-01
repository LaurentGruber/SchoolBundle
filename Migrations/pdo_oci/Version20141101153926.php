<?php

namespace Laurent\SchoolBundle\Migrations\pdo_oci;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/01 03:39:28
 */
class Version20141101153926 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_matiere MODIFY (
                annee VARCHAR2(255) DEFAULT NULL
            )
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_matiere MODIFY (
                annee NUMBER(10) DEFAULT NULL
            )
        ");
    }
}