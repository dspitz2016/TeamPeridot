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

    private $faqData;

    /**
     * FAQService constructor.
     * @param $faqData
     */
    public function __construct()
    {
        $this->faqData = new FAQData();
    }


    // CREATE
    public function createFAQ($question, $answer, $idLocation){
        $question = filter_var($question, FILTER_SANITIZE_STRING);
        $answer = filter_var($answer, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->faqData->createFAQ($question, $answer, $idLocation);
    }

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
                    $faq['answer'],
                    $faq['idLocation']
            );

            array_push($allFAQs, $newFaq);
        };

        return $allFAQs;
    }

    // UPDATE
    public function updateFAQ($idFAQ, $question, $answer, $idLocation){
        $idFAQ = filter_var($idFAQ, FILTER_SANITIZE_NUMBER_INT);
        $question = filter_var($question, FILTER_SANITIZE_STRING);
        $answer = filter_var($answer, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->faqData->updateFAQ($idFAQ, $question, $answer, $idLocation);
    }

    // DELETE
    public function deleteFAQ($idFAQ){
        $idFAQ = filter_var($idFAQ, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idFAQ, "FAQ");
        //$this->faqData->deleteFAQ($idFAQ);
    }


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

    public function readFAQTable(){
        $data = $this->getAllFAQs();

        $table = "<script>
                        var faq = 'FAQs';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>FAQ</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, faq, -1)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getQuestion()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, grave, ".$obj->getIdFaq().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, grave, ".$obj->getIdFaq().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table>";

        return $table;
    }
}

?>