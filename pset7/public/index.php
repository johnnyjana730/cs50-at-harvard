<?php

    // configuration
    require("../includes/config.php"); 

    
    $row = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);

//////////////every users can only buy 10 amount stock

    $positions = [];
    $i=0;
    foreach ($row as $value)
        {
             $stock = lookup($row[$i]["symbol"]);
             if ($stock !== false)
             {
                $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row[$i]["shares"],
                "symbol" => $row[$i]["symbol"]
                ];
             }
         
             $i= $i+1;
        }


    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "title" => "portfolio"]);

?>
