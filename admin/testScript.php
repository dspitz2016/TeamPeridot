<?php
ob_start();
session_start();

require_once '../components/Main.class.php';
require_once '../services/LocationService.class.php';
require_once '../services/GraveService.class.php';
require_once '../services/FloraService.class.php';
require_once '../services/NaturalHistoryService.class.php';
require_once '../services/EventService.class.php';
require_once '../services/FAQService.class.php';
require_once '../services/HistoricFilterService.class.php';
require_once '../services/TypeFilterService.class.php';
require_once '../services/ContactService.class.php';

$main = Main::getInstance();
$main->getAdminHeader();


if(!isset($_SESSION['email'])){
    header('Location: index.php');
}

$main->getAdminSideBar();

$locationService = new LocationService();
$graveService = new GraveService();
$floraService = new FloraService();
$naturalHistoryService = new NaturalHistoryService();
$eventService = new EventService();
$faqService = new FAQService();
$historicFilterService = new HistoricFilterService();
$typeFilterService = new TypeFilterService();
$contactService = new ContactService();

//$graveService->createGrave("John", "T.", "Smith", "1922-04-14", "2000-02-12", "He was one of the last members of a family to pass who still live in this cemetery", null, -77.6393805107, 43.12957151812343, "", "http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids011.jpg", "description", 1, 1);
//$graveService->createGrave("Jim", "H.", "Jones", "1922-04-14", "2000-02-12", "A good member", 1, -77.6393767185715, 43.12951547592116, "", "http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids019.jpg", "description", 1, 1);
//$graveService->createGrave("Abby", "N.", "Smithy", "1922-04-14", "2000-02-12", "Loved living in Rochester", 1, -77.63930496948035, 43.12947810348198, "", "http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids035.jpg", "description", 1, 1);
//$graveService->createGrave("Gloria", "R.", "Leblanc", "1922-04-14", "2000-02-12", "A medical nurse.", 2, -77.63900255041392, 43.12953347005038, "", "http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids008.jpg", "description", 1, 1);
//$graveService->createGrave("Arnold", "L.", "Sholtz", "1922-04-14", "2000-02-12", "In the airforce units.", 3, -77.63897908108504, 43.129482255976356, "", "http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids012.jpg", "description", 1, 1);



//$graveService->createGrave("Dustin", "Tyler", "Spitz", "1994-06-27", "2018-03-17", "I Tried...", 4, -77.639091, 43.129458, "You might find him", "", "", 1,1);
//$graveService->createGrave("John", "J.", "Smith", "1974-06-27", "2018-03-17", "Do words like this work? I don't know hmm.", "", -77.63913, 43.12935, "You might find him here ' 's", "test", "tester", 1,1);
//$graveService->updateGrave(6, "Jimmy", "B.", "Smithy", "1999-06-27", "2000-03-17", "abc", "", 14, -77.63913, 43.12935, "You who what me", "tester", "testertester", 1,1);
//$graveService->deleteGrave(6);

//$floraService->createFlora("Blackberries", "Scientific Blackberries", "ubus occidentalis is a species of Rubus native to eastern North America. Its common name black raspberry is shared with th", -77.63947327809603, 43.129681575374526, "", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzBCfbxFlK2hTdo4upIYcfTf2moDMqiRRF-GlBnGhywU-dS87c", "image descriptions", 1, 2);
//$floraService->createFlora("Forget me Knots", "Scientific forget me not", "Myosotis is a genus of flowering plants in the family Boraginaceae. In the northern hemisphere they are co", -77.63971068204478, 43.12948364014106, "", "https://i.ytimg.com/vi/bPeh07foWAA/hqdefault.jpg", "image descriptions", 1, 2);


//$floraService->updateFlora(6,"Forget me Knots", "Nepenthes truncata", "Myosotis is a genus of flowering plants in the family Boraginaceae. In the northern hemisphere they are commonly called forget-me-nots or scorpion grasses", 15, -77.63971068204478, 43.12948364014106, "https://i.ytimg.com/vi/bPeh07foWAA/hqdefault.jpg", "/image/pathasdf", "image descriptionssdf", 1, 2);
//$floraService->deleteFlora(6);

//$naturalHistoryService->createNaturalHistory("Beehive", "Full of bees.", -77.63917375561493, 43.12963499162369, "", "https://d3i6fh83elv35t.cloudfront.net/newshour/app/uploads/2015/11/RTXZ3DT-e1487891078282-1024x629.jpg", "images descripty", 1, 3);
//$naturalHistoryService->createNaturalHistory("Amphitheater", "An amphitheatre or amphitheater is an open-air venue used for entertainment, performances, and sports. The term derives from the ancient Greek", -77.63893638011712, 43.12968343724953, "", "https://upload.wikimedia.org/wikipedia/commons/6/67/Kalmanovitz_Hall_amphitheater.jpg", "images descripty", 1, 4);


//$naturalHistoryService->updateNaturalHistory(4, "Bryan's Rock", "Why did he do this?", 16, -77.639181, 43.129368, "A good rock", "/image/path", "description of image", 1, 4);
//$naturalHistoryService->deleteNaturalHistory(4);

//$eventService->createEvent("Grave Tour", "An amazing tour of all the graves here at Rapids.", "2018-06-13 12:00:00", "2018-06-13 13:00:00", "imagePath", "imageDescription", 1);
//$eventService->updateEvent(5, "Grave touring amazing", "AHHHH.", "2018-07-13 12:00:00", "2018-07-13 13:00:00", "imagePath2", "imageDescription2", 1)
//$eventService->deleteEvent(8);

//$faqService->createFAQ("How are you?", "I'm not sure.", 1);
//$faqService->updateFAQ(5, "How are you feeling today?", "meh...", 1);
//$faqService->deleteFAQ(5);

//$locationService->createLocation("A new hiding spot", "the best place to hide", "url/path/to/image", -77.635576, 43.129375, "abc 123 drive","amazing", "NY", "11111", "image/path","image description", "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000", 7);
//$locationService->updateLocation(7,"Spongebob's Pineapple", "Where's patrick?", "url/path/to", -77.640953, 43.129256, "abc 123 ","who", "NJ", "222222", "image/pathrer","image descriptionasdf", "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000", 7);
//$locationService->deleteLocation(7);

//$historicFilterService->createHistoricFilter("Amazing #2", "ffec89");
//$historicFilterService->updateHistoricFilter(7, "oh no", "000000");
//$historicFilterService->deleteHistoricFilter(7);

//$typeFilterService->createTypeFilter("Tinashe",  "good bops", "http://www.pngall.com/map-marker-png", "FF0000");
//$typeFilterService->updateAllTypeFilter(6, "Britney", "bops", "/image/", "FFFFF");
//$typeFilterService->deleteTypeFilter(6);
?>
