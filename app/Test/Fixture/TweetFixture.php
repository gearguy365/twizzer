<?php
/**
 * TweetFixture
 *
 */
class TweetFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'unsigned' => false),
		'tweet' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 140, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'tweet' => 'Lorem ipsum dolor sit amet',
			'datetime' => '2015-07-16 08:30:05'
		),
	);

}
