<?php
	include 'header.ctp';
	echo $this->Html->script('jquery', FALSE);
	echo '<div id="sending" style="display: none; background-color:lightgreen;">Tweeting...</div>';
	echo '<div id="tweet">';
	echo $this->Form->create('Tweet');
	echo $this->Form->input('tweet');
	echo 'Let your followers know what you are doing right now. Write something within 140 words and Tweet...';
	echo $this->Js->submit('Tweet',array(
		'before'=>$this->Js->get('#sending')->effect('fadeIn'),
		'success'=>$this->Js->get('#sending')->effect('fadeOut'),
		'update'=>'#success'
		));
	echo $this->Form->end();
	echo'<br>';

	echo '</div>';
	
	echo '<div id="sidebar">';
	echo AuthComponent::user('username');
	echo'<br>';
	if($follower_count!=0){
		echo 'Follower '.$this->HTML->link($follower_count,array('controller'=>'followers','action'=>'follower'));
	}
	else{
		echo 'Follower 0';
	}
	echo'  /';

	if($following_count!=0){
		echo 'Following '.$this->HTML->link($following_count,array('controller'=>'followers','action'=>'following'));
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
			echo '<div id="success"></div>';
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
				echo '<td>';
				echo $user['User']['name'].'@'.$this->HTML->link($user['User']['username'], array('controller'=>'tweets','action'=>'profile',$user['User']['id'])).'<br>'.$formatted_text.'&nbsp;'.'<br>'.'<font color="blue">'.$formatted_time.'</font>';
				if($user['User']['id']==AuthComponent::user('id')){
					echo '<div id="delete">';
					echo $this->Form->postlink('Delete',array('controller'=>'tweets','action'=>'delete',$user['Tweet']['id']),array('confirm'=>'Do you really want to delete this tweet?'));
					echo '</div>';
				}

				echo '</td>';

				echo '</tr>';

			endforeach;
			echo'</table>';
			echo 'Pages: '.$this->Paginator->numbers();
		}
		else{
			echo '<font color="grey"> Recents tweets made by you and your friends will appear here </font>';
		}
		
		echo '</div>';
	}