<?php

class OrdersController extends BaseController {

	public function showOrder($order_id)
	{
		// $order_id = Input::get('order_id');
		$id = Auth::user()->id;
		$order_items= DB::select(DB::raw("SELECT DISTINCT order_item.* FROM order_item, orders ".
									"WHERE ".
									"order_item.order_id = $order_id ".
									"AND orders.user_id = $id"));
		
		$array = array();
		foreach ($order_items as $order_item) {
			
			
			$items= DB::select(DB::raw("SELECT * FROM item WHERE item.id = $order_item->item_id LIMIT 1"));
			$arr = new StdClass();
			$arr = $items[0];
			
			$additions = new StdClass();
			$additions->cream = DB::select(DB::raw("SELECT cream.* FROM cream, addition ".
			" WHERE addition.id = $order_item->addition_id AND addition.cream_id = cream.id LIMIT 1"));
			$additions->syrup = DB::select(DB::raw("SELECT syrup.* FROM syrup, addition ".
			" WHERE addition.id = $order_item->addition_id AND addition.syrup_id = syrup.id LIMIT 1"));
			$additions->sprinkling = DB::select(DB::raw("SELECT sprinkling.* FROM sprinkling, addition ".
			" WHERE addition.id = $order_item->addition_id AND addition.sprinkling_id = sprinkling.id LIMIT 1"));
			
			$arr->order_item = $order_item->id;
			$arr->quantity = $order_item->quantity;
			$arr->additions = $additions; 
			$arr->total_price = $arr->price;
			if (!empty($additions->cream)) {
				
				$arr->total_price += $additions->cream[0]->price;
			}	
			if (!empty($additions->syrup)) {
				
				$arr->total_price += $additions->syrup[0]->price;
			}	
			if (!empty($additions->sprinkling)) {
				
				$arr->total_price += $additions->sprinkling[0]->price;
			}	
			
			
			array_push($array, $arr);
		}

		// return json_encode($array);
		
		return $array;
	}

	public function listsOrder() {

		$id = Auth::user()->id;
		$orders= DB::select(DB::raw("SELECT * FROM orders ".
									"WHERE status = 1 AND ".
									"user_id = $id"));
		return json_encode($orders);
		//можно выводить номер заказа (его Id) и дату заказа (modified)
		//можно тыкать на номер заказа и там уже через showOrder показывать содержимое
      }

  }