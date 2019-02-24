<?php

class mxConnectorTaxonRemoveProcessor extends modObjectProcessor
{
    public $objectType = 'mxConnectorTaxon';
    public $classKey = 'mxConnectorTaxon';
    public $languageTopics = ['mxconnector'];
    //public $permission = 'remove';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('mxconnector_taxon_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var mxConnectorTaxon $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('mxconnector_taxon_err_nf'));
            }

            $object->remove();
        }

        return $this->success();
    }

}

return 'mxConnectorTaxonRemoveProcessor';