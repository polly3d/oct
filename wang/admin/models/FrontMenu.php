<?php namespace Wang\Admin\Models;

use Model;
use Cms\Classes\Theme;
use Cms\Classes\Page;

/**
 * FrontMenu Model
 */
class FrontMenu extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'wang_admin_front_menus';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getUrlOptions($keyValue = null)
    {
        $theme = Theme::getEditTheme();
        $pageLimit = Page::listInTheme($theme);
        $url = [];
        foreach ($pageLimit as $key => $value) {
            $url[$value->settings['url']] = $value->settings['title'];
        }

        return $url;
    }

}