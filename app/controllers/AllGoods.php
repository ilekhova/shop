<?php

class AllGoods extends BaseController {



      	public function showGood()
          {
              $good = Item::ShowaAll();
      		    return View::make('goods.goods')->with('item', $good);
            
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