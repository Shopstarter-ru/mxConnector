<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var mxConnector $mxConnector */
$mxConnector = $modx->getService('mxConnector', 'mxConnector', MODX_CORE_PATH . 'components/mxconnector/model/', $scriptProperties);
if (!$mxConnector) {
    return 'Could not load mxConnector class!';
}

/** @var pdoFetch $pdoFetch */
$fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
$path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}

$pdoFetch->addTime('pdoTools loaded.');

/**
 * Основной класс
 */
$class = 'mxConnectorLink';

$taxons = array_map('trim', explode(',', $modx->getOption('taxons', $scriptProperties, '')));
$master = $modx->getOption('master', $scriptProperties, '');
if ($master == '') {
    $master = $modx->resource->get('id');
}
$slave = $modx->getOption('slave', $scriptProperties, '');
$tpl = $modx->getOption('tpl', $scriptProperties, 'mxConnectorLinks');

$where = array(
    $class . '.taxon:IN' => $taxons,
    $class . '.master' => $master,
);

if ($slave) {
    $where = array(
        $class . '.taxon:IN' => $taxons,
        $class . '.slave' => $slave,
    );
}

$taxon = 'mxConnectorTaxon';
$resource = 'modResource';
$leftJoin = array(
    $taxon => array('alias' => $taxon, 'on' => "$class.taxon = $taxon.id"),
    $resource => array('alias' => $resource, 'on' => "$class.slave = $resource.id"),
);

$select = array(
    $class => $modx->getSelectColumns($class, $class),
    $taxon => $modx->getSelectColumns($taxon, $taxon, 'taxon_'),
    $resource => $modx->getSelectColumns($resource, $resource, 'slave_'),
);

$pdoFetch->addTime('Conditions prepared');

$default = array(
    'class' => $class,
    'where' => $where,
    'leftJoin' => $leftJoin,
    'select' => $select,
    'sortby' => $modx->getOption('sortby', $scriptProperties, 'id'),
    'sortdir' => $modx->getOption('sortdir', $scriptProperties, 'ASC'),
    'return' => 'data',
);

// Merge all properties and run!
$pdoFetch->addTime('Query parameters ready');
$pdoFetch->setConfig(array_merge($default, $scriptProperties), false);
$rows = $pdoFetch->run();

// Выводим в чанк в виде массива
$output = $pdoFetch->getChunk($tpl, array(
    'links' => $rows,
));

$log = '';
if ($modx->user->hasSessionContext('mgr') && !empty($showLog)) {
    $log .= '<pre>' . print_r($pdoFetch->getTime(), 1) . '</pre>';
}

// Return output
$output .= $log;

if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder, $output);
} else {
    return $output;
}