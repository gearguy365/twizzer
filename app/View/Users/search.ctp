<?php 
	include 'header.ctp';
?>

<div id="feed">
<?php
	echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'search')));
	echo $this->Form->input('search');
	echo $this->Form->end('Search');
    echo 'search by name';
?>
</div>

<div id="tweet_records">

<?php 
	if(isset($search_result)){ 
		if(!empty($search_result)){

			foreach ($search_result as $user) : 

				$formatted_tweet;
				$latest_tweet_time;
				$formatted_time;
				$name= $user['User']['name'];
				$username= $user['User']['username'];
				$id=$user['User']['id'];


				if(!empty($user['Tweet'])){
					$formatted_tweet=$this->Text->autoLinkUrls($user['Tweet']['0']['tweet']);
					$latest_tweet_time=$user['Tweet']['0']['datetime'];
					$formatted_time;
					if(strlen($latest_tweet_time)!=0){
						$formatted_time='Tweeted at '.$latest_tweet_time;
					}
					else{
						$formatted_time='No tweets yet';	
					}
				}
				else if(empty($user['Tweet'])){
					$formatted_tweet='No tweets yet';
					$formatted_time='';		
				}
?>

<table id="t01">
	<tr>
		<td>
		<?php
		    echo $name.'@'.$this->HTML->link($username, array('controller'=>'tweets','action'=>'profile',$id)).'<br>';
		    echo $formatted_tweet.'&nbsp;'.'<br>';
		    echo '<font color="blue">'.$formatted_time.'</font>';
		?>

		<div id="delete">
		<?php
			$selector='true';

			foreach ($user['Follower'] as $follower) :
				if($follower['follower_user_id']==AuthComponent::user('id')){
					$selector='false';
					echo $this->Form->postlink('Unfollow',array('controller'=>'followers','action'=>'unfollow',$user['User']['id']),array('confirm'=>'Do you really want to unfollow this person?'));
				}
			endforeach;

			if($selector=='true' & $user['User']['id']!=AuthComponent::user('id')){
				echo $this->Form->postlink('Follow',array('controller'=>'followers','action'=>'follow',$user['User']['id']));
			}
		?>
		</div>

		</td>
	</tr>
			<?php endforeach;?>		
</table>
			
	<?php
		include 'pagination.ctp';
	?>
	
	<?php		
			}
			else{
				echo '<font color="red"> No results found </font>';
			}
		}
	?>
</div>