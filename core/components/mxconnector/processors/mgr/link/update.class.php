<?php

class mxConnectorLinkUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'mxConnectorLink';
    public $classKey = 'mxConnectorLink';
    public $languageTopics = ['mxconnector'];
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $slave = (int)$this->getProperty('slave');
        $taxon = (int)$this->getProperty('taxon');

        if (empty($id)) {
            return $this->modx->lexicon('mxconnector_link_err_ns');
        }

        if ($q = $this->modx->getObject('mxConnectorLink', $id)) {
            $master = $q->get('master');

            if ($master == $slave) {
                return $this->modx->lexicon('mxconnector_link_err_master_slave');
            }

            if ($this->modx->getObject('mxConnectorLink', array('master' => $master, 'slave' => $slave, 'taxon' => $taxon))) {
                return $this->modx->lexicon('mxconnector_link_err_exist_link');
            }

            if ($this->modx->getObject('mxConnectorLink', array('master' => $slave, 'slave' => $master, 'taxon' => $taxon))) {
                return $this->modx->lexicon('mxconnector_link_err_exist_revert_link');
            }

        }

        return parent::beforeSet();
    }
}

return 'mxConnectorLinkUpdateProcessor';
