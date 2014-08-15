<?php

namespace Laurent\SchoolBundle\Migrations\sqlsrv;

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
                id INT IDENTITY NOT NULL, 
                code NVARCHAR(255) NOT NULL, 
                name NVARCHAR(255) NOT NULL, 
                degre INT NOT NULL, 
                annee INT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE classe_user (
                classe_id INT NOT NULL, 
                user_id INT NOT NULL, 
                PRIMARY KEY (classe_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_9380A3AF8F5EA509 ON classe_user (classe_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_9380A3AFA76ED395 ON classe_user (user_id)
        ");
        $this->addSql("
            ALTER TABLE classe_user 
            ADD CONSTRAINT FK_9380A3AF8F5EA509 FOREIGN KEY (classe_id) 
            REFERENCES laurent_school_classe (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE classe_user 
            ADD CONSTRAINT FK_9380A3AFA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE classe_user 
            DROP CONSTRAINT FK_9380A3AF8F5EA509
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE classe_user
        ");
    }
}