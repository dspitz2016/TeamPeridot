<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<h1>FAQ Page</h1>
Questions and answers

<ul class="collapsible" data-collapsible="accordion">
    <li>
        <div class="collapsible-header cust-color-slate"><i class="material-icons">arrow_drop_down</i>To be or not to be?</div>
        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li>
        <div class="collapsible-header cust-color-mint"><i class="material-icons">arrow_drop_down</i>What are latin words?</div>
        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
</ul>

<hr>

<a href="https://codyhouse.co/demo/faq-template/index.html">Sample Collapsible FAQ</a>

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

