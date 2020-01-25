CREATE TABLE IF NOT EXISTS `Gigaxy_services` (
	serviceid BIGINT(20) auto_increment primary key, 
	service_title VARCHAR(255) , 
	service_body TEXT
);

CREATE TABLE IF NOT EXISTS `Zema_Events` (
	eventid BIGINT(20) auto_increment primary key, 
	event_title VARCHAR(255) , 
	event_body TEXT , 
	event_date VARCHAR(255) , 
	date_created DATETIME default CURRENT_TIMESTAMP, 
	event_image VARCHAR(255) , 
	event_button VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_PhotoBoot` (
	imageid BIGINT(20) auto_increment primary key, 
	image_name VARCHAR(255) , 
	image_caption TEXT , 
	image VARCHAR(255) , 
	date_created DATETIME default CURRENT_TIMESTAMP, 
	publish VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_tables` (
	tableid BIGINT(20) auto_increment primary key, 
	table_identifier VARCHAR(255) , 
	table_linker VARCHAR(255) , 
	table_json TEXT , 
	siteid VARCHAR(255)
);