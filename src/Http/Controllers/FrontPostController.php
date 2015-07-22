<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 24.06.15
 * Time: 14:17
 */

namespace webvolant\abposts\Http\Controllers;

use App\Http\Controllers\Controller;
use \View;
use \Request;
use webvolant\abposts\Models\Post;


class FrontPostController extends Controller {

    public function jobs(){
        return view('abtemplate.jobs');
    }

    public function job_detail($link){
        $job = Post::where('link','=',$link)->get();
        return view('abtemplate.detail', array('job'=>$job));
    }


} 