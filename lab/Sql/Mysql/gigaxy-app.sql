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
CREATE TABLE IF NOT EXISTS `Zema_assets` (
	assetid BIGINT(20) auto_increment primary key, 
	path VARCHAR(255) , 
	tag VARCHAR(255) default 'css', 
	visible TINYINT default 1, 
	position INT default 1, 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_config` (
	configid BIGINT(20) auto_increment primary key, 
	sitename VARCHAR(255) , 
	default_controller VARCHAR(255) , 
	default_view VARCHAR(255) , 
	favicon VARCHAR(255) , 
	keywords TEXT , 
	description TEXT , 
	developer VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_containers` (
	containerid BIGINT(20) auto_increment primary key, 
	container_name VARCHAR(255) , 
	container_body TEXT , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_directives` (
	directiveid BIGINT(20) auto_increment primary key, 
	directive VARCHAR(255) , 
	directive_class VARCHAR(255) , 
	directive_method VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_images` (
	imageid BIGINT(20) auto_increment primary key, 
	image_path VARCHAR(255) , 
	alt VARCHAR(255) , 
	title VARCHAR(255) , 
	image_name VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_installations` (
	installationid BIGINT(20) auto_increment primary key, 
	installation_type VARCHAR(255) , 
	installation_path VARCHAR(255) , 
	installation_title VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_navigation` (
	navigationid BIGINT(20) auto_increment primary key, 
	page_name VARCHAR(255) , 
	page_link VARCHAR(255) , 
	navigationtypeid INT , 
	visible TINYINT default 1, 
	position INT default 1, 
	parentid BIGINT default 0, 
	keyword VARCHAR(255) , 
	description TEXT , 
	page_title VARCHAR(255) , 
	breadcum_title VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_navigationtypes` (
	navigationtypeid BIGINT(20) auto_increment primary key, 
	navigationtype VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_permission` (
	permissionid BIGINT(20) auto_increment primary key, 
	permission VARCHAR(255) , 
	permission_group TEXT , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_slides` (
	slideid BIGINT(20) auto_increment primary key, 
	slide_title VARCHAR(255) , 
	slide_group VARCHAR(255) default 'homescreen', 
	slide_image VARCHAR(255) , 
	slide_btn VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_slidesAnimation` (
	slidesAnimationid BIGINT(20) auto_increment primary key, 
	slideid BIGINT , 
	content VARCHAR(255) , 
	contentWrapper VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_users` (
	userid BIGINT(20) auto_increment primary key, 
	permissionid BIGINT default 1, 
	username VARCHAR(255) , 
	password VARCHAR(255) , 
	fullname VARCHAR(255) , 
	createdby BIGINT default 0, 
	dateadded DATETIME default CURRENT_TIMESTAMP, 
	loggedinToken VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Gigaxy_contact` (
	contactid BIGINT(20) auto_increment primary key, 
	con_name VARCHAR(255) , 
	con_email VARCHAR(255) , 
	con_subject VARCHAR(255) , 
	con_message TEXT
);
CREATE TABLE IF NOT EXISTS `Gigaxy_serviceGroups` (
	serviceGroupid BIGINT(20) auto_increment primary key, 
	serviceGroup VARCHAR(255) , 
	serviceShortName VARCHAR(255)
);
ALTER TABLE `Gigaxy_services` ADD serviceGroupid BIGINT AFTER service_body;
CREATE TABLE IF NOT EXISTS `Gigaxy_services` (
	serviceid BIGINT(20) auto_increment primary key, 
	service_title VARCHAR(255) , 
	service_body TEXT , 
	serviceGroupid BIGINT
);