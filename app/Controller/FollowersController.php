<?php

	class FollowersController extends AppController{

		public $components=array('Session');


		//follow action: this takes the id of the followee and follower and creates a follow relationship
		//in the Follower model.
		public function follow($followee_id){
			$follower_id=AuthComponent::user('id');
			$this->Follower->create();
			$follow=Array(
			    "Follower" => Array(
			            "follower_user_id" => $follower_id,
			            "followee_user_id" => $followee_id
			    ));
			if($this->Follower->save($follow)){
				$this->Session->setFlash(__("You are now following this person!"));
			}
			else{
				$this->Session->setFlash(__("Following Failed!"));
			}
			return $this->redirect(array('controller'=>'users','action'=>'newsfeed'));
		}

		//unfollow action: Removes a particular following relationship between two users given the
		//id in Follower model
		public function unfollow($id){
			$this->Follower->id=$id;
			$this->Follower->delete();
			return $this->redirect(array('controller'=>'users','action'=>'newsfeed'));
		}

		//followed action: Lists either all the followers of an user, or all the people followed by a 
		//particular user. $id indicates either of the two above mentioned operations  
		public function followed($id){
			$this->loadModel('Tweet');
			$search_result;
			$people=array();

			//$id="1" means, i want to see those people who are following me. 
			if($id==1){
				$search_result=$this->Follower->find('all',array('conditions'=>array('Follower.followee_user_id'=>AuthComponent::user('id'))));
				$this->set('followees',$search_result);


				foreach ($search_result as $result):
					array_push($people,$result['Follower']['follower_user_id']);
				endforeach;

				$tweet_result=$this->Tweet->find('all',array('conditions'=>array('Tweet.user_id'=>$people)));
				$user_count=$this->Follower->find('count',array('conditions'=>array('Follower.followee_user_id'=>AuthComponent::user('id'))));
				$this->set('user_count',$user_count);	
				$this->set('type',$id);
			    $this->set('tweets',$tweet_result);
			}

			//$id="2" means, i want to see those people whom i am following.
			else if($id==2){
				$search_result=$this->Follower->find('all',array('conditions'=>array('Follower.follower_user_id'=>AuthComponent::user('id'))));
				$this->set('followees',$search_result);

				foreach ($search_result as $result):
					array_push($people,$result['Follower']['followee_user_id']);
				endforeach;

				$tweet_result=$this->Tweet->find('all',array('conditions'=>array('Tweet.user_id'=>$people)));
				$user_count=$this->Follower->find('count',array('conditions'=>array('Follower.follower_user_id'=>AuthComponent::user('id'))));
				$this->set('user_count',$user_count);	
				$this->set('type',$id);
			    $this->set('tweets',$tweet_result);
			}
			
		}
}