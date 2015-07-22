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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class PostController extends Controller {

    public function index()
    {
        $items = Post::all();
        return view('abposts::backend.index',array('posts' => $items));
    }

    public function add()
    {
        if (\Request::all()){
            $validator = \Validator::make(\Request::all(), [
                /*'email' => array('required','unique:users,email'),
                'name' => 'required',
                'password' => array('required','confirmed'),
                'password_confirmation' => array('required'),
                'role' => 'required',
                'status' => 'required',*/
                'logo'=>array('mimes:jpeg,jpg,png,bmp,gif,svg'),
            ]);

            if ($validator->fails()) {
                return \Redirect::route('post/add')->withErrors($validator)->withInput();
            }
            else{
                //dd(\Request::all());
                $item = new Post();

                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties):
                    $title_lang = "title_$localeCode";
                    $short_description_lang = "short_description_lang_$localeCode";
                    $description_lang = "description_$localeCode";
                    $keywords_lang = "keywords_$localeCode";
                    $item->$title_lang = \Request::get($title_lang);
                    $item->$short_description_lang = \Request::get($short_description_lang);
                    $item->$description_lang = \Request::get($description_lang);
                    $item->$keywords_lang = \Request::get($keywords_lang);
                endforeach;

                $item->status = \Request::get('status');
                //$item->link = Helper::alias(\Request::get('title'));

                $item->save();
                if (\Request::hasFile('logo')) {
                    $dir = '/uploads/post'.date('/Y/'.$item->id.'/');
                    $image = \Request::file('logo');
                    $filename = $image->getClientOriginalName();

                    $image->move(public_path().$dir, $filename);

                    //dd($dir.$filename);
                    //large

                    $large = \Image::make(url().$dir.$filename);
                    $large->resize(config('config.large_width'),config('config.large_height'));
                    //$img->insert(public_path().'/template_image/watermark.png');
                    $large->save(public_path().$dir.'large_'.$filename);
                    $item->large_thumb = $dir.'large_'.$filename;

                    $img_normal = \Image::make(url().$dir.$filename);
                    $img_normal->resize(config('config.normal_width'), config('config.normal_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_normal->save(public_path().$dir.'normal_'.$filename);
                    $item->normal_thumb = $dir.'normal_'.$filename;

                    $img_small = \Image::make(url().$dir.$filename);
                    $img_small->resize(config('config.small_width'), config('config.small_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_small->save(public_path().$dir.'small_'.$filename);
                    $item->small_thumb = $dir.'small_'.$filename;
                    $item->save();
                }

                return \Redirect::route('post/index');
            }
        }
        return view('abposts::backend.add');
    }

    public function edit($link)
    {
        $item = Post::find($link);

        if (\Request::all()){
            $validator = \Validator::make(\Request::all(), [
                'logo'=>array('mimes:jpeg,jpg,png,bmp,gif,svg'),
            ]);

            if ($validator->fails()) {
                return \Redirect::route('post/edit',array('item'=>$item))->withErrors($validator)->withInput();
            }
            else{
                //dd(url());
                if (\Request::hasFile('logo')) {
                    $dir = '/uploads/post'.date('/Y/'.$item->id.'/');
                    $image = \Request::file('logo');
                    $filename = $image->getClientOriginalName();

                    $image->move(public_path().$dir, $filename);

                    //dd($dir.$filename);
                    //large

                    $large = \Image::make(url().$dir.$filename);
                    //$large->resize(config('config.large_width'),config('config.large_height'));
                    //$img->insert(public_path().'/template_image/watermark.png');
                    $large->save(public_path().$dir.'large_'.$filename);
                    $item->large_thumb = $dir.'large_'.$filename;

                    $img_normal = \Image::make(url().$dir.$filename);
                    $img_normal->resize(config('config.normal_width'), config('config.normal_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_normal->save(public_path().$dir.'normal_'.$filename);
                    $item->normal_thumb = $dir.'normal_'.$filename;

                    $img_small = \Image::make(url().$dir.$filename);
                    $img_small->resize(config('config.small_width'), config('config.small_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_small->save(public_path().$dir.'small_'.$filename);
                    $item->small_thumb = $dir.'small_'.$filename;

                    //$item->normal_thumb = $dir.$filename;
                    //$item->save();

                }

                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties):
                    $title_lang = "title_$localeCode";
                    $short_description_lang = "short_description_lang_$localeCode";
                    $description_lang = "description_$localeCode";
                    $keywords_lang = "keywords_$localeCode";
                    $item->$title_lang = \Request::get($title_lang);
                    $item->$short_description_lang = \Request::get($short_description_lang);
                    $item->$description_lang = \Request::get($description_lang);
                    $item->$keywords_lang = \Request::get($keywords_lang);
                endforeach;

                $item->status = \Request::get('status');
                //$item->link = Helper::alias(\Request::get('title'));
                $item->save();

                return \Redirect::route('post/index');
            }
        }
        return view('abposts::backend.edit', array('item'=>$item));
    }

    public function delete($id)
    {
        $item = Post::find($id);
        $item->delete();
        return \Redirect::route("post/index");
    }


} 