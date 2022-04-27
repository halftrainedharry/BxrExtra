<?php

use BxrExtra\Model\BxrExtraItem;

$bxrextra = null;
try {
    if ($modx->services->has('bxrextra')) {
        $bxrextra = $modx->services->get('bxrextra');
    }
} catch (ContainerExceptionInterface $e) {
    // handle the thing not being available
}
if (!($bxrextra instanceof \BxrExtra\BxrExtra)) {
    return 'Service bxrextra not available.';
} 

$m = $modx->getManager();
$m->createObjectContainer(BxrExtraItem::class);
return 'Table created.';