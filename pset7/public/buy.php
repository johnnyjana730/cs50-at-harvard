<?php

require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
// else render form
render("buy_form.php", ["title" => "buy"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")

// validate submission

        if (empty($_POST["Stock"]))
        {
            apologize("You must provide your stock.");
        }
        
        else if (empty($_POST["Shares"]))
        {
            apologize("You must provide your Shares.");
        }
        
        else if(!preg_match("/^\d+$/", $_POST["Shares"]))
        {
            apologize("You provide the negtive number of Shares.");
        }
        
      
    $row = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
    $rowcs = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $rowcs[0]["cash"];
    
    $i=0;
    
    $stock = lookup($_POST["Stock"]);
    $name = $stock["name"];
    $price = $stock["price"];
    
/////////////if users have buy stock////////////    
    foreach ($row as $value)
    {
         
       if ($row[$i]["symbol"] == $_POST["Stock"])
          {
                $stock = lookup($_SESSION["id"]);
                $shares  = $row[$i]["shares"];
                
/////////////check users money//////////
                if($cash < $price * $_POST["Shares"]) 
                {
                    apologize("You have not enough money.");
                }
/////////////////////insert new stock into users///////////             
                CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES(?, ?, ?) ON
                DUPLICATE KEY UPDATE shares = shares + ?",$_SESSION["id"], $_POST["Stock"], $shares, $_POST["Shares"]);
                
////////////////////////insert to history//////////////////
                CS50::query("INSERT IGNORE INTO history (users, buysell, symbol, shares) VALUES (?, 1,?, ?)", $_SESSION["id"], $_POST["Stock"], $_POST["Shares"]); 
                 
                $cashadd = $price * $_POST["Shares"];
                
                CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?",$cashadd , $_SESSION["id"]);
                redirect("/");
          }
          
       $i= $i+1;
    }
         if($cash < $price * $_POST["Shares"]) 
         {
              apologize("You have not enough money.");
         }
/////////////if users don't buy stock/////////////////////
        CS50::query("INSERT IGNORE INTO portfolio (user_id, symbol, shares) VALUES (?, ?, ?)", $_SESSION["id"], $_POST["Stock"], $_POST["Shares"]);
        
        $cashadd = $price * $_POST["Shares"];
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?",$cashadd , $_SESSION["id"]);
////////////////////////insert to history//////////////
        CS50::query("INSERT IGNORE INTO history (users, buysell, symbol, shares) VALUES (?, 1,?, ?)", $_SESSION["id"], $_POST["Stock"], $_POST["Shares"]);       
        redirect("/");


?>
