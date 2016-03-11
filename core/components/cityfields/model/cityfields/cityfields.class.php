<?php
/**
 * The base class for cityFields.
 */

class cityFields {

	/* @var modX $modx */
	public $modx;
	public $namespace = 'cityfields';
	public $config = array();

	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct (modX &$modx, array $config = array()) {
		$this->modx =& $modx;
		$this->namespace = $this->modx->getOption('namespace', $config, 'cityfields');
		$corePath = $this->modx->getOption('cityfields_core_path', $config, $this->modx->getOption('core_path') . 'components/cityfields/');
		$assetsUrl = $this->modx->getOption('cityfields_assets_url', $config, $this->modx->getOption('assets_url') . 'components/cityfields/');
		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $assetsUrl . 'connector.php',
			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'chunkSuffix' => '.chunk.tpl',
			'templatesPath' => $corePath . 'elements/templates/',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);
		$this->modx->addPackage('cityfields', $this->config['modelPath']);
		$this->modx->lexicon->load('cityfields:default');
	}

}