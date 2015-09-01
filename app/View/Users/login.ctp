<?php
	include 'header.ctp';
?>
<div id="login">
	<div id="inner">
	<?php
		echo $this->Form->create('User');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->end('Log In');
	?>
</div>

</div>

<div id="reg">
	<P>Do not have account?</p>
	<?php echo $this->HTML->link('Sign Up',array('controller'=>'users','action'=>'register')); ?>
</div>
