<?php
if(isset($_GET['query'], $_GET['type']) && $_GET['query'] !="" && $_GET['type'] !=""){
    require_once('classes/Search.class.php');
    require_once('classes/Spotify.class.php');
    $query = $_GET['query'];
    $type = $_GET['type'];
    $search = new Search($query, $type);
    $recId = $search->recId();

    if($recId){
        $recipeUrl = "http://localhost/carbin/resources/?recipes/$recId";
        $recipeJson = file_get_contents($recipeUrl);
        $recipeData = json_decode($recipeJson);

        $ingredientsUrl = "http://localhost/carbin/resources/?recipes/$recId/ingredients";
        $ingredientsJson = file_get_contents($ingredientsUrl);
        $ingredientsData = json_decode($ingredientsJson);
        $numIng = count($ingredientsData);

        $spotify = new Spotify($query, $type);
        $spotifyHref = $spotify->getHref();
        $spotifyName = $spotify->getName();
    }
}
?>
<div id="recipe">
    <a href ="<?php echo $spotifyHref; ?>"><?php echo $spotifyName; ?></a>
    
    <h1><?php echo $recipeData[0]->title; ?></h1>

<?php if($numIng > 0){ ?>
    <div id="ingredients">
        <h2>Ingredienser</h2>
        <ul>
            <?php for($i = 0; $i < $numIng; $i++){ ?>
                <li><?php echo $ingredientsData[$i]->ingredient; ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
    <div id="descriptions"><?php echo $recipeData[0]->description; ?></div>
    <div id="Instructions"><?php echo $recipeData[0]->instructions; ?></div>
</div>