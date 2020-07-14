<?php
class ContactsManager extends Database{

    //properties
    private $db;
    public function __construct(){
        $this->db = $this->setDbConnection();
    }

    public function saveContact($contact){
        $query = $this->db->query('SELECT * FROM contacts WHERE contact_name = ' . $contact->name());
        if(!$query->execute()){
            $sql = 'INSERT INTO contacts(contact_name, contact_phoneNumber, contact_email, contact_consent) VALUES(:name, :phoneNumber, :email, :consent)';
            $query = $this->db->prepare($sql);
            $query->bindValue(':name', $contact->name(), PDO::PARAM_STR);
            $query->bindValue(':phoneNumber', $contact->phoneNumber(), PDO::PARAM_STR);
            $query->bindValue(':email', $contact->email(), PDO::PARAM_STR);
            $query->bindValue(':consent', $contact->consent(), PDO::PARAM_STR);
            $query->execute();
        }
    }

    public function goGetContacts(){
        $contacts = [];
        $sql = 'SELECT * FROM contacts';
        $query = $this->db->query($sql);
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $contacts[] = new Article($data['contact_id'], $data['contact_name'], $data['contact_phoneNumber'], $data['contact_email'], $data['contact_lconsent'], $data['contact_url']);
        }
        return $contacts;
    }

    public function sendContactUpdate($contact){
        $sql = 'UPDATE contacts SET contact_name = :name, contact_phoneNumber = :phoneNumber, contact_email = :email, contact_lconsent = :consent, contact_url = :url WHERE contact_id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':name', $contact->name(), PDO::PARAM_STR);
        $query->bindValue(':phoneNumber', $contact->phoneNumber(), PDO::PARAM_STR);
        $query->bindValue(':email', $contact->email(), PDO::PARAM_STR);
        $query->bindValue(':consent', $contact->consent(), PDO::PARAM_STR);
        $query->bindValue(':url', $contact->url(), PDO::PARAM_STR);
        $query->bindValue(':id', $contact->id(), PDO::PARAM_INT);
        $query->execute();
    }

    public function sendContactDeletion($id){
        $query = $this->db->exec('DELETE FROM contacts WHERE contact_id = ' . $id);
    }

}
