<?php

class XLSCustomerCompositeControl extends XLSCompositeControl {
    
    protected function UpdateControlFromEnvironment($strField) {
        $objControl = $this->GetChildByName($strField);

        $strFieldProperty = 'Text';
        if ($objControl instanceof QTextBoxBase)
            $strFieldProperty = 'Text';
        elseif ($objControl instanceof QListControl)
            $strFieldProperty = 'SelectedValue';

        if ($objControl->$strFieldProperty)
            return $objControl;

        $objCart = Cart::GetCart();
        $strCartField = $this->strFieldMapping['cart'][$strField];
        if ($strCartField)
            if ($objCart->$strCartField) {
                $objControl->$strFieldProperty = $objCart->$strCartField;
                return $objControl;
            }   

        $objCustomer = Customer::GetCurrent();
        $strCustomerField = $this->strFieldMapping['customer'][$strField];
        if ($strCustomerField)
            if ($objCustomer->$strCustomerField) {
                $objControl->$strFieldProperty = $objCustomer->$strCustomerField;
                return $objControl;
            }

        return $objControl;
    }   

}

