<!-- 
	Common header for all the views under UsersController
	NOTE: Some image source directory and href directories are relative to the 
	development computer and will need adjustments for redeployment.
-->
<body>

	<ul>
	  <li><a id ='logo' href="/twizzer"><img src='/twizzer/app/webroot/img/twizzer-logo.png'></a></li>
	  <?php
	  	if(AuthComponent::user()){
	  		echo "<li><a id='menu' href='/twizzer'>Home</a></li>";
	  		echo "<li><a id='menu' href='/twizzer/users/search'>Search</a></li>";
	  		echo "<li><a id='menu'  href='/twizzer/users/logout'>LogOut</a></li>";

	  	}
	  	else{
	  		echo"<li><a id='menu'  href='/twizzer/users/login'>LogIn</a></li>";	
	  	}
	  ?>
	</ul>

</body>