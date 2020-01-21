

	'centurion-app' => [
		'dsn' 		=> '{driver}:host={host};dbname={dbname};charset={charset}',
		'driver'    => 'mysql',
		'host' 	    => 'localhost',
		'user'      => 'root',
		'password'  => 'root',
		'dbname'    => 'centurion-app',
		'charset'   => 'utf8mb4',
		'port'      => '',
		'handler'   => 'pdo',
		'prefix'    => '',
		'attributes'=> true,
		'production'=> [
			'driver'  =>   'mysql',
			'host'    =>   '',
			'user'    =>   '',
			'password'  =>   '',
			'dbname'    =>   '',
		],
		'options'   => [ PDO::ATTR_PERSISTENT => true ]
	],
