<?php

include '../components/Main.class.php';
include '../services/FAQService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<!--<div class="parallax-container">-->
<!--    <div class="parallax"><img src="https://i.imgur.com/rG4MHt1.jpg"></div>-->
<!--</div>-->

<div class="section cust-color-seafoam lighten-3">
    <div class="row">
        <h3 class="header center-align white-text">Frequently Asked Questions</h3>
    </div>

</div>

<div class="section cust-color-slate">
    <div class="row container">
        <div class="col s12 center">
            <ul class="collapsible" data-collapsible="accordion">

                <?php
                $faqService = new FAQService();
                $data = $faqService->getAllFAQs();

                foreach ($data as $faq){
                    echo '<li>
                            <div class="collapsible-header"><i class="material-icons">arrow_drop_down</i>'.$faq->getQuestion().'</div>
                            <div class="collapsible-body cust-color-white"><span>'.$faq->getAnswer().'</span></div>
                          </li>';
                }


                ?>

            </ul>

        </div>
    </div>

</div>


<!--<a href="https://codyhouse.co/demo/faq-template/index.html">Sample Collapsible FAQ</a>-->

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

