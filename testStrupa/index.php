<?php
spl_autoload_register(function($className){
    require_once __DIR__ . "/includes/" . $className . ".php";
});

use Strup\WordGame;

$wG = new WordGame(5, 5);
$wGResult = $wG->getMatrix();
?>

<?php
if(!empty($wGResult)):
?>

    <div class="box-colors">
        <?php foreach($wGResult as $row): ?>
            <div class="box-colors__row">
            <?php foreach($row as $name => $code): ?>
                <div class="box-colors__item" style="color: <?=$code?>; width: calc(100% / <?=$wG->getWidth()?>)">
                    <?=$name?>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

<?php
endif;
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap');
.box-colors {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.box-colors__row {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-evenly;
}

.box-colors__item {
    font-family: 'Roboto', sans-serif;
    padding: 10px 0;
    font-size: 24px;
    text-transform: uppercase;
    font-weight: bold;
    text-align: center;
}
</style>