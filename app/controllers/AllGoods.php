 <?php

class AllGoods extends BaseController {



      	public function showGood()
          {
              $goods = Item::ShowaAll();
      		    return $goods;
            
            }

        public function showAddition()
        {
          $syrup_array=Syrup::ShowAll();
          $cream_array=Cream::ShowAll();
          $sprinkling_array=Sprinkling::ShowAll();
          
          return array(
            array('syrup_id'=> $syrup_array ),
            array('cream_id'=> $cream_array),
            array('sprinkling_id'=> $sprinkling_array)
          );

        }
      
  }