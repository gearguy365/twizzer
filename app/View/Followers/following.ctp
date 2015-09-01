<?php
	include 'header.ctp';
?>

<div id="user_info">
	<p><?php echo 'You are following '.$following_count.' people';?></p>
</div>

<div id="sidebar">
<?php include 'sidebar.ctp';?>
</div>

<div id="tweet_records">

<?php
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
?>
	<table id="t01">
			
		<tr>
			<td>
				<?php
					echo $user['User']['name'].'@'.$this->HTML->link($user['User']['username'], 
						array(
							'controller'=>'tweets',
							'action'=>'profile',
							$user['User']['id']));
					echo '<br>';
					echo $formatted_text.'&nbsp;';
					echo '<br>';
					echo '<font color="blue">'.$formatted_time.'</font>';
				?>
				<div id="delete">
				<?php
					echo $this->Form->postlink('Unfollow',
						array(
							'controller'=>'followers',
							'action'=>'unfollow',
							$user['Follower']['id']),
						array(
							'confirm'=>'Do you really want to unfollow this person?')
						);
				?>
				</div>
			</td>
		</tr>

		<?php endforeach;?>

	</table>
	<?php include 'pagination.ctp';?>
	
	<?php 
		}

		else{
			echo '<font color="red"> No results found </font>';
		}
	?>

</div>