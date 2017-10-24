<table  style="margin-left: auto; margin-right: auto;" width="800" height="80" border="1">

<?php

    // configuration
    require("../includes/config.php"); 

////////buy==1 sell==0
   
    
    $row = CS50::query("SELECT * FROM history WHERE users = ? ", $_SESSION["id"]);
    $rowcs = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $rowcs[0]["cash"];
    
      for ($i = 0; $i>=0; $i++)
      {
         if (empty($row[$i]["symbol"]))
         break;

/////////////judugement buy or sell  
        if($row[$i]["buysell"] == 1)
         $buysell = "buy";
        
        if($row[$i]["buysell"] == 0)
         $buysell = "sell";
        
        $symbol = $row[$i]["symbol"];
        $shares = $row[$i]["shares"];
      
        print("<tr>");
        print("<td>" . "stock = " .$symbol . "</td>");
        print("<td>" . $buysell . "</td>");
        print("<td>" . "shares = " .$shares . "</td>");
        print("<tr>");
       
      }
    print("  Your total cash = ". $cash.'<br>');  
   

?>

</table>