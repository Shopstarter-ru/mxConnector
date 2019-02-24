<?php

class mxConnector
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
        $corePath = MODX_CORE_PATH . 'components/mxconnector/';
        $assetsUrl = MODX_ASSETS_URL . 'components/mxconnector/';

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        ], $config);

        $this->modx->addPackage('mxconnector', $this->config['modelPath']);
        $this->modx->lexicon->load('mxconnector:default');
    }

    public function loadlinksTab(modManagerController $controller, modResource $resource)
    {
        $cssUrl = $this->config['cssUrl'] . 'mgr/';
        $jsUrl = $this->config['jsUrl'] . 'mgr/';
        $assetsUrl = MODX_ASSETS_URL . 'components/mxconnector/';

        $controller->addLexiconTopic('mxconnector:default');
        $controller->addJavascript($jsUrl . 'mxconnector.js');
        $controller->addLastJavascript($jsUrl . 'misc/combo.js');
        $controller->addLastJavascript($jsUrl . 'misc/utils.js');
        $controller->addLastJavascript($jsUrl . 'widgets/tab/links.windows.js');
        $controller->addLastJavascript($jsUrl . 'widgets/tab/links.grid.js');
        $controller->addLastJavascript($jsUrl . 'widgets/taxons.windows.js');
        $controller->addLastJavascript($jsUrl . 'widgets/taxons.grid.js');
        $controller->addLastJavascript($jsUrl . 'widgets/tab/links.panel.js');
        $controller->addCss($cssUrl . 'main.css');


        $controller->addHtml('
		<script type="text/javascript">
			mxConnector.config = ' . $this->modx->toJSON($this->config) . ';
			mxConnector.config.connector_url = "' . $assetsUrl . 'connector.php' . '";
		</script>');


        $insert = '
                tabs.add({
                    xtype: "mxconnector-page",
                    id: "mxconnector-page",
                    title: _("mxconnector_resource_tab_name"),
                    record: {
                        id: ' . $resource->get('id') . ',
                    }
                });
            ';

        $controller->addHtml('
                <script type="text/javascript">
                    Ext.ComponentMgr.onAvailable("modx-resource-tabs", function() {
                        var tabs = this;
                        tabs.on("beforerender", function() {
                            ' . $insert . '
                        });
                    });
                </script>');
    }

}