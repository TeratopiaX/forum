CREATE TABLE boards (
board_id          INT(8) NOT NULL AUTO_INCREMENT,
board_name        VARCHAR(191) NOT NULL,
board_description     VARCHAR(191) NOT NULL,
UNIQUE INDEX board_name_unique (board_name),
PRIMARY KEY (board_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
