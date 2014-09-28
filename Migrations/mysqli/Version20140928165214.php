<?php

namespace Laurent\SchoolBundle\Migrations\mysqli;

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
                id INT AUTO_INCREMENT NOT NULL, 
                matiere_id INT DEFAULT NULL, 
                classe_id INT DEFAULT NULL, 
                prof_id INT DEFAULT NULL, 
                INDEX IDX_AC5ED0B0F46CD258 (matiere_id), 
                INDEX IDX_AC5ED0B08F5EA509 (classe_id), 
                INDEX IDX_AC5ED0B0ABC1F7FE (prof_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
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
            ADD officialName VARCHAR(255) NOT NULL, 
            ADD viewName VARCHAR(255) NOT NULL, 
            CHANGE degre degre INT NOT NULL, 
            CHANGE nbPeriode nbPeriode INT NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_classe
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP officialName, 
            DROP viewName, 
            CHANGE degre degre INT DEFAULT NULL, 
            CHANGE nbPeriode nbPeriode INT DEFAULT NULL
        ");
    }
}