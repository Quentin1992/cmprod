<?php

class ContactsController extends ContactsManager{

    public function sendEmail($name, $phoneNumber, $email, $message, $consent){
        $name = htmlspecialchars($name);
        $phoneNumber = htmlspecialchars($phoneNumber);
        $mailFrom = htmlspecialchars($email);
        $message = htmlspecialchars($message);
        $mailTo = "contact@chaudmiretteprod.com";
        $headers = "From: ".$mailFrom;
        $subject = "Prise de contact ".$name;
        mail($mailTo, $subject, $message, $headers);

        $contact = new Contact(null, $name, $phoneNumber, $email, $consent);
        $this->saveContact($contact);
    }

    public function addContact($name, $phoneNumber, $email, $message, $consent){
        $contact = new Contact(null, $name, $phoneNumber, $email, $message, $consent);
        $this->sendArticle($contact);
    }

    public function getContacts(){
        $contacts = $this->goGetContacts();
        $contactsData = [];
        foreach ($contacts as $contact) {
            $contactsData[] = $contactData = array(
                'id' => $contact->id(),
                'name' => $contact->name(),
                'phoneNumber' => $contact->phoneNumber(),
                'email' => $contact->email(),
                'message' => $contact->message(),
                'consent' => $contact->consent()
            );
        }
        return json_encode($contactsData);
    }

    public function updateContact($id, $name, $phoneNumber, $email, $message, $consent){
        $contact = new Contact(null, $name, $phoneNumber, $email, $message, $consent);
        $this->sendContactUpdate($contact);
    }

    public function deleteContact($id){
        $this->sendContactDeletion($id);
    }

}
