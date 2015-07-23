<?php
	include 'header.ctp';
	
	echo $this->Form->create('Tweet');
	echo $this->Form->input('tweet');
	echo $this->Form->end('Tweet');