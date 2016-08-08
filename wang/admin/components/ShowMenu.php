<?php namespace Wang\Admin\Components;

use Cms\Classes\ComponentBase;
use Wang\Admin\Models\FrontMenu;

class ShowMenu extends ComponentBase
{

    public $menus; 
    public function componentDetails()
    {
        return [
            'name'        => '显示导航栏',
            'description' => 'No description provided yet...'
        ];
    }

    public function onRun()
    {
        $this->menus = FrontMenu::get();
    }

}