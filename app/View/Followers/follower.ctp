<?php

include 'header.ctp';

echo '<div id="user_info">';
echo 'You are being followed by '.$user_count.' people';
echo '</div>';
		
if(isset($people)){
	echo '<div id="tweet_records">';			
	
	if(!empty($people)){

		foreach ($people as $person) : 

			if(!empty($person['Tweet'])){
				$latest_tweet=$person['Tweet'][0]['tweet'];
				$tweeting_time=$person['Tweet'][0]['datetime'];
			}
			else{
				$latest_tweet='No tweets yet';
				$tweeting_time='';
			}

			$user_name=$person['User']['name'];
			$user_username=$person['User']['username'];
			$user_id=$person['User']['id'];

			echo '<table id="t01">';
			echo'<tr>';
				echo '<td>'.
					$user_name.'@'.$this->HTML->link($user_username, array('controller'=>'tweets','action'=>'profile',$user_id)).'<br>'.$latest_tweet.'&nbsp;'.'<br>'.'<font color="blue">'.$tweeting_time.'</font>'
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