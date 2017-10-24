
<?php
     
   $sym = $stock["symbol"];
   
   $name = $stock["name"];
   
   $price = $stock["price"];
   
   
   $price1 = number_format($price, 2, '.', '');
   
     print("Symbol: ". $sym .'<br>' );


     print(" Name: ". $name.'<br>' );

     print(" Price: ".  $price1.'<br>' );

?>