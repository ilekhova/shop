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

		//$total_price = 
		return View::make('cart')->with('item', $order/*, $total_price*/);
	}


	public function DeleteItem($order_item) //удаляем предмет из корзины
	{
		//получить id предмета можно как: 

		//не тестила
		DB::delete('delete from order_item where id='.$order_item.'');
		return View::make('cart')->with('item', $order);
	}

	public function RefreshCart() 
	{
		 //не затестировала
		$id= Auth::user()->id;
		DB::delete('delete order_item from order_item, orders where orders.status = 0 AND
									order_item.order_id = orders.id 
									AND  orders.user_id = '.$id.'');
		return View::make('cart')->with('item', $order);
	}


}
