<?php

class XLSShippingAddressControl extends AddressControl { 

    protected $strFieldMapping = array(
        'cart' => array(
            'Street1' => 'ShipAddress1',
            'Street2' => 'ShipAddress2',
            'City' => 'ShipCity',
            'State' => 'ShipState',
            'Country' => 'ShipCountry',
            'Zip' => 'ShipZip',
        ),  
        'customer' => array(
            'Street1' => 'Address21',
            'Street2' => 'Address22',
            'City' => 'City2',
            'State' => 'State2',
            'Country' => 'Country2',
            'Zip' => 'Zip2',
        )   
    );  


    protected function UpdateCountryControl() {
        $objControl = $this->GetChildByName('Country');

        if (!$objControl)
            return;

        if (_xls_get_conf('SHIP_RESTRICT_DESTINATION', 0) != 1) {
            $objControl = parent::UpdateCountryControl();
        }
        else {
            $objControl->RemoveAllItems();
            $objControl->AddItem(_sp('-- Select One --'), null);

            $objDestinations = Destination::LoadAll();

            if ($objDestinations) {
                $strCountries = array();
                $objCountries = false;

                foreach ($objDestinations as $objDestination) {
                    $strCode = $objDestination->Country;

                    if ($strCode && !in_array($strCode, $strCountries))
                        $strCountries[] = $strCode;
                }

                if ($strCountries) {
                    $objCountries = Country::QueryArray(
                        QQ::In(
                            QQN::Country()->Code,
                            $strCountries
                        ),
                        QQ::Clause(
                            QQ::OrderBy(
                                QQN::Country()->SortOrder, 
                                QQN::Country()->Country
                            )
                        )
                    );

                    foreach ($objCountries as $objCountry)
                        $objControl->AddItem(
                            $objCountry->Country, 
                            $objCountry->Code
                        );
                }
            }
        }

        return $objControl;
    }

    protected function UpdateStateControl() {
        $objControl = $this->GetChildByName('State');
        $objCountryControl = $this->GetChildByName('Country');

        $objControl->RemoveAllItems();
        $objControl->AddItem(_sp('-- Select One --'), null);

        if (!$objControl || !$objCountryControl || 
            is_null($objCountryControl->SelectedValue))
            return;

        if (_xls_get_conf('SHIP_RESTRICT_DESTINATION', 0) != 1) {
            $objControl = parent::UpdateStateControl();
        }
        else {
            $objDestinations = Destination::LoadByCountry(
                $objCountryControl->SelectedValue
            );

            if ($objDestinations) {
                $strStates = array();
                $objStates = false;

                foreach ($objDestinations as $objDestination) {
                    $strCode = $objDestination->State;

                    if ($strCode == '*') { 
                        $strStates = false;
                        $objStates = State::LoadArrayByCountryCode(
                            $objCountryControl->SelectedValue
                        );
                        break;
                    }

                    if ($strCode && !in_array($strCode, $strStates))
                        $strStates[] = $strCode;
                }

                if ($strStates && !$objStates) {
                    $objStates = State::QueryArray(
                        QQ::In(
                            QQN::State()->Code,
                            $strStates
                        ),
                        QQ::Clause(
                            QQ::OrderBy(
                                QQN::State()->SortOrder, 
                                QQN::State()->State
                            )
                        )
                    );
                }

                if ($objStates) {
                    foreach ($objStates as $objState)
                        $objControl->AddItem(
                            $objState->State, 
                            $objState->Code
                        );
                }
            }
        }

        return $objControl;
    }

}

