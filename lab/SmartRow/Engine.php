<?php

namespace SmartRow;

// use moorexa db
use Moorexa\DB;

// call get and post
use Moorexa\HttpGet;
use Moorexa\HttpPost;

/**
 *@package SmartRow Engine
 *@author Amadi ifeanyi <amadiify.com>
 */

class Engine
{
	// current working table
	private $table;
	// partial root
	private $partialRoot = 'lab/SmartRow/partials/';
	// partials to load
	public $partial = '';
	// valid partials
	private $validPartials = ['view', 'edit', 'create'];
	// data to pass to partial
	public $partialData = null;

	// constructor
	public function __construct($table)
	{
		// set a default action
		$action = 'view';

		$this->table = $table;
		$this->partial = $this->partialRoot . $action . '.html';

		$get = new HttpGet();

		if ($get->has('smartrow', $actionByUrl))
		{
			// check for action
			foreach ($this->validPartials as $index => $action)
			{
				if ($actionByUrl == $action)
				{
					// call action
					$this->partial = $this->partialRoot . $action . '.html';
					break;
				}
			}
		}

		// listen for event
		$eventName = 'on' . ucwords($action) . 'Init';

		if (method_exists($this, $eventName))
		{
			// call
			call_user_func([$this, $eventName]);
		}
	}

	// event emmiters
	public function onViewInit(){

		// get all rows from table

		if ($this->table !== null)
		{
			$rows = null;

			if (is_object($this->table))
			{
				$rows = $this->table;
			}
			else
			{
				$rows = DB::table($this->table)->get();
			}

			// get table name;
			$table = $rows->table;

			var_dump($table);
		}
	}
	public function onEditInit(){}
	public function onCreateInit(){}
}