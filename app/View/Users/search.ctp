	<style>
		#user_info {
		    line-height:20px;
		    background-color:#FFFFFF;
		    width:698px;
		    float:left;
		    padding:5px;	
		    margin-top:10px;  
		    border: 1px solid black;  
		    border-radius: 5px;
		    font-size: 25px;
		}

		#feed {
			float: left;
			line-height:30px;
		    background-color:#eeeeee;
		    width:701px;
		    padding:5px;	
		    margin-top:20px; 
		    clear:both;
		    border-radius: 5px;
		}

		#tweet_records {
			float: left;
			line-height:30px;
		    background-color:#eeeeee;
		    width:701px;
		    padding:5px;	
		    margin-top:20px; 
		    clear:both;
		    border-radius: 5px;
		}
		
		th, td {
		    padding: 5px;
		    text-align: left;
		}

		table#t01 tr:nth-child(even) {
		    background-color: #eee;
		}

		table#t01 tr:nth-child(odd) {
		   background-color:#fff;
		}

	</style>

<?php
	include 'header.ctp';
	echo '<div id="feed">';
	echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'search')));
	echo $this->Form->input('search');
	echo $this->Form->end('Search');
	echo 'search by name';
	echo '</div>';

	if(isset($search_result)){
		echo '<div id="tweet_records">';
		
		if(!empty($search_result)){

			foreach ($search_result as $user) : 

				$formatted_text;
				$latest_tweet_time;
				$formatted_time;

				if(!empty($user['Tweet'])){
					$formatted_text=$this->Text->autoLinkUrls($user['Tweet']['0']['tweet']);
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
					$formatted_text='No tweets yet';
					$formatted_time='';		
				}
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