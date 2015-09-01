<?php
	echo 'Pages: ';
	echo $this->Paginator->prev(
	  '<Previous',
		  array(),
		  null,
		  array('class' => 'prev disabled')
	);
		
	echo '|';

	echo $this->Paginator->next(
		'Next>', 
		array(), 
		null, 
		array('class' => 'next disabled')
	);
?>