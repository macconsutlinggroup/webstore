<?php

class XLSBillingAddressControl extends AddressControl { 
    protected $strFieldMapping = array(
        'cart' => array(
            'Street1' => null,
            'Street2' => null,
            'City' => null,
            'State' => null,
            'Country' => null,
            'Zip' => 'Zipcode',
        ),  
        'customer' => array(
            'Street1' => 'Address11',
            'Street2' => 'Address12',
            'City' => 'City1',
            'State' => 'State1',
            'Country' => 'Country1',
            'Zip' => 'Zip1',
        )   
    );  

    protected function UpdateStreet1Control() {
        return $this->UpdateControlFromEnvironment('Street1');
    }   

    protected function UpdateStreet2Control() {
        return $this->UpdateControlFromEnvironment('Street2');
    }   

    protected function UpdateCityControl() {
        return $this->UpdateControlFromEnvironment('City');
    }   

    protected function UpdateCountryControl() {
        $objControl = parent::UpdateCountryControl();
        return $this->UpdateControlFromEnvironment('Country');
    }

    protected function UpdateStateControl() {
        $objControl = parent::UpdateStateControl();
        return $this->UpdateControlFromEnvironment('State');
    }

    protected function UpdateZipControl() {
        return $this->UpdateControlFromEnvironment('Zip');
    }

}

