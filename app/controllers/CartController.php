<?php

class CartController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	

  
	public function showCart()
	{
			
		$id= Auth::user()->id; //вытягиваем id user'a из сессии
		$order= DB::select(DB::raw('SELECT item.* FROM order_item, orders, item
									WHERE order_item.item_id = item.id AND 
									orders.status = 0 AND
									order_item.order_id = orders.id 
									AND  orders.user_id = '.$id.'')); 

		return View::make('cart')->with('item', $order);
	}



}
