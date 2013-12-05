<?php
/**
 * @author Administrator
 *
 */
class Filter_Test extends Santa_Filter {
	public function filt() {
		echo __METHOD__;
		Santa_Context::set ( 'filtest', 'hahahahah' );
	}
}
