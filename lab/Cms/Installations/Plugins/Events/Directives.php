<?php
namespace Installations\Plugins\Events;
use Moorexa\Directive;

class Directives
{
    // directive used
	public static function directives(Directive $injector)
	{
        $injector->set('getEvents', 'fetchEventDirective');
        $injector->set('eventTable', 'loadEventsFromPartials');
    }
    
    public static function fetchEventDirective($maxFetch=5)
    {
        return Query::getEvents($maxFetch);
    }

    public static function loadEventsFromPartials()
    {
        $file = EVENTS_PLUGIN_BASE . 'Partials/events.html';
        return \Moorexa\View::loadPartial($file);
    }
}