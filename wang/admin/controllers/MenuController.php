<?php namespace Wang\Admin\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Cms\Classes\Theme;
use Cms\Classes\Page;

use Event;

/**
 * Menu Controller Back-end Controller
 */
class MenuController extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Wang.Admin', 'admin', 'menucontroller');

        // Event::listen('backend.list.overrideColumnValue', function ($widget, $record, $column, $value){
        //     return $this->listOverrideColumnValue1($record, $column);
        // });
    }

    public function index()
    {
        
        
        $this->asExtension('ListController')->index();
    }

    /**
     * Called after the list columns are defined.
     * @param \Backend\Widgets\List $host The hosting list widget
     * @return void
     */
    public function listExtendColumns($host)
    {
        $host->bindEvent('list.overrideColumnValue', function ($record, $column, $value){
            return $this->listOverrideColumnValue1($record, $column);
        });
    }

    /**
     * Replace a table column value (<td>...</td>)
     * @param  Model $record The populated model used for the column
     * @param  string $columnName The column name to override
     * @param  string $definition List definition (optional)
     * @return string HTML view
     */
    public function listOverrideColumnValue1($record, $column)
    {
        if($column->type == 'number')
        {
            $columnName = $column->columnName;
            return '￥' . $record->$columnName;
        }
    }
}