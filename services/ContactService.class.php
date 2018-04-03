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
                $contact['imagePath'],
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
            $obj[0]['imagePath'],
            $obj[0]['idLocation']
        );

        return $singleContact;
    }


    /**
     * Return HTML Contact Cards
     */
    public function getAllContactCards(){
        $data = $this->readAllContacts();
        $contactCollection = '
                             
                              <div class="row cust-color-seafoam">
                                <div class="col s12 center">
                                    <h4 class="center-align white-text">Contacts</h4>
                                    <p class="white-text">Members of 19WCA who can answer your Rapids Cemetery Questions!</p>
                                </div>
                              </div>
                              <div class="row cust-color-slate">

                              
                              ';




        foreach ($data as $contact){
            $contactCollection .= '

                        <div class="col s12 m6 lg6">
                            <div class="card">
                                <div class="card-panel contact-panel cust-color-rust center-align">
                                    <img class="responsive-img circle" style="height:10em;" src="'.$contact->getImagePath().'">
                                    <h5 class="center white-text">'.$contact->getFirstName().' '.$contact->getLastName().'</h5>
                                    <h5 class="center white-text">'.$contact->getTitle().'</h5>
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <h5>About</h5>
                                        <p>'.$contact->getDescription().'</p>
                                        <br/>';

            if($contact->getEmail() != ""){
                $contactCollection .= '     <h5>Contact</h5>
                                        <p><i class="material-icons">email</i> '.$contact->getEmail().'</p>';
            }

            $contactCollection .=                       '</div>
                                                    </div>
                                                </div>
                                            </div>
                                    ';
        }

        $contactCollection .= "</div>";

        return $contactCollection;
    }

    public function createContact($firstName, $lastname, $email, $title, $description, $imagePath, $idLocation){
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);


        $this->contactData->createContact($firstName, $lastname, $email, $title, $description, $imagePath, $idLocation);
    }

    public function updateContact($idContact, $firstName, $lastname, $email, $title, $description, $imagePath, $idLocation){
        $idContact = filter_var($idContact, FILTER_SANITIZE_NUMBER_INT);
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->contactData->updateContact($idContact, $firstName, $lastname, $email, $title, $description, $imagePath, $idLocation);

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
                    <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Contact</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, contact, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

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

        $table .= "</tbody></table></div></div>";

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
                                <label for="imagePath">Profile Image Path</label><br/>
                                <input id="imagePath" name="imagePath" type="text" class="validate" required="" aria-required="true">
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
                                <label for="imagePath">Profile Image Path</label><br/>
                                <input id="imagePath" name="imagePath" type="text" class="validate" required="" aria-required="true" value="'.$singleContact->getImagePath().'">
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