<?php

namespace BxrExtra;

use MODX\Revolution\modChunk;
use MODX\Revolution\modX;
use BxrExtra\Model\BxrExtraItem;

/**
 * The base class for BxrExtra.
 *
 * @package bxrextra
 */
class BxrExtra {
    
    public $modx;
    public $namespace = 'bxrextra';
    public $options = [];

    function __construct(modX &$modx, array $options = []) {
        $this->modx =& $modx;

        $corePath = $this->getOption(
            'core_path',
            $options,
            $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/bxrextra/'
        );
        $assetsPath = $this->getOption(
            'assets_path',
            $options,
            $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/bxrextra/'
        );
        $assetsUrl = $this->getOption(
            'assets_url',
            $options,
            $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/bxrextra/'
        );

        $this->options = array_merge(
            [
                'namespace' => $this->namespace,
                'corePath' => $corePath,
                'modelPath' => $corePath . 'model/',
                'chunksPath' => $corePath . 'elements/chunks/',
                'snippetsPath' => $corePath . 'elements/snippets/',
                'processorsPath' => $corePath . 'processors/',
                'templatesPath' => $corePath . 'templates/',
                'assetsPath' => $assetsPath,
                'assetsUrl' => $assetsUrl,
                'jsUrl' => $assetsUrl . 'js/',
                'cssUrl' => $assetsUrl . 'css/'            
            ]
        ,$options);

        $this->modx->lexicon->load('bxrextra:default');
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param  string  $key  The option key to search for.
     * @param  array  $options  An array of options that override local options.
     * @param  mixed  $default  The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     *
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }

    public function getChunk($tpl, $phs = [])
    {
        if (strpos($tpl, '@INLINE ') !== false) {
            $content = str_replace('@INLINE', '', $tpl);
            /** @var modChunk $chunk */
            $chunk = $this->modx->newObject(modChunk::class, ['name' => 'inline-' . uniqid()]);
            $chunk->setCacheable(false);

            return $chunk->process($phs, $content);
        }

        return $this->modx->getChunk($tpl, $phs);
    }
}