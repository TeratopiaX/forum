CREATE TABLE posts (
post_id         INT(8) NOT NULL AUTO_INCREMENT,
post_content        TEXT NOT NULL,
post_date       DATETIME NOT NULL,
post_thread      INT(8) NOT NULL,
post_by     INT(8) NOT NULL,
PRIMARY KEY (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
