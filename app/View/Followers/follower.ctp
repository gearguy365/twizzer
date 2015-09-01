<?php
	include 'header.ctp';
?>

<div id="user_info">
	<p><?php echo 'You are being followed by '.$follower_count.' followers';?></p>
</div>


<div id="sidebar">
<?php include 'sidebar.ctp';?>
</div>


<div id="tweet_records">			

<?php	
	foreach ($followers as $person) :
		$latest_tweet='';
		$tweeting_time=''; 
		$user_name=$person['User']['name'];
		$user_username=$person['User']['username'];
		$user_id=$person['User']['id'];

		if(!empty($person['Tweet'])){
			$latest_tweet=$person['Tweet'][0]['tweet'];
			$tweeting_time=$person['Tweet'][0]['datetime'];
		}
		else{
			$latest_tweet='No tweets yet';
			$tweeting_time='';
		}
?>
<table id="t01">
	<tr>
		<td>
		<?php
			echo $user_name.'@'.$this->HTML->link($user_username, array('controller'=>'tweets','action'=>'profile',$user_id));
			echo '<br>';
			echo $latest_tweet.'&nbsp;';
			echo '<br>';
			echo '<font color="blue">'.$tweeting_time.'</font>';
		?>
		<div id="delete">
		<?php
			$selector='true';

			foreach ($person['Follower'] as $follower) :
				if($follower['follower_user_id']==AuthComponent::user('id')){
					$selector='false';
					echo $this->Form->postlink('Unfollow',
						array(
							'controller'=>'followers',
							'action'=>'unfollow',
							$follower['id']),
						array(
							'confirm'=>'Do you really want to unfollow this person?')
						);
				}
			endforeach;

			if($selector=='true' & $person['User']['id']!=AuthComponent::user('id')){
				echo $this->Form->postlink('Follow',
					array(
						'controller'=>'followers',
						'action'=>'follow',
						$person['User']['id'])
					);
			}
		?>
		</div>
		</td>
	</tr>

	<?php endforeach;?>

</table>

<?php include 'pagination.ctp';?>

</div>