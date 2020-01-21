<?php

namespace Cms;

interface ThemeInterface
{
    // load images
    public function getImage(string $imageName) : string;

    // load css
    public function getCss(string $cssName) : string;

    // load javascript
    public function getJs(string $jsName) : string;

    // load components
    public static function loadComponents();

    // get component
    public static function getComponent(string $component);
}