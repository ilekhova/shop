<?php
class CartController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
public function showCart()
	{
		$id = Auth::user()->id;
		$order_items= DB::select(DB::raw("SELECT DISTINCT order_item.* FROM order_item, orders ".
									"WHERE orders.status = 0 AND ".
									"order_item.order_id = orders.id ".
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
		
		return $array;
	}
	
	public function DeleteItem() //удаляем предмет из корзины
	{
		$order_item = Input::get('item_id');

		//получить id предмета можно как: 
		//не тестила
		DB::delete('delete from order_item where id='.$order_item.'');
	}
	public function RefreshCart() 
	{
		 //не затестировала
		$id = Auth::user()->id;
		DB::delete('delete order_item from order_item, orders where orders.status = 0 AND
									order_item.order_id = orders.id 
									AND  orders.user_id = '.$id.'');
		return View::make('cart')->with('item', $order);
	}
	// Добавление товара в корзину
	public function addtoCart() {
		$good_id = Input::get('id');
		$query = 'SELECT * FROM addition WHERE ';
		$cream_id = NULL;
		$syrup_id = NULL;
		$sprinkling_id = NULL;
		$additions = Input::get('additions');
		// return var_dump(isset($additions['cream_id']));
		// Проверка на наличие cream_id
		
		if ( isset($additions['cream_id']) ) {
			$cream_id = $additions['cream_id'];
			$query.= "addition.cream_id = $cream_id ";	
		} else {
			$cream_id = NULL;
		}
		
		// Проверка на наличие sypup_id
		if ( isset($additions['syrup_id']) ) {
			$syrup_id = $additions['syrup_id'];
			if ( !empty($cream_id) ) { $query .= 'AND '; }
			$query.= "addition.syrup_id = $syrup_id ";
		} else {
			$syrup_id = NULL;
		}
		// Проверка на наличие sprinkling
		if ( isset($additions['sprinkling_id']) ) {
			$sprinkling_id = $additions['sprinkling_id'];
			if ( !empty($cream_id) || !empty($syrup_id) ) $query .= 'AND ';
		
			$query .= "addition.sprinkling_id = $sprinkling_id ";
		} else {
			$sprinkling_id = NULL;
		}
		
		$query.= "LIMIT 1";
		
		if (!$cream_id && !$syrup_id && !$sprinkling_id) {
			$query = "SELECT * FROM addition WHERE cream_id IS NULL".
			" AND syrup_id IS NULL AND sprinkling_id IS NULL";
		}
		//return var_dump($query);
		$user_id= Auth::user()->id;//вытягиваем айдишник юзера из сессии
		
		$order_id = DB::select(DB::raw("SELECT id FROM orders WHERE status = 0 AND user_id=$user_id LIMIT 1"));
		$order_id = $order_id[0]->id;
		$addition = DB::select(DB::raw($query));
		//return var_dump($addition);
		if (!$addition)
		{
			
			DB::insert('insert into addition(cream_id, syrup_id, sprinkling_id) 
				values (?, ?, ?)', array($cream_id, $syrup_id, $sprinkling_id));
			$add = DB::table('addition')->orderBy('id', 'desc')->first();
			$add = $add->id;
		}
		else{
			$add = $addition[0]->id;
		}
		 //return var_dump($add);
		
		
		//проверяем условие того, есть ли этот товар в корзине
		$exists = DB::select(DB::raw("SELECT order_item.* FROM order_item, orders, item " .
			"WHERE order_item.item_id =$good_id AND " .
			"orders.status = 0 AND " .
			"order_item.order_id = orders.id " .
			"AND orders.user_id = $user_id " .
			"AND order_item.addition_id = $add"));
		if ($exists) {
			
			DB::table('order_item')
			->where('order_id', '=' , $order_id)
			->where('item_id','=', $good_id)
			->where('addition_id','=', $add)
			->increment('quantity',1);
		} else {
			//insert
			DB::insert('insert into order_item(item_id, order_id, quantity, addition_id) 
				values (?, ?, ?, ?)', array($good_id, $order_id, 1, $add));
		
				
		}
	}
	public function SubmitOrder(){
		$user_id = Auth::user()->id;//вытягиваем айдишник юзера из сессии
		$order_id = DB::select(DB::raw("SELECT id FROM orders WHERE status = 0 AND user_id=$user_id LIMIT 1"));
		$order_id = $order_id[0]->id;
		DB::statement("UPDATE orders SET status = 1, modified = NOW() WHERE id = $order_id");
		DB::insert('INSERT INTO orders(user_id, status, created) values(?, ?, ?)', array($user_id, 0, DB::raw('NOW()')));

		return 'ok';
		
	}
	public function MakeXML() {

		$user_id = Auth::user()->id;
		$o = DB::select(DB::raw("SELECT * FROM orders WHERE user_id=$user_id  AND ".
										"id = (SELECT MAX(id) FROM orders)"));
		$o=$o[0];
		
		$order_items= DB::select(DB::raw("SELECT DISTINCT order_item.* FROM order_item, orders ".
										"WHERE order_item.order_id = $o->id ".
										"AND  orders.user_id = $user_id AND orders.status = 1"));
			
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
			$arr->name .= '.    ';
			if (!empty($additions->cream)) {
				
				$arr->total_price += $additions->cream[0]->price;
				$arr->name = $arr->name . 'крем: '.$additions->cream[0]->name  . "     ";
			}	
			if (!empty($additions->syrup)) {
				
				$arr->total_price += $additions->syrup[0]->price;
				$arr->name = $arr->name . 'сироп: ' . $additions->syrup[0]->name  . "     ";
			}	
			if (!empty($additions->sprinkling)) {
				
				$arr->total_price += $additions->sprinkling[0]->price;
				$arr->name = $arr->name . 'посыпка: '. $additions->sprinkling[0]->name ;
			}	
			
			
			array_push($array, $arr);
	}
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><order></order>');
		$xml->addAttribute('version', '1.0');
		//$xml->addChild('datetime', date('Y-m-d H:i:s'));
		$xml->addChild('order_id', $o->id);
	    $xml->addChild('data_time', $o->modified);
	    $person = $xml->addChild('person');
	    $person->addChild('firstname', Auth::user()->first_name);
	    $person->addChild('email', Auth::user()->email);
		$person->addchild('address', Auth::user()->address);
		$order = $xml->addChild('goods');
	   	
	    
	    
	    foreach ($array as $arr) {

	    	//$order_item = $order->addChild('item_name', );
	    	$order_item= $order->addChild('order_item');
	    	$order_item->addChild('name', $arr->name);
	    	$order_item->addChild('quantity', $arr->quantity);
	    	$order_item->addChild('price', $arr->total_price);
	    }
	    $xml->saveXML('test.xml');

	    $response = Response::make($xml->asXML(), 200);
	    $response->header('Content-Type', 'text/xml');
	    $response->header('Cache-Control', 'public');
		$response->header('Content-Description', 'File Transfer');
		$response->header('Content-Disposition', 'attachment; filename=test.xml');
		$response->header('Content-Transfer-Encoding', 'binary');
		$response->header('Content-Type', 'text/xml');
	    return $response;

	}
}	