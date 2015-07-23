	<style>
		#reg {
		    line-height:30px;
		    background-color:#eeeeee;
		    width:700px;
		    float:left;
		    padding:5px;	
		    margin-top:10px;      
		}
	</style>
<?php
	include 'header.ctp';

	echo '<div id="reg">';
	echo $this->Form->create('User');
	echo $this->Form->input('name');
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('mail');
	echo $this->Form->end('Register');
	echo '</div>';