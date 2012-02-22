<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
        <script type="text/javascript" src="../js/scripts.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <form action="" method="post" name="searchForm" id="searchForm">
                  <label for="music">Jag lyssnar på</label>
                  <input type="text" name="searchQuery" id="searchQuery">
                  <input type="radio" name="type" value="TRACK">LÅT
                  <input type="radio" name="type" value="ARTIST">ARTIST
                  <input type="radio" name="type" value="ALBUM">ALBUM
                  <input type="submit" name="searchBtn" value="Sök">
                </form>
            </div>
            <?php 
                if(isset($_GET['recipe']) && $_GET['recipe'] !=""){
                    require_once('recipe.php');
                }
            ?>
        </div>
      </div>
    </body>
</html>