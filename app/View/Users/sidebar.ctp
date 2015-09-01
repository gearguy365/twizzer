<p><?php echo AuthComponent::user('username');?></p>

<p>
<?php
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
		echo 'Tweets '.$this->HTML->link($tweet_count,array('controller'=>'tweets','action'=>'profile',AuthComponent::user('id')));
	}
	else{
		echo 'Tweet 0';
	}
?>
</p>