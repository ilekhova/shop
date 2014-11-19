<?php

class AllGoods extends BaseController {



	 public function showGood()
    {
        $good = Item::all();
		return View::make('goods.goods')->with('item', $good);
	

      }
  }