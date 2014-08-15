<?php

namespace Laurent\SchoolBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/08/15 11:31:20
 */
class Version20140815113118 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_classe (
                id INTEGER NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                degre INTEGER NOT NULL, 
                annee INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE classe_user (
                classe_id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                PRIMARY KEY(classe_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_9380A3AF8F5EA509 ON classe_user (classe_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_9380A3AFA76ED395 ON classe_user (user_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE classe_user
        ");
    }
}