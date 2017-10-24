
<?php

require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
// else render form
render("sell_form.php", ["title" => "sell"]);
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
      
    $row = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);

    $i=0;
    
    foreach ($row as $value)
    {
         $stock = lookup($row[$i]["symbol"]);
       if ($row[$i]["symbol"] == $_POST["Stock"])
          {
                $stock = lookup($_POST["Stock"]);
                $name = $stock["name"];
                $price = $stock["price"];
                $shares  = $row[$i]["shares"];
                
                if($shares == $_POST["Shares"])
                {
                   CS50::query("DELETE FROM portfolio WHERE user_id = ? AND symbol = ? ", $_SESSION["id"] , $_POST["Stock"]);

////////////////////////insert to history//////////////////sell=0
                CS50::query("INSERT IGNORE INTO history (users, buysell, symbol, shares) VALUES (?, 0,?, ?)", $_SESSION["id"], $_POST["Stock"], $_POST["Shares"]); 
              
                }
                
                else if($shares > $_POST["Shares"] )
                {
                  CS50::query("UPDATE portfolio SET shares = shares - ? WHERE user_id = ?" , $_POST["Shares"] , $_SESSION["id"]);

////////////////////////insert to history//////////////////sell=0
                CS50::query("INSERT IGNORE INTO history (users, buysell, symbol, shares) VALUES (?, 0,?, ?)", $_SESSION["id"], $_POST["Stock"], $_POST["Shares"]); 
               
                }
                
                else if($shares < $_POST["Shares"] )
                {
                  apologize("You don't have so much stock.");
                }
                 
                $cashadd = $price * $shares;
                CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?",$cashadd , $_SESSION["id"]);
                redirect("/");
          }
          
       $i= $i+1;
    }
      apologize("Invalid user's stock.");
      
      



?>
