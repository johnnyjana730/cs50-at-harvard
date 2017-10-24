<div>
    <iframe allowfullscreen frameborder="0" height="315" src="https://www.youtube.com/embed/oHg5SJYRHA0?autoplay=1&iv_load_policy=3&rel=0" width="420"></iframe>
</div>


<table  style="margin-left: auto; margin-right: auto;" width="800" height="80" border="1">

    <?php
    
    $row = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
    
    
      for ($i = 0; $i<10; $i++)
      {
       
               if (empty($row[$i]["symbol"]))
               break;
               
        $symbol = $row[$i]["symbol"];
        print("You have purchased the stock: ". $symbol.'<br>');

      }
///////////////print table///////      
     print('<br>');
     foreach ($positions as $position)
     { 
        print("<tr>");
        print("<td>" . $position["symbol"] . "</td>");
        print("<td>" . $position["name"] . "</td>");
        print("<td>" . $position["shares"] . "</td>");
        print("<td>" . $position["price"] . "</td>");
        print("<tr>");
     }
////////////print user information////////////     

    $rows = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
         print("<tr>");
         print("<td>" ."users total cash = ". $rows[0]["cash"] . "</td>");
         print("<tr>");
    ?>
    
</table>


