<?php
	include 'header.ctp';

	echo '<div id="login">';
	echo '<div id="inner">';
	echo $this->Form->create('User');
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->end('Log In');
	echo '</div>';
	echo '</div>';
	echo '<div id="reg">';
	echo'Do not have account?';
	echo'<br>';
	echo $this->HTML->link('Sign Up',array('controller'=>'users','action'=>'register'));
	echo '</div>';
