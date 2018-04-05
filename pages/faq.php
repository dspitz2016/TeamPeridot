<?php

include '../components/Main.class.php';
include '../services/FAQService.class.php';

$main = Main::getInstance();
$main->getHeader();
$main->getNavigationBar();

$faqService = new FAQService();

?>

<!--<div class="parallax-container">-->
<!--    <div class="parallax"><img src="https://i.imgur.com/rG4MHt1.jpg"></div>-->
<!--</div>-->


<div class="section cust-color-seafoam lighten-3">
    <div class="row">
        <h3 class="header center-align white-text">Frequently Asked Questions</h3>
    </div>

</div>

    <div class="row container">
        <div class="col s12 center">
            <ul class="collapsible" data-collapsible="accordion">

                <?php
                    echo $faqService->getCollapsibleFAQs();
                ?>

            </ul>

        </div>
    </div>


<!--<a href="https://codyhouse.co/demo/faq-template/index.html">Sample Collapsible FAQ</a>-->

<?php $main->getScripts(); ?>
<?php //$main->getFooter(); ?>

