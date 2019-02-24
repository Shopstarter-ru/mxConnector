<?php

class mxConnectorLinkGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'mxConnectorLink';
    public $classKey = 'mxConnectorLink';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        if ($master = $this->getProperty('master')) {
            $c->orCondition(array('master' => $master, 'slave' => $master));
        }
        $c->innerJoin('mxConnectorTaxon', 'Taxons', $this->classKey . '.taxon = Taxons.id');
        $c->select('Taxons.name as taxon_name');
        $c->innerJoin('modResource', 'Master', $this->classKey . '.master = Master.id');
        $c->innerJoin('modResource', 'Slave', $this->classKey . '.slave = Slave.id');
        $c->select('Master.pagetitle as master_pagetitle, Slave.pagetitle as slave_pagetitle');

        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));

        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where(array(
                'Taxons.name:LIKE' => "%{$query}%",
                'OR:Master.pagetitle:LIKE' => "%{$query}%",
                'OR:Slave.pagetitle:LIKE' => "%{$query}%",
            ));
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['actions'] = [];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('mxconnector_link_update'),
            //'multiple' => $this->modx->lexicon('mxconnector_links_update'),
            'action' => 'updateLink',
            'button' => true,
            'menu' => true,
        ];

        // Remove
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('mxconnector_link_remove'),
            'multiple' => $this->modx->lexicon('mxconnector_links_remove'),
            'action' => 'removeLink',
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'mxConnectorLinkGetListProcessor';