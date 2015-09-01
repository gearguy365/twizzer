<?php
	include 'header.ctp';
?>
<div id="reg_2">
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('name');
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('mail');
	echo $this->Form->end('Register');
?>
</div>