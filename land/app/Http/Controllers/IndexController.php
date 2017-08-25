<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Service;
use App\Portfolio;
use App\People;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {
        //выбираем все данные из таблички page
        $pages = Page::all();
        $portfolios = Portfolio::get(array('name', 'filter', 'images'));
        $services = Service::where('id', '<', 20)->get();
        $peoples = People::take(3)->get();

       // dd($pages);//колекция моделей Page

        $menu = array();

        foreach ($pages as $page) {
            //item -отдельный пункт меню
            $item = array('title' => $page->name, 'alias'=>$page->alias);
            //$menu - массив в который будут добавлены доп. ячейки
            array_push($menu, $item );

        }
       // dd($menu);
        //данные не из базы а из html шаблона
        //alias - id section
        $item = array('title'=>'Services', 'alias'=>'services');
        array_push($menu, $item );

        $item = array('title'=>'Portfolio', 'alias'=>'Portfolio');
        array_push($menu, $item );

        $item = array('title'=>'Team', 'alias'=>'team');
        array_push($menu, $item );

        $item = array('title'=>'Contact', 'alias'=>'contact');
        array_push($menu, $item );

        //передаем в макет переменные

        return view('site.index');
    }
}
