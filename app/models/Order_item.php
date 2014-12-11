<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Order_item {

	//use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'order_item';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
*/
		 public function getProduct($id)
	  { 
		$get = DB::select(DB::raw('SELECT * FROM order_item WHERE id='$id''));
		 
		
			$product=array(
				"id"=>$get->id,
				"item_id"=>$get->item_id,
				"order_id"=>$get->order_id,
				"addition_id"=>$row->addition_id
			);
			
		  
		  return $product; 
	  }
	  
	  public function getProductPrice($id)
	  { 
		 $sql = "SELECT price FROM product WHERE id='$id'";
		 $result = mysql_query($sql)  or die(mysql_error());
	
		 if($row = mysql_fetch_object($result))
		 {	 
		
			 return $row->price; 
		 }
		  return false; 
	  }
}