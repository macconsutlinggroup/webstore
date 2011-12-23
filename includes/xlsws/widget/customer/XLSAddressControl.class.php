<?php

abstract class XLSAddressControl extends XLSCustomerCompositeControl {
    protected $strFieldMapping;

    protected function BuildStreet1Control() {
        $objControl = new XLSTextControl($this, $this->GetChildName('Street1'));
        $objControl->Name = _sp('Address');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 255);

        return $objControl;
    }

    protected function UpdateStreet1Control() {
    }

    protected function BindStreet1Control() {
    }

    protected function BuildStreet2Control() {
        $objControl = new XLSTextControl($this, $this->GetChildName('Street2'));
        $objControl->SetCustomAttribute('maxlength', 255);

        return $objControl;
    }

    protected function UpdateStreet2Control() {
    }

    protected function BindStreet2Control() {
    }

    protected function BuildCityControl() {
        $objControl = new XLSTextControl($this, $this->GetChildName('City'));
        $objControl->Name = _sp('City');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 64);

        return $objControl;
    }

    protected function UpdateCityControl() {
    }

    protected function BindCityControl() {
    }

    protected function BuildCountryControl() {
        $objControl = new XLSListBox($this, $this->GetChildName('Country'));
        $objControl->Name = _sp('Country');
        $objControl->Required = true;

        return $objControl;
    }

    protected function UpdateCountryControl() {
        $objControl = $this->GetChild('Country');

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
        $objControl = $this->GetChild('Country');

        if (!$objControl)
            return;

        $objControl->AddAction(
            new QChangeEvent(), 
            new QAjaxControlAction($this,'DoCountryControlChange')
        );
    }

    public function DoCountryControlChange($strFormId, $strControlId, 
        $strParameter) 
    {
        $this->UpdateStateControl();
        $this->Validate();
    }

    protected function BuildStateControl() {
        $objControl = new XLSListBox($this, $this->GetChildName('State'));
        $objControl->Name = _sp('State');
        $objControl->Required = true;

        return $objControl;
    }

    protected function UpdateStateControl() {
        $objControl = $this->GetChild('State');
        $objCountryControl = $this->GetChild('Country');

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

        if ($objStates) {
            foreach ($objStates as $objState)
                $objControl->AddItem($objState->State, $objState->Code);
        }

        return $objControl;
    }

    protected function BindStateControl() {
    }

    protected function BuildZipControl() {
        $objControl = new XLSZipFieldControl($this, $this->GetChildName('Zip'));
        $objControl->Name = _sp('Zip/Postal Code');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 16);

        return $objControl;
    }

    protected function UpdateZipControl() {
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

