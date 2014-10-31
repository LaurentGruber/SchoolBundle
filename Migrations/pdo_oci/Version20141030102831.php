<?php

namespace Laurent\SchoolBundle\Migrations\pdo_oci;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/10/30 10:28:32
 */
class Version20141030102831 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_prof_matiere_group (
                id NUMBER(10) NOT NULL, 
                matiere_id NUMBER(10) DEFAULT NULL, 
                group_id NUMBER(10) DEFAULT NULL, 
                prof_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'LAURENT_SCHOOL_PROF_MATIERE_GROUP' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE LAURENT_SCHOOL_PROF_MATIERE_GROUP ADD CONSTRAINT LAURENT_SCHOOL_PROF_MATIERE_GROUP_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE LAURENT_SCHOOL_PROF_MATIERE_GROUP_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER LAURENT_SCHOOL_PROF_MATIERE_GROUP_AI_PK BEFORE INSERT ON LAURENT_SCHOOL_PROF_MATIERE_GROUP FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT LAURENT_SCHOOL_PROF_MATIERE_GROUP_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT LAURENT_SCHOOL_PROF_MATIERE_GROUP_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'LAURENT_SCHOOL_PROF_MATIERE_GROUP_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT LAURENT_SCHOOL_PROF_MATIERE_GROUP_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
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
            ADD (
                annee NUMBER(10) DEFAULT NULL
            )
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE laurent_school_prof_matiere_group
        ");
        $this->addSql("
            ALTER TABLE laurent_school_matiere 
            DROP (annee)
        ");
    }
}