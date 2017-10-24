
<?php

require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
// else render form
render("quote_form.php", ["title" => "quote"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")

// validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide your stock.");
        }


 ///////////lookup
   $stock = lookup($_POST["symbol"]);
     
  $sym = $stock["symbol"];
   
   $name = $stock["name"];
   
   $price = $stock["price"];
     
 render("quote.php", ["stock" => $stock]);
?>
