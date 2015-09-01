<?php
App::uses('AppModel', 'Model');
/**
 * Follower Model
 *
 * @property FollowerUser $FollowerUser
 */
class Follower extends AppModel {

	public $components=array('Paginator');
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'follower_user_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'followee_user_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'followee_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function getFollowingCount($id){
		$following_count = $this->find('count', array('conditions' => array('follower_user_id' => $id)));
		return $following_count;
	}

	public function getFollowerCount($id){
		$follower_count=$this->find('count', array('conditions' => array('followee_user_id' => $id)));
		return $follower_count;
	}

	public function getFolloweeidList($id){
		$followees=$this->find('all',array('conditions' => array('follower_user_id' => $id)));
		$followees_id=array();
		//array_push($followees_id,$id);

		foreach ($followees as $result):
			array_push($followees_id, $result['Follower']['followee_user_id']);
		endforeach;
		return $followees_id;
	}

	public function getFolloweridList($id){
		$followers=$this->find('all',array('conditions'=> array('followee_user_id'=>$id)));
		$followers_id=array();
		
		foreach ($followers as $result):
			array_push($followers_id, $result['Follower']['follower_user_id']);
		endforeach;	
		return $followers_id;
	}

	public function getFolloweeList($id){
		$search_result=$this->find('all',array('conditions'=>array('follower_user_id'=>$id)));
		return $search_result;
	}
}
