<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/mxConnector/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/mxconnector')) {
            $cache->deleteTree(
                $dev . 'assets/components/mxconnector/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/mxconnector/', $dev . 'assets/components/mxconnector');
        }
        if (!is_link($dev . 'core/components/mxconnector')) {
            $cache->deleteTree(
                $dev . 'core/components/mxconnector/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/mxconnector/', $dev . 'core/components/mxconnector');
        }
    }
}

return true;