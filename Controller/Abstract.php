<?php

class Controller_Abstract extends Santa_Controller {
	
	public function init() {
	}
	
	/* (non-PHPdoc)
	 * @see Santa_Controller::filters()
	 * 支持带参数的过滤函数
	 */
	/* public function filters($currentAction = null) {
		if (null === $currentAction) {
			throw new Exception ( 'current action must not be null' );
		}
		$filters = $this->filters;
		$actionFilters = isset ( $filters ['action'] [$currentAction] ) ? $filters ['action'] [$currentAction] : array ();
		$invalidFilters = array_merge ( $filters ['controller'], $actionFilters );
		foreach ( $invalidFilters as $k => &$v ) {
			if (! is_array ( $v ))
				throw new Exception ( "filter $k must be array" );
			if (! isset ( $v [0] ))
				throw new Exception ( "filter $k must have at least one value as 0/1" );
			if (! $v [0])
				unset ( $invalidFilters [$k] );
			if (! isset ( $v [1] ))
				$v [1] = array ();
			if (! is_array ( $v [1] ))
				throw new Exception ( "filter $k index 1 must be array" );
		}
		return $invalidFilters;
	} */
	
	/* (non-PHPdoc)
	 * @see Santa_Controller::filters()
	 */
	public function filters($currentAction = null) {
		if (null === $currentAction) {
			throw new Exception ( 'current action must not be null' );
		}
		$filters = $this->filters;
		$actionFilters = isset ( $filters ['action'] [$currentAction] ) ? $filters ['action'] [$currentAction] : array ();
		$invalidFilters = array_merge ( $filters ['controller'], $actionFilters );
		$invalidFilters = array_keys ( $invalidFilters, 1 );
		print_r($invalidFilters);
		return $invalidFilters;
	}
}