<?php

namespace App\Controllers;
use App\Modules\Breadcrumbs\Breadcrumbs;

class Home extends BaseController
{
    public $breadcrumb;
    private $title;

    public function __construct()
    {
        $this->title = 'Home';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
        ];

        return view('home', $data);
    }
}
