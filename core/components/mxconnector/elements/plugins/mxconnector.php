<?php

switch ($modx->event->name) {

    case 'OnDocFormPrerender':

        if ($mode == 'new') {
            return;
        }

        $template = $resource->get('template');
        $templates = array_map('trim', explode(',', $modx->getOption('mxconnector_disable_for_templates')));
        if (!empty($templates) && in_array($template, $templates)) {
            return;
        }

        if ($mxctab = $modx->getService('mxconnector', 'mxConnector', MODX_CORE_PATH . 'components/mxconnector/model/')) {
            $mxctab->loadlinksTab($modx->controller, $resource);
        }

        break;
}