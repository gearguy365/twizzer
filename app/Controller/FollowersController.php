<?php

	class FollowersController extends AppController{

		public $components=array('Session');

		//follow action: creates a following relationship among two users
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

		public function unfollow($id){
			$this->Follower->id=$id;
			$this->Follower->delete();
			return $this->redirect(array('controller'=>'users','action'=>'newsfeed'));
		}


		//follower action: loads a list of people that are following a particular logged on user
		public function follower(){
			$this->loadModel('User');
			$search_result=$this->Follower->find('all',array('conditions'=>array('Follower.followee_user_id'=>AuthComponent::user('id'))));
			$people=array();
			$this->set('data',$search_result);

			foreach ($search_result as $result):
				array_push($people,$result['Follower']['follower_user_id']);
			endforeach;		

			$people_result=$this->User->find('all',array('conditions'=>array('User.id'=>$people)));
			$this->set('people',$people_result);

			$user_count=$this->Follower->find('count',array('conditions'=>array('Follower.followee_user_id'=>AuthComponent::user('id'))));
			$this->set('user_count',$user_count);

		}

		//following action: loads a list of people that a particular user is following
		public function following(){
			$this->loadModel('Tweet');
			$search_result;
			$people=array();

			$search_result=$this->Follower->find('all',array('conditions'=>array('Follower.follower_user_id'=>AuthComponent::user('id'))));
				$this->set('followees',$search_result);

				foreach ($search_result as $result):
					array_push($people,$result['Follower']['followee_user_id']);
				endforeach;

				$tweet_result=$this->Tweet->find('all',array('conditions'=>array('Tweet.user_id'=>$people)));
				$user_count=$this->Follower->find('count',array('conditions'=>array('Follower.follower_user_id'=>AuthComponent::user('id'))));
				$this->set('user_count',$user_count);	
			    $this->set('tweets',$tweet_result);
		}
}