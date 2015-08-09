<?php

include 'header.ctp';

echo '<div id="user_info">';
echo 'You are following '.$user_count.' people';
echo '</div>';

if(isset($followees)){

	echo '<div id="tweet_records">';
			
	if(!empty($followees)){
		foreach ($followees as $user) : 

			//by default values, works in case the following person have no tweets yet
			$formatted_text='No tweets yet';
			$formatted_time='';
						
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
		endforeach;

		echo'</table>';
	}

	else{
		echo '<font color="red"> No results found </font>';
	}

	echo '</div>';
}