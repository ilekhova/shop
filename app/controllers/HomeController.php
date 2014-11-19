<?php

class HomeController extends BaseController {



	public function index()
	{
		$items = DB::raw('SELECT * from item');
  		foreach(DB::raw('item.item_id') as $value)
  		{
            echo $value, "<br>";
	}

}
      }