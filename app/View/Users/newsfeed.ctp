<?php
	include 'header.ctp';
	echo $this->Html->script('jquery', FALSE);
?>
<div id="sending" style="display: none; background-color:lightgreen;">Tweeting...</div>

<div id="tweet">
<?php
	echo $this->Form->create('Tweet');
	echo $this->Form->input('tweet');
	echo 'Let your followers know what you are doing right now. Write something within 140 words and Tweet...';
	echo $this->Js->submit('Tweet',array(
		'before'=>$this->Js->get('#sending')->effect('fadeIn'),
		'success'=>$this->Js->get('#sending')->effect('fadeOut'),
		'update'=>'#body'
		));
	echo $this->Form->end();
?>
</div>
	
<div id="body">

	<div id="sidebar">
	<?php include 'sidebar.ctp';?>
	</div>
			
	<div id="feed">

		<?php	
			if(!empty($feed)){
		?>

		<table id="t01">

		<?php foreach ($feed as $user) :?>

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
					echo $user['User']['name'].'@'.$this->HTML->link($user['User']['username'], array('controller'=>'tweets','action'=>'profile',$user['User']['id'])).'<br>'.$formatted_text.'&nbsp;'.'<br>'.'<font color="blue">'.$formatted_time.'</font>';
						if($user['User']['id']==AuthComponent::user('id')){
							echo '<div id="delete">';
							echo $this->Form->postlink('Delete',array('controller'=>'tweets','action'=>'delete',$user['Tweet']['id']),array('confirm'=>'Do you really want to delete this tweet?'));
							echo '</div>';
						}
				?>

				</td>
			</tr>
				
		<?php endforeach;?>

		</table>

		<?php include 'pagination.ctp';?>
		
		<?php
			}
			else{
				echo '<font color="grey"> Recents tweets made by you and your friends will appear here </font>';
			}
		?>
	</div>
	
</div>