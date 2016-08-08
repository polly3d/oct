<?php namespace Wang\Profile;

use Backend;
use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Controllers\Users as UserController;

/**
 * Profile Plugin Information File
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
            'name'        => 'Profile',
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
        UserModel::extend(function($model){
            $model->hasOne['profile'] = ['Wang\Profile\Models\Profile'];
        });

        UserController::extendFormFields(function($form,$model,$context){
            $form->addTabFields([
                    'profile[headline]'  =>  [
                        'label' =>  'Head line',
                        'tab'   =>  'profile',
                    ],
                    'profile[about_me]'  =>  [
                        'label' =>  'About me',
                        'tab'   =>  'profile',
                        'type'  =>  'textarea',
                    ],
                    'profile[interets]'  =>  [
                        'label' =>  'Interets',
                        'tab'   =>  'profile',
                        'type'  =>  'textarea',
                    ],
                    'profile[books]' =>  [
                        'label' =>  'Books',
                        'tab'   =>  'profile',
                        'type'  =>  'textarea',
                    ],
                    'profile[music]' =>  [
                        'label' =>  'Music',
                        'tab'   =>  'profile',
                        'type'  =>  'textarea',
                    ],
            ]);
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Wang\Profile\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'wang.profile.some_permission' => [
                'tab' => 'Profile',
                'label' => 'Some permission'
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
        return []; // Remove this line to activate

        return [
            'profile' => [
                'label'       => 'Profile',
                'url'         => Backend::url('wang/profile/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['wang.profile.*'],
                'order'       => 500,
            ],
        ];
    }

}
