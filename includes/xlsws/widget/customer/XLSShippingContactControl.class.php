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

    protected function UpdateControl() {
        parent::UpdateControl();
        $this->UnregisterChild('Email');
    }

}

