CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE time_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timedata_user_id INT NOT NULL,
    timedata_user_name VARCHAR(100) NOT NULL,
    hour INT NOT NULL,
    minute INT NOT NULL,
    second INT NOT NULL,
    subtime VARCHAR(20) NOT NULL,
    datetime VARCHAR(20) NOT NULL,
    timedataformat VARCHAR(100) NULL,
    FOREIGN KEY (timedata_user_id) REFERENCES users(id),
    FOREIGN KEY (timedata_user_name) REFERENCES users(username)
);

CREATE TABLE totaltime_data (
    totaltime_user_id INT NOT NULL,
    totaltime_user_name VARCHAR(100) NOT NULL,
    total_hours INT NOT NULL DEFAULT 0,
    total_minutes INT NOT NULL DEFAULT 0,
    total_seconds INT NOT NULL DEFAULT 0,
    minute_format INT NOT NULL DEFAULT 0,
    second_format INT NOT NULL DEFAULT 0,
    timeformat VARCHAR(255) NOT NULL DEFAULT '00:00:00',
    global_timeformat VARCHAR(20) NOT NULL DEFAULT '00:00:00',
    FOREIGN KEY (totaltime_user_id) REFERENCES users(id),
    FOREIGN KEY (totaltime_user_name) REFERENCES users(username)
);