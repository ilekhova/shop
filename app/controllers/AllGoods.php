<?php

class AllGoods extends BaseController {



	 public function showGood()
    {
        $good = Item::all();
		return View::make('goods.goods')->with('item', $good);
      }

      	public function addtoCart($good_id,$quantity){
/*
      		$id= Auth::user()->id;//вытягиваем айдишник юзера из сессии
      		//дальше определяем неоформленный заказ (для корзины)
      		$order= DB::select(DB::raw('SELECT orders.* FROM users, orders LIMIT 1
									WHERE orders.status = 0 
									AND  orders.user_id = '.$id.''));
      DB::insert('insert into order_item (item_id, order_id,quantity) values (?, ?,?)', 
      	array($good_id, $order['id'] ,$quantity)); //не получилось затестить*/
	}
  }