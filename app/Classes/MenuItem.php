<?php

namespace App\Classes;

class MenuItem
{
    public $icon;
    public $title;
    public $description;
    public $url;

    public function __construct($title, $url, $description = '', $icon = null)
    {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->icon = $icon;
    }
}
