<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/FaqData.class.php';
require_once '../models/FAQ.class.php';

class FAQService {

    private $faqs;

    /**
     * FAQService constructor.
     * @param $faqs
     */
    public function __construct()
    {
        $this->faqs = $this->getAllFAQs();
    }

    // CREATE

    // READ
    public function getAllFAQs(){
        $faqData = new FAQData();
        $faqsData = $faqData->getAllFAQs();
        $allFAQs = array();

        foreach($faqsData as $faq){
            $newFaq = new FAQ(
                    $faq['idFAQ'],
                    $faq['question'],
                    $faq['answer']
            );

            array_push($allFAQs, $newFaq);
        };

        return $allFAQs;
    }

    // UPDATE

    // DELETE


}

?>