<?php

namespace Moorexa;

use utility\Classes\BootMgr\Manager as Boot;

/**
 * @package Boot Manager
 */

 Route::web(function(){
     // registered in /Config/aliases.php
    \Cms\Config::loadBoot();
 });
