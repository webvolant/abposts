<?php


namespace webvolant\abposts\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Post extends Model
{

    protected $table = 'posts';

    /*function __construct()
    {
        $this->lang = App::getLocale();
    }

    public function getShortDescriptionAttribute()
    {
        return $this->attributes['content_'.$this->lang];
    }
*/
    //protected $fillable = array('name', 'email', 'password', 'role');

    //protected $hidden = array('password', 'remember_token');

/*
    public static function getStrRole($role){
        return config('config.roles')[$role];
    }

    public static function getStrStatus($status){
        return config('config.status')[$status];
    }
*/
}
