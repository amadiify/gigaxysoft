<?php
namespace Installations\Plugins\Gallery;
use Moorexa\Directive;

class Directives
{
    // directive used
	public static function directives(Directive $injector)
	{
        $injector->set('getImages', 'fetchGalleryDirective');
        $injector->set('imageTable', 'loadGalleryFromPartials');
        $injector->set('galleryFormBody', 'loadGalleryFormBody');
    }
    
    public static function fetchGalleryDirective($maxFetch=5)
    {
        return Query::getImages($maxFetch);
    }

    public static function loadGalleryFromPartials()
    {
        $file = GALLERY_PLUGIN_BASE . 'Partials/gallery.html';
        return \Moorexa\View::loadPartial($file);
    }

    public static function loadGalleryFormBody()
    {
        $file = GALLERY_PLUGIN_BASE . 'Partials/galleryFormBody.html';
        return \Moorexa\View::loadPartial($file);
    }
}