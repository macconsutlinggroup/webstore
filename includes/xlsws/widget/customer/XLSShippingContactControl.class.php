<?php

class XLSShippingContactControl extends ContactControl { 

    protected $strFieldMapping = array(
        'cart' => array(
            'FirstName' => 'ShipFirstname',
            'LastName' => 'ShipLastname',
            'Company' => 'ShipCompany',
            'Phone' => 'ShipPhone'
        ),
        'customer' => array(
            'FirstName' => null,
            'LastName' => null,
            'Company' => null,
            'Phone' => null
        )
    );

    protected function UpdateFirstNameControl() {
        return $this->UpdateControlFromEnvironment('FirstName');
    }   

    protected function UpdateLastNameControl() {
        return $this->UpdateControlFromEnvironment('Name');
    }   

    protected function UpdateCompanyControl() {
        return $this->UpdateControlFromEnvironment('Company');
    }   

    protected function UpdatePhoneControl() {
        return $this->UpdateControlFromEnvironment('Phone');
    }   

    protected function UpdateControl() {
        parent::UpdateControl();
        $this->UnregisterChild('Email');
    }

}

