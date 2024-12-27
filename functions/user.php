





<?php


class user{

    private $FName;
    private $LName;
    private $adresse;
    private $phone;
    private $email;
    private $password;

    public function __construct($FName,$LName,$adresse,$phone,$email,$password)
    {
        $this->FName = $FName;
        $this->LName = $LName;
        $this->adresse = $adresse;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
    }
}




?>