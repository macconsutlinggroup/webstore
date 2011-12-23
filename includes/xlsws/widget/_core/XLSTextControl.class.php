<?php

class XLSTextControl extends QTextBox {

    protected $strLabelForRequired = '%s is required';
    protected $strLabelForRequiredUnnamed = 'Required';

    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);

        $this->strLabelForRequired = 
            QApplication::Translate($this->strLabelForRequired);

        $this->strLabelForRequiredUnnamed = 
            QApplication::Translate($this->strLabelForRequiredUnnamed);
    }

    public function ValidateText() {
        $this->Text = stripslashes(trim($this->Text));

        return true;
    }

    public function ValidateRequired() {
        if ($this->blnRequired) {
            if ($this->Text == '') {
                if ($this->strName)
                    $this->strValidationError = sprintf(
                        $this->strLabelForRequired,
                        $this->strName
                    );
                else
                    $this->strValidationError = 
                        $this->strLabelForRequiredUnnamed;

                return false;
            }
        }

        return true;
    }

    public function Validate() {
        if (!$this->ValidateText()) return false;
        if (!$this->ValidateRequired()) return false;

        $this->strValidationError = false;
        return true;
    }

}

