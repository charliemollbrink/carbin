<?php
if(isset($_GET['query'], $_GET['type']) && $_GET['query'] !="" && $_GET['type'] !=""){
    require_once('classes/Search.class.php');
    require_once('classes/Spotify.class.php');
    require_once('classes/lastFM.class.php');
    $query = $_GET['query'];
    $type = $_GET['type'];

    $search = new Search($query, $type);
    $recId = $search->getRecId();

    function getContentFromUrl($url){
        $json = file_get_contents($url);
        return json_decode($json);
    }

    if($recId){
        // echo "<pre>";
        // print_r($_SERVER);
        // echo "</pre>";
        $recipeData = getContentFromUrl("http://localhost/carbin/resources/?recipes/$recId");
        $ingredientsData = getContentFromUrl("http://localhost/carbin/resources/?recipes/$recId/ingredients");
        $tagsData = getContentFromUrl("http://localhost/carbin/resources/?recipes/$recId/tags");
        $numIng = count($ingredientsData);
        $numTags = count($tagsData);

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
                        <span class="amount"><?php echo $ingredientsData[$i]->amount; ?></span>
                    <?php } ?>
                    <span class="unit"><?php echo $ingredientsData[$i]->unit; ?></span>
                    <span class="ingredient"><?php echo $ingredientsData[$i]->ingredient; ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
    <div id="descriptions"><?php echo $recipeData[0]->description; ?></div>
    <div id="instructions"><?php echo $recipeData[0]->instructions; ?></div>
    <div id="tagsContainer">

        <?php if($numTags > 0){ ?>
            <div id="currentTags">
                <h3>Taggar</h3>
                <dl>
                    <?php for($i = 0; $i < $numTags; $i++){ ?>
                        <dt><?php echo $tagsData[$i]->tag; ?></dt>
                        <dt><?php echo $tagsData[$i]->percent; ?>%</dt>

                    <?php } ?>
                </dl>
            </div>
        <?php } ?>

        <h2>Tagga recept</h2>
        <form id="addTags" method="post" action="">
            <label for="tags">Taggar</label>
            <input type="text" name="tags" id="tags" />
            <input type="hidden" name="recipeid" id="recipeid" value="<?php echo $recipeData[0]->id; ?>"/>
            <button type="submit">Lägg till</button>
        </form>
    </div>
</div>