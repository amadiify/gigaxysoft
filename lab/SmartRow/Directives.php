<?php

namespace SmartRow;

// get directive interface
use Moorexa\Interfaces\Directive as MoorexaInterfaceDirective;
use Moorexa\Directive;
use Moorexa\View;
use Moorexa\HttpPost;
use Moorexa\HttpGet;

class Directives implements MoorexaInterfaceDirective
{
	// directive used
	public static function directives(Directive $injector)
	{
		$injector->set('smartRow', 'smartRow');
	}

	// view tags method
	public static function smartRow($table)
	{
		$engine = new Engine($table);
		$partial = View::partial($engine->partial, ['smartrow' => $engine->partialData]);

		return $partial;
	}
}