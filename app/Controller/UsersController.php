<?php
	
	class UsersController extends AppController{

		public $components=array('Session');

		//Unlocked pages before login
		public function beforeFilter(){
			$this->Auth->allow('index');
			$this->Auth->allow('register');
		}


		//index action: load the universal homepage of the website given no one is logged in.
		//if someone is logged in, it redirects to the corresponding user's homepage/newsfeed page
		public function index(){
			if($this->Auth->login()){
					return $this->redirect(array('action'=>'newsfeed'));
				}
		}


		//login action: generic login action to log a particular user in
		public function login(){
			if($this->Auth->login()){
					return $this->redirect(array('action'=>'newsfeed'));
				}

			else if($this->request->is('post')){
				if($this->Auth->login()){
					return $this->redirect(array('action'=>'newsfeed'));
				}
				else{
					$this->Session->setFlash(__("Invalid username/password"));
				}
			}
		}


		//logout action: generic logout action, redirects to the universal homepage
		//after logout
		public function logout(){
			$this->Auth->logout();
			$this->redirect('/users/index');
		}


		//register action: user to sign up a new user. redirects to the login page
		//after successful signup
		public function register(){

			if($this->Auth->login()){
					return $this->redirect(array('action'=>'newsfeed'));
				}

			else if($this->request->is('post')){
				$this->User->create();
				$this->request->data['User']['password']=AuthComponent::password($this->request->data['User']['password']);
				$this->request->data['User']['datetime']=date("Y-m-d H:i:s");
				if($this->User->save($this->request->data)){
					$this->Session->setFlash(__("Registration Successful!"));
					return $this->redirect(array('action'=>'login'));
				}
				else{
					$this->Session->setFlash(__("Registration Failed, Try again"));
				}
			}
		}


		//tweet action: Utilizes Tweet model to register a new tweet 
		//on the Tweet table on behalf of the logged in user.
		public function tweet(){
			
			$this->loadModel('Tweet');
			if($this->request->is('post')){
				$this->Tweet->create();
				$this->request->data['Tweet']['user_id']=AuthComponent::user('id');
				$this->request->data['Tweet']['tweet']=$this->request->data['User']['tweet'];
				$this->request->data['Tweet']['datetime']=date("Y-m-d H:i:s");
				if($this->Tweet->save($this->request->data)){
					$this->Session->setFlash(__("Tweeting Successful!", 'element_name', array('class'=>'error'), 'location_key'));
					return $this->redirect(array('controller'=>'users', 'action'=>'newsfeed'));
				}
				else{
					$this->Session->setFlash(__("Twizzing Failed, Try again"));
				}
			}
		}


		//newsfeed action: Responsible for tweeting from homepage and populating the homepage 
		//with followed people and user's own tweets
		public function newsfeed(){
			$this->loadModel('Tweet');
			$this->loadModel('Follower');
			$id=AuthComponent::user('id');

			$data=$this->User->findById($id);
			$this->set('user_details',$data);

			$followers=$this->Follower->find('all',array('conditions' => array('Follower.follower_user_id' => $id)));
			$followers_id=array();
			array_push($followers_id,$id);

			foreach ($followers as $result):
				array_push($followers_id,$result['Follower']['followee_user_id']);
			endforeach;

			$feed=$this->Tweet->find('all', array('conditions'=>array('Tweet.user_id'=>$followers_id)));
			$this->set('feed',$feed);
			
			$tweet_count = $this->Tweet->find('count', array('conditions' => array('Tweet.user_id' => $id)));
			$this->set('tweet_count',$tweet_count);
			
			$following_count = $this->Follower->find('count', array('conditions' => array('Follower.follower_user_id' => $id)));
			$this->set('following_count',$following_count);

			$follower_count=$this->Follower->find('count', array('conditions' => array('Follower.followee_user_id' => $id)));
			$this->set('follower_count',$follower_count);
		}


		//search action: Provides search functionality to find a user
		public function search(){
			if($this->request->is('post')){
				$search_name=$this->request->data['User']['search'];
				$this->set('search_name',$search_name);

				$search_result=$this->User->find('all',array('conditions'=>array('User.name LIKE'=>'%'.$search_name.'%',),'order' => array('User.datetime' => 'desc')));
				$this->set('search_result',$search_result);
			}
		}

	}