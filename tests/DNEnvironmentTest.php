<?php
/**
 * 
 */
class DNEnvironmentTest extends SapphireTest {
	
	/**
	 *
	 * @var DNEnvironment 
	 */
	protected $env = null;
	
	/**
	 *
	 * @var DNProject
	 */
	protected $project = null;
	
	/**
	 *
	 * @var type 
	 */
	protected $envPath = '';
	
	/**
	 * 
	 */
	public function setUp() {
		
		$this->envPath = '/tmp/deploynaut_test/envs';
		Config::inst()->update('Injector', 'DNData', array(
			'constructor' => array(
				0 => '/tmp/deploynaut_test/builds',
				1 => $this->envPath,
				2 => '/tmp/deploynaut_test/gitkeys',
			) 
		));
		
		parent::setUp();
		$this->project = new DNProject();
		$this->project->Name = 'testproject';
		$this->project->write();
		$this->env = new DNEnvironment();
		$this->env->Name = 'uat';
		$this->env->ProjectID = $this->project->ID;
		$this->env->write();
	}
	
	/**
	 * 
	 */
	public function testGetConfigFilename() {
		$expected = $this->envPath.'/testproject/uat.rb';
		$this->assertEquals($expected, $this->env->getConfigFilename());
	}
}