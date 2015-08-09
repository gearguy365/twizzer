<?php
	
	class UsersController extends AppController{

		public $helpers=array('Js');
		public $components=array('Session','Paginator','RequestHandler');
		public $paginate=array(
			'limit'=>10
			);

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

		//newsfeed action: Responsible for populating various fields on the homepage and post tweets dynamically
		public function newsfeed(){
			$this->loadModel('Tweet');
			$this->loadModel('Follower');
			$id=AuthComponent::user('id');

			if(!empty($this->data)){
				
				$this->request->data['Tweet']['user_id']=$id;
				$this->request->data['Tweet']['datetime']=date("Y-m-d H:i:s");
				if($this->Tweet->save($this->data)){
					if($this->RequestHandler->isAjax()){
						$this->set('data',$this->data);
						$this->render('success','ajax');
					}
					else{
						$this->Session->setFlash(_("Tweeting Successful!"));
						return $this->redirect(array('controller'=>'users', 'action'=>'newsfeed'));
					}
				}
				else{
					$this->Session->setFlash(_("Tweeting Failed, Try again"));
				}
			}

			$data=$this->User->findById($id);
			$this->set('user_details',$data);

			$followers=$this->Follower->find('all',array('conditions' => array('Follower.follower_user_id' => $id)));
			$followers_id=array();
			array_push($followers_id,$id);

			foreach ($followers as $result):
				array_push($followers_id,$result['Follower']['followee_user_id']);
			endforeach;

			$this->Paginator->settings = array(
		        'conditions' => array('Tweet.user_id' => $followers_id),
		        'limit' => 10
		    );
		    $feed = $this->Paginator->paginate('Tweet');
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