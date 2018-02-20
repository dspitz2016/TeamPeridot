<?php

include '../components/Main.class.php';
include '../data/ScavengerHuntData.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<h1>Scavenger Hunt Page</h1>

<?php

    $shData = new ScavengerHuntData();

    $data = $shData->getScavengerHuntData();
    var_dump($data);
?>

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

