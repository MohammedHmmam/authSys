--Create Database
CREATE DATABASE IF NOT EXISTS authSys CHARACTER SET utf8 COLLATE utf8_general_ci;


--1-CREATE email_validation_status Table
CREATE TABLE IF NOT EXISTS email_validation_status(
    statusId            INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    statusDescription   VARCHAR(20) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci;

--2-Create hashing_algorithms Table
CREATE TABLE IF NOT EXISTS  hashing_algorithms(
    hashAlgorithmId     INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    algorithmName       VARCHAR(10) NOT NULL,      
)CHARACTER SET utf8 COLLATE utf8_general_ci;

--3-Create user_login_data Table
CREATE TABLE IF NOT EXISTS user_login_data(
    userId                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    loginName                   VARCHAR(60) NOT NULL UNIQUE,
    passwordHash                VARCHAR(255) NOT NULL,
    passwordSalt                VARCHAR(100) NOT NULL,
    hashAlgorithmId             INT NOT NULL, --FOREIGN KEY
    emailAddress                Varchar(60) NOT NULL UNIQUE,
    confirmationToken           VARCHAR(255) NULL,
    tokenGenerationTime         DATETIME    NULL,
    emailValidationStatusId     INT NOT NULL, --FOREIGN KEY
    passwordRecoveryToken       VARCHAR(255) NULL,
    recoveryTokenTime           DATETIME    NULL,
    FOREIGN KEY (hashAlgorithmId)           REFERENCES hashing_algorithms(hashAlgorithmId),
    FOREIGN KEY (emailValidationStatusId)   REFERENCES email_validation_status(emailValidationStatusId)
)CHARACTER SET utf8 COLLATE utf8_general_ci;

--4- CREATE user_roles Table
CREATE TABLE IF NOT EXISTS user_roles(
    roleId          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    roleDescription VARCHAR(30) NOT NULL UNIQUE,    
) CHARACTER SET utf8 COLLATE utf8_general_ci;

--5-Create permissions Table
CREATE TABLE IF NOT EXISTS permissions(
    permissionId            INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    permissionDescription   VARCHAR(50) NOT NULL UNIQUE
) CHARACTER SET utf8 COLLATE utf8_general_ci;

--6- Create granted_permissions Table
CREATE TABLE IF NOT EXISTS granted_permissions(
    roleId          INT NOT NULL,
    permissionId    INT NOT NULL,
    PRIMARY KEY (roleId, permissionId),
    FOREIGN KEY (roleId) REFERENCES user_roles(roleId) ON DELETE CASCADE,
    FOREIGN KEY (permissionId)  REFERENCES permissions(permissionId) ON DELETE CASCADE


) CHARACTER SET utf8 COLLATE utf8_general_ci;

--7- Create user_account Table
CREATE TABLE IF NOT EXISTS user_account(
    userId          INT NOT NULL PRIMARY KEY,
    firstName       VARCHAR(30) NOT NULL,
    lastName        VARCHAR(30) NOT NULL,
    gender          VARCHAR(10) NOT NULL,
    dateOfBirth     DATE NULL,
    roleId          INT NOT NULL,
    FOREIGN KEY (roleId) REFERENCES user_roles(roleId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES user_login_data(userId) ON DELETE CASCADE
)CHARACTER SET utf8 COLLATE utf8_general_ci  ;

