<?php
/**
 * @var \MODX\Revolution\modX $modx
 * @var array $namespace
 */

use xPDO\xPDO;

try {
    // Add the package and model classes
    $modx->addPackage('BxrExtra\Model', $namespace['path'] . 'src/', null, 'BxrExtra\\');

    // Add the service
    $modx->services->add('bxrextra', function($c) use ($modx) {
        return new BxrExtra\BxrExtra($modx);
    });
        
}
catch (\Exception $e) {
    $modx->log(xPDO::LOG_LEVEL_ERROR, $e->getMessage());
}