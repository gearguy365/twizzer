<?php
	
	class UsersController extends AppController{

		public $helpers=array('Js', 'Paginator');
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


		//logout action: generic logout action, redirects to the universal homepage after logout
		public function logout(){
			$this->Auth->logout();
			$this->redirect('/users/index');
		}


		//register action: used to sign up a new user. redirects to the login page after successful signup
		public function register(){

			if($this->Auth->login()){
				return $this->redirect(array('action'=>'newsfeed'));
			}

			else if($this->request->is('post')){
				$this->User->create();
				$this->request->data['User']['password']=AuthComponent::password($this->request->data['User']['password']);
				$this->request->data['User']['datetime']=date("Y-m-d H:i:s");

				$username=$this->request->data['User']['username'];
				if($this->User->checkUsername($username)){
					if($this->User->save($this->request->data)){
						$this->Session->setFlash(__("Registration Successful!"));
						return $this->redirect(array('action'=>'login'));
					}
					else{
						$this->Session->setFlash(__("Registration Failed, Try again"));
					}
				}
				else{
					$this->Session->setFlash(__("Username already in use"));
				}
			}
		}

		public function newsfeed(){

			$this->loadModel('Tweet');
			$this->loadModel('Follower');
			$id=AuthComponent::user('id');

			//accepting tweets
			if(!empty($this->request->data)){
				$this->autoRender = FALSE;

				if(($this->request->data['Tweet']['tweet'])!=null){
					$this->request->data['Tweet']['user_id']=$id;
					$this->request->data['Tweet']['datetime']=date("Y-m-d H:i:s");
					$this->Tweet->save($this->data);	
				}

				else{
					$this->set('message','You cant make an empty tweet');
				}
				$this->set('data',$this->getFeedData());
				$this->setSidebarData($id);
				$this->render('feed','ajax');
			}

			//code block that generates mixed tweet list for newsfeed
			$followee_list = $this->Follower->getFolloweeidList($id);
			array_push($followee_list,$id);
			
			$this->Paginator->settings = array(
		        'conditions' => array('Tweet.user_id' => $followee_list),
		        'limit' => 10
		    );
		    $feed = $this->Paginator->paginate('Tweet');
		    $this->set('feed',$feed);

		    //code that sets the user informations for the sidebar
		    $this->setSidebarData($id);
		}

		//search action: Provides search functionality to find a user
		public function search(){
			if($this->request->is('post')){
				if($this->request->data['User']['search']!=null){
					$search_name=$this->request->data['User']['search'];
					$this->Paginator->settings = array(
		        		'conditions'=>array('User.name LIKE'=>'%'.$search_name.'%'),
		        		'order' => array('User.datetime' => 'desc'),
		        		'limit' => 10
		    		);

		    		$feed = $this->Paginator->paginate('User');
		    		$this->set('search_result',$feed);
				}
				
				else{
					$this->Session->setFlash(__("Cant make an empty search"));
					return $this->redirect(array('action'=>'search'));
				}
			}
		}

		public function getFeedData(){
			$this->loadModel('Tweet');
			$this->loadModel('Follower');
			$id=AuthComponent::user('id');

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
		    return $feed;
		}

		public function setSidebarData($id){
			$this->set('tweet_count', $this->Tweet->getTweetCount($id));
			$this->set('following_count', $this->Follower->getFollowingCount($id));
			$this->set('follower_count',$this->Follower->getFollowerCount($id));
		}
	}