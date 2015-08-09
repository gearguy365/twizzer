<?php
	include 'header.ctp';

	echo '<div id="reg_2">';
	echo $this->Form->create('User');
	echo $this->Form->input('name');
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('mail');
	echo $this->Form->end('Register');
	echo '</div>';