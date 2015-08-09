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

	echo '<div id="user_info">';
	echo '<h1>'.$username['User']['name'].'</h1>'.'<br>';
	echo '<font size="3px".>'.'@'.$username['User']['username'].'</font>';
	echo '<div id="follow_button">';


	if($username['User']['id']!=AuthComponent::user('id')){
		if($isfollowed==0){
			echo $this->Html->image("/app/webroot/img/follow-button.png", array( 'url' => array('controller' => 'followers', 'action' => 'follow', $username['User']['id'])));
		}
		else if($isfollowed==1){

			echo $this->Html->link($this->Html->image('/app/webroot/img/unfollow-button.png'
	                            ), array(
	                            'controller' => 'followers',
	                            'action' => 'unfollow',
	                            $follow_id
	                            ), array(
	                            'escape' => false,
	                            'confirm' => 'Are you sure you want to unfollow?'
	                            ));
		}
	}

	echo '</div>';
	echo '</div>';



	echo '<div id="tweet_records">';
	echo '<table id="t01">';
	foreach ($username['Tweet'] as $user) : 
		$formatted_text=$this->Text->autoLinkUrls($user['tweet']);
		echo'<tr>';

		echo '<td>';
		echo $this->HTML->link($username['User']['username'], array('controller'=>'tweets','action'=>'profile',$username['User']['id'])).'&nbsp;'.$formatted_text.'<br>'.'posted at '.'<font color="blue">'.$user['datetime'].'</font>';
		if($username['User']['id']==AuthComponent::user('id')){
			echo '<div id="delete">';
			echo $this->Form->postlink('Delete',array('controller'=>'tweets','action'=>'delete',$user['id']),array('confirm'=>'Do you really want to delete this tweet?'));
			echo '</div>';
		}
	    echo '</td>';
		     
		echo '</tr>';
	endforeach;
	echo'</table>';
	echo '</div>';
