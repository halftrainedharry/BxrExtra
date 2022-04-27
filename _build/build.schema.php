<?php
/**
 * Build Schema script
 *
 * @package bxrextra
 * @subpackage build
 */
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

/* define package name */
define('PKG_NAME','BxrExtra');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));

/* define sources */
$root = dirname(dirname(__FILE__)) . '/';
$sources = array(
    'root' => $root,
    'core' => $root . 'core/components/' . PKG_NAME_LOWER . '/',
    'model' => $root . 'core/components/' . PKG_NAME_LOWER . '/src/Model/',
    'assets' => $root . 'assets/components/' . PKG_NAME_LOWER . '/',
);

/* load modx and configs */
require_once dirname(__FILE__) . '/build.config.php';
include_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('mgr');
$modx->loadClass('transport.modPackageBuilder', '', false, true);
echo '<pre>'; /* used for nice formatting of log messages */
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');

$manager = $modx->getManager();
$generator = $manager->getGenerator();

$generator->parseSchema($sources['core'] . 'schema/' . PKG_NAME_LOWER . '.mysql.schema.xml', $sources['model']);

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tend = $mtime;
$totalTime = ($tend - $tstart);
$totalTime = sprintf("%2.4f s", $totalTime);

echo "\nExecution time: {$totalTime}\n";

exit ();