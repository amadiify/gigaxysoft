<?php

/**
 * Database configuration
 *
 * @return array set of database configurations
 * @author Moorexa <www.moorexa.com> 
 **/

$kernel->db([

	//enable access from PHP to MYSQL database.
	
	'new-db' => [
		'dsn' 		=> '{driver}:host={host};dbname={dbname};charset={charset}',
		'driver'    => 'mysql',
		'host' 	    => '',
		'user'      => '',
		'password'  => '',
		'dbname'    => '',
		'charset'   => 'utf8mb4',
		'port'      => '',
		'attributes'=> true,
		'handler'   => 'pdo',
		'production'=> [
			'driver'  =>   'mysql',
			'host'    =>   '',
			'user'    =>   '',
			'password'  =>   '',
			'dbname'    =>   '',
		],
	],

	'gigaxy-app' => [
		'dsn' 		=> '{driver}:host={host};dbname={dbname};charset={charset}',
		'driver'    => 'mysql',
		'host' 	    => 'localhost',
		'user'      => 'root',
		'password'  => 'root',
		'dbname'    => 'gigaxy-app',
		'charset'   => 'utf8mb4',
		'port'      => '',
		'handler'   => 'pdo',
		'prefix'    => 'Gigaxy_',
		'attributes'=> true,
		'production'=> [
			'driver'  	=>   'mysql',
			'host'    	=>   '',
			'user'    	=>   '',
			'password'  =>   '',
			'dbname'    =>   '',
		],
		'testing'=> [
			'driver'  	=>   'mysql',
			'host'    	=>   'mysql5021.site4now.net',
			'user'    	=>   'a0c157_centurn',
			'password'  =>   'demo@2020',
			'dbname'    =>   'db_a0c157_centurn',
		],
		'options' => [ PDO::ATTR_PERSISTENT => true ]
	],



// choose from any of your configuration for a default connection
])
->default(['development' => 'gigaxy-app', 'live' => ''])
->domain('console.fregatelab.com', ['live' => 'gigaxy-app@testing']);

