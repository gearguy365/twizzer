<!-- 
	Common header for all the views under UsersController
	NOTE: Some image source directory and href directories are relative to the 
	development computer and will need adjustments for redeployment.
-->
<head>	
	<style>
		ul {
		    list-style-type: none;
		    margin: 0px;
		    padding: 0px;
		    text-align: right;
		    height: 60px;
		    background-color: #0099FF;
		    overflow: hidden;

		}

		li {
		    display:inline;
		}
		#logo { 
    		float:left;
		}
		
		#menu:link, #menu:visited {
		    font-weight: bold;
		    font-size: 16px;
		    width: 120px;
		    height: 60px;
		    text-align: center;
		    text-decoration: none;
		    color: #FFFFFF;
		}
		
		#menu:hover, #menu:active {
		    background-color: #0477C4;
		}
	</style>
</head>

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