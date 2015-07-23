<style>
		#user_info {
		    line-height:20px;
		    background-color:#FFFFFF;
		    width:698px;
		    float:left;
		    padding:5px;	
		    margin-top:10px;  
		    border: 1px solid black;  
		    border-radius: 5px;
		    font-size: 20px;
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

		#tweet_records {
			float: left;
			line-height:30px;
		    background-color:#eeeeee;
		    width:701px;
		    padding:5px;	
		    margin-top:20px; 
		    clear:both;
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
	echo '<div id="user_info">';

	if($type==1){
		echo 'You are being followed by '.$user_count.'people';
		echo '</div>';
		if(isset($followees)){
			echo '<div id="tweet_records">';
			
			if(!empty($followees)){
				foreach ($followees as $user) : 

					$formatted_text;
					$formatted_time;
					$user_name;
					$user_username;
					$user_id;


					foreach($tweets as $tweet):
						if($tweet['Tweet']['user_id']==$user['Follower']['follower_user_id']){
							$formatted_text=$tweet['Tweet']['tweet'];
							$formatted_time='Tweeted at '.$tweet['Tweet']['datetime'];
							$user_name=$tweet['User']['name'];
							$user_username=$tweet['User']['username'];
							$user_id=$tweet['User']['id'];
							break;
						}
					endforeach;

					echo '<table id="t01">';
					echo'<tr>';
					echo '<td>'.
					     $user_name.'@'.$this->HTML->link($user_username, array('controller'=>'tweets','action'=>'profile',$user_id)).'<br>'.$formatted_text.'&nbsp;'.'<br>'.'<font color="blue">'.$formatted_time.'</font>'
					     .'</td>';
					echo '</tr>';
					$formatted_text='';
					$formatted_time='';
				endforeach;
				echo'</table>';
			}

			else{
				echo '<font color="red"> No results found </font>';
			}
			echo '</div>';

		}
	}

	else if($type==2){
		echo 'You are following '.$user_count.' people';

		echo '</div>';
		if(isset($followees)){
			echo '<div id="tweet_records">';
			
			if(!empty($followees)){
				foreach ($followees as $user) : 

					$formatted_text;
					//$latest_tweet_time;
					$formatted_time;
					foreach($tweets as $tweet):
						if($tweet['Tweet']['user_id']==$user['User']['id']){
							$formatted_text=$tweet['Tweet']['tweet'];
							$formatted_time='Tweeted at '.$tweet['Tweet']['datetime'];
							break;
						}
					endforeach;

					echo '<table id="t01">';
					echo'<tr>';
					echo '<td>'.
					     $user['User']['name'].'@'.$this->HTML->link($user['User']['username'], array('controller'=>'tweets','action'=>'profile',$user['User']['id'])).'<br>'.$formatted_text.'&nbsp;'.'<br>'.'<font color="blue">'.$formatted_time.'</font>'
					     .'</td>';
					echo '</tr>';
					$formatted_text='';
					$formatted_time='';
				endforeach;
				echo'</table>';
			}

			else{
				echo '<font color="red"> No results found </font>';
			}
			echo '</div>';

		}

	}
