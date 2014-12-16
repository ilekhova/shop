 <?php

class AllGoods extends BaseController {



      	public function showGood()
        {
          $goods = Item::ShowAll();
  		    return $goods;
            
        }

        public function showAddition()
        {
          $syrup_array=Syrup::getAll();
          $cream_array=Cream::getAll();
          $sprinkling_array=Sprinkling::getAll();
          
          return array(
            array('syrup_id'=> $syrup_array),
            array('cream_id'=> $cream_array),
            array('sprinkling_id'=> $sprinkling_array)
          );

        }
      
  }