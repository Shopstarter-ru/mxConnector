<?php

class mxConnectorLinkCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'mxConnectorLink';
    public $classKey = 'mxConnectorLink';
    public $languageTopics = ['mxconnector'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $master = (int)$this->getProperty('master');
        $slave = (int)$this->getProperty('slave');
        $taxon = (int)$this->getProperty('taxon');

        if ($master == $slave) {
            return $this->modx->lexicon('mxconnector_link_err_master_slave');
        }

        if ($this->modx->getObject('mxConnectorLink', array('master' => $master, 'slave' => $slave, 'taxon' => $taxon))) {
            return $this->modx->lexicon('mxconnector_link_err_exist_link');
        }

        if ($this->modx->getObject('mxConnectorLink', array('master' => $slave, 'slave' => $master, 'taxon' => $taxon))) {
            return $this->modx->lexicon('mxconnector_link_err_exist_revert_link');
        }

        return parent::beforeSet();
    }

}

return 'mxConnectorLinkCreateProcessor';