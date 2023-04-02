CREATE TABLE IF NOT EXISTS up_tasks_task
(
	ID INT AUTO_INCREMENT NOT NULL,
	TITLE VARCHAR(255) NOT NULL,
	DESCRIPTION VARCHAR(255),
	DATE_CREATION datetime not null,
	DATE_DEADLINE datetime,
	DATE_UPDATE datetime,
	STATUS VARCHAR(255) not null default 'New',
	PRIORITY VARCHAR(255) not null default 'Normal',
	PRIMARY KEY (ID)
);

