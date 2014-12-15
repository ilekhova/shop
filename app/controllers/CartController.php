<?php

class CartController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	

  
	public function showCart()
	{
			
		$id= Auth::user()->id;
		$order= DB::select(DB::raw('SELECT item.* FROM order_item, orders, item
									WHERE order_item.item_id = item.id AND 
									orders.status = 0 AND
									order_item.order_id = orders.id 
									AND  orders.user_id = '.$id.'')); 



		//$total_price = 
		//return View::make('cart')->with('item', $order/*, $total_price*/);
		return $order;
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

      	public function addtoCart($good_id,$quantity){

          		$user_id= Auth::user()->id;//вытягиваем айдишник юзера из сессии
          		

              $order_id = DB::select(DB::raw('SELECT id FROM orders WHERE status = 0
               AND user_id=.$id.'));
              //проверяем условие того, есть ли этот товар в корзине
              $exists = DB::select(DB::raw("SELECT order_item.* FROM order_item, orders, item
                      WHERE order_item.item_id =.$good_id. AND 
                      orders.status = 0 AND
                      order_item.order_id = orders.id 
                      AND  orders.user_id =.$id."));
              if($exists)
              {
                  //update не тестировала
                   
                  DB::table('users')
                ->where('order_id', '=' , $order_id)
                ->where('item_id','=', $good_id)
                ->increment('quantity',$quantity);
              }
              else{

                    //insert
                    DB::insert('insert into order_item (item_id, order_id,quantity) 
                      values (?, ?, ?)',  array($good_id,$order_item,$quantity));
          	         //не получилось затестить
                  }
    	       }

}
