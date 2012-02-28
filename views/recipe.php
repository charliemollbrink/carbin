<?php
if(isset($_GET['query'], $_GET['type']) && $_GET['query'] !="" && $_GET['type'] !=""){
    require_once('classes/Search.class.php');
    require_once('classes/Spotify.class.php');
    require_once('classes/lastFM.class.php');
    $query = $_GET['query'];
    $type = $_GET['type'];

    $search = new Search($query, $type);
    $recId = $search->getRecId();


    $lastfm = new LastFM($query);
    $lastfm->getTagList();

    // echo '<pre>';
    // print_r($lastfm);
    // echo '</pre>';


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
                <li>
                    <?php if($ingredientsData[$i]->amount !== 0){ ?>
<<<<<<< HEAD
                        <span class="amount"><?php echo $ingredientsData[$i]->amount; ?>
=======
                        <span class="amount"><?php echo $ingredientsData[$i]->amount; ?></span>
>>>>>>> dfc56bd1c538276d587ac749eeb9af98e22bb824
                    <?php } ?>
                    <span class="unit"><?php echo $ingredientsData[$i]->unit; ?></span>
                    <span class="ingredient"><?php echo $ingredientsData[$i]->ingredient; ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
    <div id="descriptions"><?php echo $recipeData[0]->description; ?></div>
    <div id="Instructions"><?php echo $recipeData[0]->instructions; ?></div>
    <div>
        <h2>Tagga recept</h2>
        <form id="addTags" method="post" action="">
            <label for="tags">Taggar</label>
            <input type="text" name="tags" id="tags" />
            <input type="hidden" name="recipeid" id="recipeid" value="<?php echo $recipeData[0]->id; ?>"/>
            <button type="submit">Lägg till</button>
        </form>
    </div>
</div>