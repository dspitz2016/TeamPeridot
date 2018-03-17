<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/FaqData.class.php';
require_once '../models/FAQ.class.php';


/**
 * Class EventService
 * Author: Dustin Spitz
 * Purpose: Calls the FaqData class to retrieve an associative array and formats this into php objects using the provided model
 */
class FAQService {

    private static $instance = null;

    /**
     * @return ConnectDb|null
     * Get Instance establishes a singleton design pattern
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new FAQService();
        }
        return self::$instance;
    }

    // CREATE

    /**
     * @return array - Retuns array of FAQ Objects
     */
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

    /**
     * HTML Components
     */

    public function getCollapsibleFAQs(){
        $data = $this->getAllFAQs();
        $faqCollection = '';

        foreach ($data as $faq){
            $faqCollection .= '<li>
                    <div class="collapsible-header"><i class="material-icons">arrow_drop_down</i>'.$faq->getQuestion().'</div>
                    <div class="collapsible-body cust-color-white"><span>'.$faq->getAnswer().'</span></div>
                  </li>';
        }


        return $faqCollection;

    }
}

?>