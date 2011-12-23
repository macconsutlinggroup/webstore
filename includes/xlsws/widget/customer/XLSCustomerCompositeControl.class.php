<?php

class XLSCustomerCompositeControl extends XLSCompositeControl {
    
    protected function UpdateControlFromEnvironment($strField) {
        $objControl = $this->GetChild($strField);
        if (!$objControl)
            return;

        $strFieldProperty = 'Text';
        if ($objControl instanceof QTextBoxBase)
            $strFieldProperty = 'Text';
        elseif ($objControl instanceof QListControl)
            $strFieldProperty = 'SelectedValue';

        if ($objControl->$strFieldProperty)
            return $objControl;

        $objCart = Cart::GetCart();
        $strCartField = $this->strFieldMapping['cart'][$strField];
        if ($objCart && $strCartField) {
            if ($objCart->$strCartField) {
                $objControl->$strFieldProperty = $objCart->$strCartField;
                return $objControl;
            }
        }

        $objCustomer = Customer::GetCurrent();
        $strCustomerField = $this->strFieldMapping['customer'][$strField];
        if ($objCustomer && $strCustomerField) {
            if ($objCustomer->$strCustomerField) {
                $objControl->$strFieldProperty = $objCustomer->$strCustomerField;
                return $objControl;
            }
        }

        return $objControl;
    }   
}

