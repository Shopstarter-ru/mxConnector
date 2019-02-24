<?php

/**
 * The home manager controller for mxConnector.
 *
 */
class mxConnectorHomeManagerController extends modExtraManagerController
{
    /** @var mxConnector $mxConnector */
    public $mxConnector;


    /**
     *
     */
    public function initialize()
    {
        $this->mxConnector = $this->modx->getService('mxConnector', 'mxConnector', MODX_CORE_PATH . 'components/mxconnector/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['mxconnector:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('mxconnector');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->mxConnector->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/mxconnector.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/widgets/taxons.grid.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/widgets/taxons.windows.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/widgets/links.grid.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/widgets/links.windows.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->mxConnector->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        mxConnector.config = ' . json_encode($this->mxConnector->config) . ';
        mxConnector.config.connector_url = "' . $this->mxConnector->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "mxconnector-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="mxconnector-panel-home-div"></div>';

        return '';
    }
}