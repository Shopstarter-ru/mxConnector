<?php

class mxConnectorTaxonCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'mxConnectorTaxon';
    public $classKey = 'mxConnectorTaxon';
    public $languageTopics = ['mxconnector'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('mxconnector_taxon_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('mxconnector_taxon_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'mxConnectorTaxonCreateProcessor';