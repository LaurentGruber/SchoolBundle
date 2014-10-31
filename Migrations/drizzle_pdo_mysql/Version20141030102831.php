<?php

namespace Laurent\SchoolBundle\Migrations\drizzle_pdo_mysql;

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
                id INT AUTO_INCREMENT NOT NULL, 
                matiere_id INT DEFAULT NULL, 
                group_id INT DEFAULT NULL, 
                prof_id INT DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_6DC8DD32F46CD258 (matiere_id), 
                INDEX IDX_6DC8DD32FE54D947 (group_id), 
                INDEX IDX_6DC8DD32ABC1F7FE (prof_id)
            )
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
            ADD annee INT DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_group
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP annee
        ");
    }
}