	<style>
		#tweet {
		    line-height:20px;
		    background-color:#FFFFFF;
		    width:698px;
		    float:left;
		    padding:5px;	
		    margin-top:10px;  
		    border: 1px solid black;  
		    border-radius: 5px;
		}

		#feed {
			float: left;
			line-height:30px;
		    background-color:#eeeeee;
		    width:701px;
		    padding:5px;	
		    margin-top:20px; 
		    clear:both;
		    border-radius: 5px;
		}

		#sidebar{
			text-align:center;
			line-height:30px;
		    background-color:#B3C9C7;
		    width:300px;
		    height: 150px;
		    float: right;
		    padding: 5px;	
		    margin-top: 10px;  
		    margin-right: 30px;
		    border: 1px solid black;  
		    border-radius: 5px;
		}

		th, td {
		    padding: 5px;
		    text-align: left;
		}
		table#t01 tr:nth-child(even) {
		    background-color: #eee;
		}
		table#t01 tr:nth-child(odd) {
		   background-color:#fff;
		}


	</style>
<?php
	include 'header.ctp';
	
	echo '<div id="tweet">';
	echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'tweet')));
	echo $this->Form->input('tweet');
	echo 'Let your followers know what you are doing right now. Write something within 140 words and Tweet...';
	echo $this->Form->end('Tweet');
	echo'<br>';
	echo '</div>';

	echo '<div id="sidebar">';
	echo AuthComponent::user('username');
	echo'<br>';
	if($follower_count!=0){
		echo 'Follower '.$this->HTML->link($follower_count,array('controller'=>'followers','action'=>'followed',1));
	}
	else{
		echo 'Follower 0';
	}
	echo'  /';

	if($following_count!=0){
		echo 'Following '.$this->HTML->link($following_count,array('controller'=>'followers','action'=>'followed',2));
	}
	else{
		echo 'Following 0';
	}
	echo'  /';

	if($tweet_count!=0){
		echo 'Tweets '.$this->HTML->link($tweet_count,array('controller'=>'tweets','action'=>'profile',$user_details['User']['id']));
	}
	else{
		echo 'Tweet 0';
	}
	echo '</div>';

	if(isset($feed)){
		echo '<div id="feed">';
		
		if(!empty($feed)){
			foreach ($feed as $user) : 

				$formatted_text;
				$latest_tweet_time;
				$formatted_time;

				if(!empty($user['Tweet'])){
					$formatted_text=$this->Text->autoLinkUrls($user['Tweet']['tweet']);
					$latest_tweet_time=$user['Tweet']['datetime'];
					$formatted_time;
					if(strlen($latest_tweet_time)!=0){
						$formatted_time='Tweeted at '.$latest_tweet_time;
					}
					else{
						$formatted_time='No tweets yet';	
					}
				}
				else if(empty($user['Tweet'])){
					$formatted_text='No tweets yet';
					$formatted_time='';		
				}
				echo '<table id="t01">';
				echo'<tr>';

				echo '<td>'.
				     $user['User']['name'].'@'.$this->HTML->link($user['User']['username'], array('controller'=>'tweets','action'=>'profile',$user['User']['id'])).'<br>'.$formatted_text.'&nbsp;'.'<br>'.'<font color="blue">'.$formatted_time.'</font>'
				     .'</td>';

				echo '</tr>';

			endforeach;

			echo'</table>';
		}
		else{
			echo '<font color="red"> No results found </font>';
		}
		echo '</div>';
	}