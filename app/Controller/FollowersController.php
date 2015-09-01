<?php

	class FollowersController extends AppController{

		public $components=array('Session','Paginator');
		public $paginate=array(
			'limit'=>10
			);

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
			$this->Session->setFlash(__("Unfollow successful!"));
			return $this->redirect(array('controller'=>'users','action'=>'newsfeed'));
		}


		//follower action: loads a list of people that are following a particular logged on user
		public function follower(){
			$id=AuthComponent::user('id');
			$this->loadModel('User');
			$this->loadModel('Tweet');

			$this->Paginator->settings = array(
		        'conditions'=>array('User.id'=>$this->Follower->getFolloweridList($id)),
		        'limit' => 10
		    );
		    $feed = $this->Paginator->paginate('User');
		    $this->set('followers',$feed);

			$this->setSidebarData($id);
		}

		//following action: loads a list of people that a particular user is following
		public function following(){
			$id=AuthComponent::user('id');
			$this->loadModel('Tweet');

			$this->Paginator->settings = array(
		        'conditions'=>array('Follower.follower_user_id'=>AuthComponent::user('id')),
		        'limit' => 10
		    );
		    $feed = $this->Paginator->paginate('Follower');
		    $this->set('followees',$feed);

			$tweet_result=$this->Tweet->find('all',array('conditions'=>array('Tweet.user_id'=>$this->Follower->getFolloweeidList($id))));
			$this->set('tweets',$tweet_result);

			$this->setSidebarData($id);
		}

		public function setSidebarData($id){
			$this->set('tweet_count', $this->Tweet->getTweetCount($id));
			$this->set('following_count', $this->Follower->getFollowingCount($id));
			$this->set('follower_count',$this->Follower->getFollowerCount($id));
		}
}