<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="Stock" placeholder="Stock" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="Shares" placeholder="Shares" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Sell
            </button>
        </div>
    </fieldset>
</form>

<?php
    
    $row = CS50::query("SELECT * FROM portfolio WHERE user_id = ?" , $_SESSION["id"]);

      for ($i = 0; $i<10; $i++)
      {
       
               if (empty($row[$i]["symbol"]))
               break;
               
        $symbol = $row[$i]["symbol"];
        $shares = $row[$i]["shares"];
        print("You have purchased the stock = " .$symbol);
        print("  shares = ". $shares.'<br>');

      }
      
 ?>      