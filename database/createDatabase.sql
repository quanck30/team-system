-- テーブル作る
-- 2026/04/28


-- DROP TABLE
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS safety;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS department;
DROP TABLE IF EXISTS job;
DROP TABLE IF EXISTS status;
DROP TABLE IF EXISTS canwork;

SET FOREIGN_KEY_CHECKS = 1;
-- CREATE TABLE
CREATE TABLE IF NOT EXISTS job(
    job_no INT AUTO_INCREMENT PRIMARY KEY,
    jname VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS department(
    dept_no INT AUTO_INCREMENT PRIMARY KEY,
    dname VARCHAR(50),
    mgr_no VARCHAR(50)
);
CREATE TABLE IF NOT EXISTS status(
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(50)
);
CREATE TABLE IF NOT EXISTS canwork(
    can_work_no INT AUTO_INCREMENT PRIMARY KEY,
    can_work VARCHAR(50)
);
CREATE TABLE IF NOT EXISTS employee (
    emp_no VARCHAR(50) PRIMARY KEY,
    ename VARCHAR(50) NOT NULL,
    birthday DATE,
    sex VARCHAR(1),
    tel VARCHAR(20),
    address VARCHAR(100),
    job_no INT ,
    dept_no INT ,
    password VARCHAR(255),
    FOREIGN KEY (job_no) REFERENCES job(job_no),
    FOREIGN KEY (dept_no) REFERENCES department(dept_no)
);

CREATE TABLE IF NOT EXISTS safety (
    safety_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_no VARCHAR(50) ,
    status_id INT NOT NULL,
    comment VARCHAR(255) ,
    current_location VARCHAR(255),
    can_work_no INT NOT NULL,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (emp_no) REFERENCES employee(emp_no),
    FOREIGN KEY (status_id) REFERENCES status(status_id),
    FOREIGN KEY (can_work_no) REFERENCES canwork(can_work_no)
);

ALTER TABLE department
ADD CONSTRAINT fk_mgr
FOREIGN KEY (mgr_no) REFERENCES employee(emp_no);