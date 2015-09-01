<div id="body">
	<div id="sidebar">
	<?php include 'sidebar.ctp';?>
	</div>

    <div id="feed">
  		<?php 
  			if(isset($message)){
  				echo $message;
  			}
  		?>      
		<table id="t01">
		<?php foreach ($data as $user) : ?> 
		<?php
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
		?>
		
		<tr>
			<td>
				<?php 
				echo $user['User']['name'].'@'.$this->HTML->link($user['User']['username'], array('controller'=>'tweets','action'=>'profile',$user['User']['id'])).
				'<br>'
				.$formatted_text.'&nbsp;'.
				'<br>'
				.'<font color="blue">'.$formatted_time.'</font>';
				if($user['User']['id']==AuthComponent::user('id')){
					echo '<div id="delete">';
					echo $this->Form->postlink('Delete',array('controller'=>'tweets','action'=>'delete',$user['Tweet']['id']),array('confirm'=>'Do you really want to delete this tweet?'));
					echo '</div>';
				}
				?>

			</td>

		</tr>

		<?php endforeach?>

		</table>
		
		<?php
			echo 'Pages: ';

			echo $this->Paginator->prev(
			  '<Previous',
			  array(),
			  null,
			  array('class' => 'prev disabled')
			);

			//echo $this->Paginator->numbers();
			echo '|';

			echo $this->Paginator->next(
				'Next>' , 
				array(), 
				null, 
				array('class' => 'next disabled')
			);

		?>
</div>
</div>		