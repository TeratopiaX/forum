CREATE TABLE threads (
thread_id        INT(8) NOT NULL AUTO_INCREMENT,
thread_subject       VARCHAR(191) NOT NULL,
thread_date      DATETIME NOT NULL,
thread_board       INT(8) NOT NULL,
thread_by        INT(8) NOT NULL,
PRIMARY KEY (thread_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
