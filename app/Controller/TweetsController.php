<?php
	
	class TweetsController extends AppController{

		public $components=array('Session','Paginator');
		public $paginate=array(
			'limit'=>10
		);

		//add action: adds a tweet in the tweet table, associated with the currently logged in user
		public function add(){
			if($this->request->is('post')){
				$this->Tweet->create();
				$this->request->data['Tweet']['user_id']=AuthComponent::user('id');
				if($this->Tweet->save($this->request->data)){
					return $this->redirect(array('controller'=>'users', 'action'=>'newsfeed'));
				}
				else{
					$this->Session->setFlash(__("Twizzing Failed, Try again"));
				}
			}
		}

		//deletes tweets of a logged in user
		public function delete($id){
			$this->Tweet->id=$id;
			$this->Tweet->delete();
			$this->Session->setFlash(__("Tweet successfully deleted"));
			return $this->redirect(array('controller'=>'users','action'=>'newsfeed'));
		}

		//profile action: displays the profile of a particular user given the user id
		public function profile($id){
			$this->loadModel('User');
			$this->loadModel('Follower');
			$username=$this->User->find('first', array('conditions' => array('User.id' => $id)));
			
			$this->set('username',$username);

			$this->Paginator->settings = array(
				'conditions' => array('Tweet.user_id' => $id),
		        'limit' => 10
		    );

		    $feed = $this->Paginator->paginate('Tweet');
		    $this->set('tweets',$feed);			

		}
	}