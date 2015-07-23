	<style>
		#login {
		    line-height:30px;
		    background-color:#eeeeee;
		    width:700px;
		    float:left;
		    padding:5px;	
		    margin-top:10px;      
		}

		#inner {
		    line-height:30px;
		    background-color:#eeeeee;
		    width:500px;
		    float:left;
		    padding:0px;	
		    margin-top:10px;      
		}

		#reg {
			line-height: 30px;
			background-color: #B3C9C7;
			width: 400px;
			height: 253px;
			float: left;
			margin-top: 10px;
			padding-left: 15px;
			padding-top: 30px;
		}
	</style>
	
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
