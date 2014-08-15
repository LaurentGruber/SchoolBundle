<?php

namespace Laurent\SchoolBundle\Migrations\pdo_oci;

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
                id NUMBER(10) NOT NULL, 
                code VARCHAR2(255) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                degre NUMBER(10) NOT NULL, 
                annee NUMBER(10) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'LAURENT_SCHOOL_CLASSE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE LAURENT_SCHOOL_CLASSE ADD CONSTRAINT LAURENT_SCHOOL_CLASSE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE LAURENT_SCHOOL_CLASSE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER LAURENT_SCHOOL_CLASSE_AI_PK BEFORE INSERT ON LAURENT_SCHOOL_CLASSE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT LAURENT_SCHOOL_CLASSE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT LAURENT_SCHOOL_CLASSE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'LAURENT_SCHOOL_CLASSE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT LAURENT_SCHOOL_CLASSE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE classe_user (
                classe_id NUMBER(10) NOT NULL, 
                user_id NUMBER(10) NOT NULL, 
                PRIMARY KEY(classe_id, user_id)
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