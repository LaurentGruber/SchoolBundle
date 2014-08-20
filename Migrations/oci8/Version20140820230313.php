<?php

namespace Laurent\SchoolBundle\Migrations\oci8;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/08/20 11:03:14
 */
class Version20140820230313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE laurent_school_plan_matiere (
                id NUMBER(10) NOT NULL, 
                matiere_id NUMBER(10) DEFAULT NULL, 
                name VARCHAR2(255) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'LAURENT_SCHOOL_PLAN_MATIERE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE LAURENT_SCHOOL_PLAN_MATIERE ADD CONSTRAINT LAURENT_SCHOOL_PLAN_MATIERE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE LAURENT_SCHOOL_PLAN_MATIERE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER LAURENT_SCHOOL_PLAN_MATIERE_AI_PK BEFORE INSERT ON LAURENT_SCHOOL_PLAN_MATIERE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT LAURENT_SCHOOL_PLAN_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT LAURENT_SCHOOL_PLAN_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'LAURENT_SCHOOL_PLAN_MATIERE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT LAURENT_SCHOOL_PLAN_MATIERE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE INDEX IDX_C1FE0911F46CD258 ON laurent_school_plan_matiere (matiere_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_planmatiere_user (
                planmatiere_id NUMBER(10) NOT NULL, 
                user_id NUMBER(10) NOT NULL, 
                PRIMARY KEY(planmatiere_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_622F13F492E8E50 ON laurent_school_planmatiere_user (planmatiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_622F13F4A76ED395 ON laurent_school_planmatiere_user (user_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_point_matiere (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                nbPeriode NUMBER(10) DEFAULT NULL, 
                ordre NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'LAURENT_SCHOOL_POINT_MATIERE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE LAURENT_SCHOOL_POINT_MATIERE ADD CONSTRAINT LAURENT_SCHOOL_POINT_MATIERE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE LAURENT_SCHOOL_POINT_MATIERE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER LAURENT_SCHOOL_POINT_MATIERE_AI_PK BEFORE INSERT ON LAURENT_SCHOOL_POINT_MATIERE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT LAURENT_SCHOOL_POINT_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT LAURENT_SCHOOL_POINT_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'LAURENT_SCHOOL_POINT_MATIERE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT LAURENT_SCHOOL_POINT_MATIERE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE laurent_school_pointmatiere_chapitreplanmatiere (
                pointmatiere_id NUMBER(10) NOT NULL, 
                chapitreplanmatiere_id NUMBER(10) NOT NULL, 
                PRIMARY KEY(
                    pointmatiere_id, chapitreplanmatiere_id
                )
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_F90F73EC1ADE166B ON laurent_school_pointmatiere_chapitreplanmatiere (pointmatiere_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_F90F73EC5E680512 ON laurent_school_pointmatiere_chapitreplanmatiere (chapitreplanmatiere_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_chapitre_plan_matiere (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                nbPeriode NUMBER(10) DEFAULT NULL, 
                ordre NUMBER(10) DEFAULT NULL, 
                moment NUMBER(10) DEFAULT NULL, 
                annee NUMBER(10) DEFAULT NULL, 
                planMatiere_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE ADD CONSTRAINT LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_AI_PK BEFORE INSERT ON LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT LAURENT_SCHOOL_CHAPITRE_PLAN_MATIERE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE INDEX IDX_3D3A30C746738D80 ON laurent_school_chapitre_plan_matiere (planMatiere_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_matiere (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                degre NUMBER(10) DEFAULT NULL, 
                nbPeriode NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'LAURENT_SCHOOL_MATIERE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE LAURENT_SCHOOL_MATIERE ADD CONSTRAINT LAURENT_SCHOOL_MATIERE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE LAURENT_SCHOOL_MATIERE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER LAURENT_SCHOOL_MATIERE_AI_PK BEFORE INSERT ON LAURENT_SCHOOL_MATIERE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT LAURENT_SCHOOL_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT LAURENT_SCHOOL_MATIERE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'LAURENT_SCHOOL_MATIERE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT LAURENT_SCHOOL_MATIERE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe (
                id NUMBER(10) NOT NULL, 
                code VARCHAR2(255) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                degre NUMBER(10) DEFAULT NULL, 
                annee NUMBER(10) DEFAULT NULL, 
                Workspace_id NUMBER(10) DEFAULT NULL, 
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
            CREATE UNIQUE INDEX UNIQ_CBC542A19AE5D1E7 ON laurent_school_classe (Workspace_id)
        ");
        $this->addSql("
            CREATE TABLE laurent_school_classe_user (
                classe_id NUMBER(10) NOT NULL, 
                user_id NUMBER(10) NOT NULL, 
                PRIMARY KEY(classe_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_1386DAEC8F5EA509 ON laurent_school_classe_user (classe_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_1386DAECA76ED395 ON laurent_school_classe_user (user_id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            ADD CONSTRAINT FK_C1FE0911F46CD258 FOREIGN KEY (matiere_id) 
            REFERENCES laurent_school_matiere (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_planmatiere_user 
            ADD CONSTRAINT FK_622F13F492E8E50 FOREIGN KEY (planmatiere_id) 
            REFERENCES laurent_school_plan_matiere (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_planmatiere_user 
            ADD CONSTRAINT FK_622F13F4A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            ADD CONSTRAINT FK_F90F73EC1ADE166B FOREIGN KEY (pointmatiere_id) 
            REFERENCES laurent_school_point_matiere (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            ADD CONSTRAINT FK_F90F73EC5E680512 FOREIGN KEY (chapitreplanmatiere_id) 
            REFERENCES laurent_school_chapitre_plan_matiere (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_chapitre_plan_matiere 
            ADD CONSTRAINT FK_3D3A30C746738D80 FOREIGN KEY (planMatiere_id) 
            REFERENCES laurent_school_plan_matiere (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe 
            ADD CONSTRAINT FK_CBC542A19AE5D1E7 FOREIGN KEY (Workspace_id) 
            REFERENCES claro_workspace (id)
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe_user 
            ADD CONSTRAINT FK_1386DAEC8F5EA509 FOREIGN KEY (classe_id) 
            REFERENCES laurent_school_classe (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe_user 
            ADD CONSTRAINT FK_1386DAECA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE laurent_school_planmatiere_user 
            DROP CONSTRAINT FK_622F13F492E8E50
        ");
        $this->addSql("
            ALTER TABLE laurent_school_chapitre_plan_matiere 
            DROP CONSTRAINT FK_3D3A30C746738D80
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            DROP CONSTRAINT FK_F90F73EC1ADE166B
        ");
        $this->addSql("
            ALTER TABLE laurent_school_pointmatiere_chapitreplanmatiere 
            DROP CONSTRAINT FK_F90F73EC5E680512
        ");
        $this->addSql("
            ALTER TABLE laurent_school_plan_matiere 
            DROP CONSTRAINT FK_C1FE0911F46CD258
        ");
        $this->addSql("
            ALTER TABLE laurent_school_classe_user 
            DROP CONSTRAINT FK_1386DAEC8F5EA509
        ");
        $this->addSql("
            DROP TABLE laurent_school_plan_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_planmatiere_user
        ");
        $this->addSql("
            DROP TABLE laurent_school_point_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_pointmatiere_chapitreplanmatiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_chapitre_plan_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_matiere
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe
        ");
        $this->addSql("
            DROP TABLE laurent_school_classe_user
        ");
    }
}