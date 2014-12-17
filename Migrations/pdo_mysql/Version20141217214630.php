<?php

namespace Laurent\SchoolBundle\Migrations\pdo_mysql;

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
            ADD color VARCHAR(255) NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP color
        ");
    }
}