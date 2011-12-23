<?php

abstract class XLSContactControl extends XLSCustomerCompositeControl {
    # FirstName
    # LastName
    # Company
    # Phone
    # Email

    protected $strFieldMapping;

    protected function BuildFirstNameControl() {
        $objControl = new XLSTextControl($this, $this->GetChildName('FirstName'));
        $objControl->Name = _sp('Firstname');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 64);

        return $objControl;
    }

    protected function UpdateFirstNameControl() {
    }

    protected function BindFirstNameControl() {
    }

    protected function BuildLastNameControl() {
        $objControl = new XLSTextControl($this, $this->GetChildName('LastName'));
        $objControl->Name = _sp('Lastname');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 64);

        return $objControl;
    }

    protected function UpdateLastNameControl() {
    }

    protected function BindLastNameControl() {
    }

    protected function BuildCompanyControl() {
        $objControl = new XLSTextControl($this, $this->GetChildName('Company'));
        $objControl->Name = _sp('Company');
        $objControl->SetCustomAttribute('maxlength', 255);

        return $objControl;
    }

    protected function UpdateCompanyControl() {
    }

    protected function BindCompanyControl() {
    }

    protected function BuildPhoneControl() {
        $objControl = new XLSTextControl($this, $this->GetChildName('Phone'));
        $bjControl->Name = _sp('Phone');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 64);

        return $objControl;
    }

    protected function UpdatePhoneControl() {
    }

    protected function BindPhoneControl() {
    }

    protected function BuildEmailControl() {
        $objControl = new XLSTextControl($this, $this->GetChildName('Email'));
        $objControl->Name = _sp('Email');
        $objControl->Required = true;
        $objControl->SetCustomAttribute('maxlength', 255);

        return $objControl;
    }

    protected function UpdateEmailControl() {
    }

    protected function BindEmailControl() {
    }

    protected function UpdateControl() {
        parent::UpdateControl();
        $this->RegisterChild('FirstName');
        $this->RegisterChild('LastName');
        $this->RegisterChild('Company');
        $this->RegisterChild('Phone');
        $this->RegisterChild('Email');
    }


}

