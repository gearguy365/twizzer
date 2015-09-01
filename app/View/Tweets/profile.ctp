<?php
	include 'header.ctp';

	$isfollowed=0;
	$follow_id=0;

	foreach ($username['Follower'] as $follower):
		if($follower['follower_user_id']==AuthComponent::user('id')){
			$isfollowed=1;
			$follow_id=$follower['id'];
		}
	endforeach;
?>

<div id="user_info">
	
	<h1><?php echo $username['User']['name']; ?></h1>
	<br>
	<font size="3px"><?php echo '@'.$username['User']['username']; ?> </font>
	
	<div id="follow_button">

	<?php
		if($username['User']['id']!=AuthComponent::user('id')){

			if($isfollowed==0){
				echo $this->Html->image("/app/webroot/img/follow-button.png", array( 'url' => array('controller' => 'followers', 'action' => 'follow', $username['User']['id'])));
			}
			else if($isfollowed==1){

				echo $this->Html->link($this->Html->image('/app/webroot/img/unfollow-button.png'),
								 array(
		                            'controller' => 'followers',
		                            'action' => 'unfollow',
		                            $follow_id
		                            ), 
								 array(
		                            'escape' => false,
		                            'confirm' => 'Are you sure you want to unfollow?'
		                            )
								);
			}
		}
	?>

	</div>

</div>


<div id="tweet_records">
	<table id="t01">

		<?php foreach ($tweets as $tweet) : ?>
		
		<tr>
			<td>
			<?php 
				$formatted_tweet=$this->Text->autoLinkUrls($tweet['Tweet']['tweet']);
				$datetime=$tweet['Tweet']['datetime'];
				$tweetid=$tweet['Tweet']['id'];
				$username=$tweet['User']['username'];
				$userid=$tweet['User']['id'];



				echo $this->HTML->link($username, array('controller'=>'tweets','action'=>'profile',$userid)).'&nbsp;'.$formatted_tweet;
				echo '<br>';
				echo 'posted at '.'<font color="blue">'.$datetime.'</font>';

				if($userid==AuthComponent::user('id')){
					echo '<div id="delete">';
					echo $this->Form->postlink('Delete',array('controller'=>'tweets','action'=>'delete',$tweetid),array('confirm'=>'Do you really want to delete this tweet?'));
					echo '</div>';
				}
			?>
		    </td>
		</tr>

		<?php endforeach ?>

	</table>

	<?php
		include 'pagination.ctp';
	?>
</div>
