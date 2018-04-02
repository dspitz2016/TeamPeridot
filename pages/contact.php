<?php

require_once '../components/Main.class.php';
require_once '../services/ContactService.class.php';

$main = Main::getInstance();
$main->getHeader();
$main->getNavigationBar();

$contactService = new ContactService();

echo $contactService->getAllContactCards();

?>

<?php $main->getScripts(); ?>
<?php //$main->getFooter(); ?>

