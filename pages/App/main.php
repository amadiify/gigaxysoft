<?php
use Moorexa\Model;
use Moorexa\Packages as Package;
use Moorexa\Controller;
use WekiWork\Http;
/**
 * Documentation for App Page can be found in App/readme.txt
 *
 *@package	App Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class App extends Controller
{
	/**
    * App/home wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function home()
	{
		$this->render('home');
	}
	/**
    * App/about wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function about()
	{
		$this->render('about');
	}
	/**
    * App/contact wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function contact()
	{
		$this->render('contact');
	}
	/**
    * App/focus wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function focus()
	{
		$this->render('focus');
	}
	/**
    * App/events wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function events()
	{
		$this->render('events');
	}
	/**
    * App/gallery wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function gallery()
	{
        $this->requirecss('http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css');
        $this->requirejs('http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js', 'before gallery.js');


		$this->render('gallery');
	}
}
// END class