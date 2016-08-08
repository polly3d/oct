<?php namespace Wang\Admin;

use Backend;
use System\Classes\PluginBase;

/**
 * Admin Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Admin',
            'description' => 'No description provided yet...',
            'author'      => 'Wang',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Wang\Admin\Components\MyToDoList' => 'myTodoList',
            'Wang\Admin\Components\ShowMenu' => 'showMenu',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'wang.admin.task_permission' => [
                'tab' => 'Admin',
                'label' => 'Task Permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'admin' => [
                'label'       => 'Admin',
                'url'         => Backend::url('wang/admin/menucontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['wang.admin.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Wang\Admin\FormWidgets\Currency' => [
                'label' => 'Currency editor',
                'code'  => 'currency'
            ]
        ];
    }

}
