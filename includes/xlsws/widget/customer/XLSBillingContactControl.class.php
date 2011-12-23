<?php

class XLSBillingContactControl extends ContactControl { 

    protected $strFieldMapping = array(
        'cart' => array(
            'FirstName' => 'Firstname',
            'LastName' => 'Lastname',
            'Company' => 'Company', 
            'Phone' => 'Phone',
            'Email' => 'Email'
        ),  
        'customer' => array(
            'FirstName' => 'Firstname',
            'LastName' => 'Lastname',
            'Company' => 'Company', 
            'Phone' => 'Phone1',
            'Email' => 'Email'
        )   
    ); 

    protected function UpdateFirstNameControl() {
        return $this->UpdateControlFromEnvironment('FirstName');
    }

    protected function UpdateLastNameControl() {
        return $this->UpdateControlFromEnvironment('LastName');
    }

    protected function UpdateCompanyControl() {
        return $this->UpdateControlFromEnvironment('Company');
    }

    protected function UpdatePhoneControl() {
        return $this->UpdateControlFromEnvironment('Phone');
    }

    protected function UpdateEmailControl() {
        return $this->UpdateControlFromEnvironment('Email');
    }

}

