<?php

class XLSCompositeControl extends QPanel {
    protected $strRegisteredChildren = array();

    protected function GetChildName($strName) {
        return $this->ControlId . $strName;
    }

    protected function GetChildByName($strName) {
        return $this->GetChildControl($this->GetChildName($strName));
    }

    protected function IsRegistered($strName) {
        return in_array($strName, $this->strRegisteredChildren);
    }

    protected function IsBuilt($strName) {
        if ($this->GetChildByName($strName)) return true;
        return false;
    }

    protected function RegisterChild($strName) {
        if (!$this->IsRegistered($strName))
            $this->strRegisteredChildren[] = $strName;
    }

    protected function UnregisterChild($strName) {
        if ($this->IsRegistered($strName)
            foreach ($this->strRegisteredChildren as $key => $value)
                if ($value == $strName) 
                    unset($this->strRegisteredChildren[$key]);
    }

    protected function GetChild($strName) {
        $objControl = $this->GetChildByName($strName);

        if (!$objControl and $this->IsRegistered($strName)) {
            $strBuild = 'Build' . $strName . 'Control';
            $strUpdate = 'Update' . $strName . 'Control';
            $strBind = 'Bind' . $strName . 'Control';

            if (method_exists($this, $strBuild))
                $objControl = $this->$strBuild();

            if (method_exists($this, $strUpdate))
                $this->$strUpdate();

            if (method_exists($this, $strBind))
                $this->$strBind();
        }

        return $objControl;
    }

    protected function UpdateChild($strName) {
        $objControl = $this->GetChildByName($strName);
        $strUpdate = 'Update' . $strName . 'Control';

        if ($objControl && method_exists($this, $strUpdate))
            $this->$strUpdate();

        return $objControl;
    }

    public function Update() {
        foreach ($this->strRegisteredChildren as $strName)
            $this->UpdateChild($strName);

        parent::Refresh();
    }

    protected function BuildControl() {}
    protected function UpdateControl() {}
    protected function BindControl() {}

    public function __construct($objParentControl, $strControlId) {
        try { 
            parent::__construct($objParentControl, $strControlId);

            $this->BuildControl();
            $this->UpdateControl();
            $this->BindControl();
        }
        catch (QCallerException $objExc) {
            $objExc->IncrementOffset();
            throw $objExc;
        }
    }

    public function __get($strName) {
        $mixIsControl = strrpos($strName , 'Ctrl');

        if ($mixIsControl !== false) {
            $strName = substr($strName, 0, $mixIsControl);

            if ($this->IsRegistered($strName))
                return $this->GetChild($strName);
        }

        switch ($strName) {
            case 'RegisteredChildren': return $this->strRegisteredChildren;
            default:
                try { 
                    return parent::__get($strName);
                }
                catch (QCallerException $objExc) { 
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }

}

/* vim: set ft=php ts=4 sw=4 tw=80 et: */
