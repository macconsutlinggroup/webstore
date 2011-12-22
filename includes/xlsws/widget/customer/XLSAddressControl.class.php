<?php

class XLSAddressControl extends XLSCustomerCompositeControl {
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

    protected function BuildStreet1Control() {
        $objControl = new XLSTextBox($this, $this->GetChildName('Street1'));
        $objControl->Name = _sp('Address');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 255);
    }

    protected function UpdateStreet1Control() {
        return $this->UpdateControlFromEnvironment('Street1');
    }

    protected function BindStreet1Control() {
    }

    protected function BuildStreet2Control() {
        $objControl = new XLSTextBox($this, $this->GetChildName('Street2'));
        $objControl->SetCustomAttribute('maxlength', 255);
    }

    protected function UpdateStreet2Control() {
        return $this->UpdateControlFromEnvironment('Street2');
    }

    protected function BindStreet2Control() {
    }

    protected function BuildCityControl() {
        $objControl = new XLSTextBox($this, $this->GetChildName('City'));
        $objControl->Name = _sp('City');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 64);
    }

    protected function UpdateCityControl() {
        return $this->UpdateControlFromEnvironment('City');
    }

    protected function BindCityControl() {
    }

    protected function BuildCountryControl() {
        $objControl = new XLSListBox($this, $this->GetChildName('Country'));
        $objControl->Name = _sp('Country');
        $objControl->Required = true;
    }

    protected function UpdateCountryControl() {
        $objControl = $this->GetChildByName('Country');

        if (!$objControl)
            return;

        $objControl->RemoveAllItems();
        $objControl->AddItem(_sp('-- Select One --'), null);

        $objCountries = Country::LoadArrayByAvail(
            'Y',
            QQ::Clause(
                QQ::OrderBy(
                    QQN::Country()->SortOrder, 
                    QQN::Country()->Country
                )
            )
        );

        if ($objCountries)
            foreach ($objCountries as $objCountry)
                $objControl->AddItem($objCountry->Country, $objCountry->Code);

        return $objControl;
    }

    protected function BindCountryControl() {
        $objControl = $this->GetChildByName('Country');

        if (!$objControl)
            return;

        $objControl->AddAction(
            new QChangeEvent(), 
            new QAjaxAction($this,'DoCountryControlChange')
        );
    }

    protected function DoCountryControlChange($strFormId, $strControlId, 
        $strParameter) 
    {
        $this->UpdateStateControl();
    }

    protected function BuildStateControl() {
        $objControl = new XLSListBox($this, $this->GetChildName('State'));
        $objControl->Name = _sp('State');
        $objControl->Required = true;
    }

    protected function UpdateStateControl() {
        $objControl = $this->GetChildByName('State');
        $objCountryControl = $this->GetChildByName('Country');

        $objControl->RemoveAllItems();
        $objControl->AddItem(_sp('-- Select One --'), null);

        if (!$objControl || !$objCountryControl || 
            is_null($objCountryControl->SelectedValue))
            return;

        $objStates = State::LoadArrayByCountryCode(
            $objCountryControl->SelectedValue,
            QQ::Clause(
                QQ::OrderBy(
                    QQN::State()->SortOrder, 
                    QQN::State()->State
                )
            )
        );

        if ($objStates)
            foreach ($objStates as $objState)
                $objControl->AddItem($objState->State, $objState->Code);
        }

        return $objControl;
    }

    protected function BindStateControl() {
    }

    protected function BuildZipControl() {
        $objControl = new XLSTextBox($this, $this->GetChildName('Zip'));
        $objControl->Name = _sp('Zip/Postal Code');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 16);
    }

    protected function UpdateZipControl() {
        return $this->UpdateControlFromEnvironment('Zip');
    }

    protected function BindZipControl() {
    }

    protected function UpdateControl() {
        parent::UpdateControl();
        $this->RegisterChild('Street1');
        $this->RegisterChild('Street2');
        $this->RegisterChild('City');
        $this->RegisterChild('Country');
        $this->RegisterChild('State');
        $this->RegisterChild('Zip');
    }


}

