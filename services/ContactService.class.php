<?php

require_once '../data/ContactData.class.php';
require_once '../models/Contact.class.php';

class ContactService {

    private $contactData;

    /**
     * ContactService constructor.
     */
    public function __construct(){
        $this->contactData = new ContactData();
    }


    public function readAllContacts(){
        $data = $this->contactData->readAllContacts();

        $allContacts = array();

        foreach ($data as $contact) {
            $newContact = new Contact(
                $contact['idContact'],
                $contact['firstName'],
                $contact['lastName'],
                $contact['email'],
                $contact['title'],
                $contact['description'],
                $contact['idLocation']
            );

            array_push($allContacts, $newContact);
        };

        return $allContacts;
    }

    public function getContactById($idContact){
        $idContact = filter_var($idContact, FILTER_SANITIZE_NUMBER_INT);
        $obj = $this->contactData->getContactById($idContact);
        $singleContact = new Contact(
            $obj[0]['idContact'],
            $obj[0]['firstName'],
            $obj[0]['lastName'],
            $obj[0]['email'],
            $obj[0]['title'],
            $obj[0]['description'],
            $obj[0]['idLocation']
        );

        return $singleContact;
    }


    /**
     * Return HTML Contact Cards
     */
    public function getAllContactCards(){
        $data = $this->readAllContacts();
        $contactCollection = '<div class="row"><div class="col s12"><h2>Contact Us</h2></div><div class="row">';

        foreach ($data as $contact){
            $contactCollection .= '
					  <div class="col s4">
						  <div class="card">
							<div class="center-align waves-effect waves-block waves-light cust-color-rust">
							  <h4 class="activator white-text">'. $contact->getFirstName() .' '. $contact->getLastName(). '</h4>
							</div>
							<div class="card-content">
							  <span class="card-title activator grey-text text-darken-4"><strong>Title: </strong>'.$contact->getTitle().'</span>
							</div>
							<div class="card-reveal">
							  <span class="card-title grey-text text-darken-4"><strong>About Me</strong></span>
							  <span class="card-content grey-text text-darken-4">'.$contact->getDescription().'</span>
							  
							  <span class="card-title grey-text text-darken-4"><strong>Contact</strong></span>
							  <span class="card-content grey-text text-darken-4">'.$contact->getEmail().'</span>
							</div>
						  </div>
					  </div>';
        }

        $contactCollection .= "</div></div>";

        return $contactCollection;
    }

    public function createContact($firstName, $lastname, $email, $title, $description, $idLocation){
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->contactData->createContact($firstName, $lastname, $email, $title, $description, $idLocation);
    }

    public function updateContact($idContact, $firstName, $lastname, $email, $title, $description, $idLocation){
        $idContact = filter_var($idContact, FILTER_SANITIZE_NUMBER_INT);
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->contactData->updateContact($idContact, $firstName, $lastname, $email, $title, $description, $idLocation);

    }

    public function deleteContact($idContact){
        $idContact = filter_var($idContact, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idContact, "Contact");
    }

    public function readContactTable(){
        $data = $this->readAllContacts();

        $table = "<script>
                        var contact = 'Contact';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>Contacts</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, contact, -1)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getFirstName()." ".$obj->getLastName()."</td>
                        <td>".$obj->getEmail()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, contact, ".$obj->getIdContact().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, contact, ".$obj->getIdContact().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table>";

        return $table;
    }

    public function createContactForm(){
        return '
                        <div class="row"><div class="col s12"><h5>Create Contact</h5></div></div>

                        <div class="row">
                            <div class="input-field col s6">
                                <label for="firstName">First name</label><br/>
                                <input id="firstName" name="firstName" type="text" class="validate" required="" aria-required="true">
                            </div>
                            <div class="input-field col s6">
                                <label for="lastName">lastName</label><br/>
                                <input id="lastName" name="lastName" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="title">Title</label><br/>
                                <input id="title" name="title" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="email">Email</label><br/>
                                <input id="email" name="email" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        '
            ;
    }

    public function updateContactForm($idContact){
        $singleContact = $this->getContactById($idContact);
        return '
                        <div class="row"><div class="col s12"><h5>Update Contact</h5></div></div>

                        <div class="row">
                            <div class="input-field col s6">
                                <label for="firstName">First name</label><br/>
                                <input id="firstName" name="firstName" type="text" class="validate" required="" aria-required="true" value="'.$singleContact->getFirstName().'">
                            </div>
                            <div class="input-field col s6">
                                <label for="lastName">lastName</label><br/>
                                <input id="lastName" name="lastName" type="text" class="validate" required="" aria-required="true" value="'.$singleContact->getLastname().'">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="title">Title</label><br/>
                                <input id="title" name="title" type="text" class="validate" required="" aria-required="true" value="'.$singleContact->getTitle().'">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="email">Email</label><br/>
                                <input id="email" name="email" type="text" class="validate" required="" aria-required="true" value="'.$singleContact->getEmail().'">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label><br/>
                                <textarea id="description" name="description" class="materialize-textarea">'.$singleContact->getDescription().'</textarea>
                            </div>
                        </div>
                        
                        <div class="row" style="display:none;">
                           <div class="input-field col s12">
                                <input id="idContact" name="idContact" type="text" class="validate" required="" aria-required="true" value="'.$singleContact->getIdContact().'">
                            </div>
                        </div>
                        
                        '
            ;
    }
}

?>