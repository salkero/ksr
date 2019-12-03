CREATE TABLE ksr_visited (
    visited_id int NOT NULL AUTO_INCREMENT,
    url varchar(150),
    title varchar(35),
    date DATETIME,
    ip_address varchar(15),
    user_id int,
    url_modifie varchar(150),
    PRIMARY KEY (visited_id)
);