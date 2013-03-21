<?php


class DNBranch extends ViewableData {

	/**
	 *
	 * @var Gitonomy\Git\Reference\Branch
	 */
	protected $branch = null;

	protected $project = null;

	protected $data = null;

	protected $name = null;

	protected $references = null;
	
	/**
	 *
	 * @param Gitonomy\Git\Commit $commit
	 * @param DNProject $project
	 * @param DNData $data
	 */
	public function __construct(Gitonomy\Git\Reference\Branch $branch, DNProject $project, DNData $data) {
		$this->branch = $branch;
		$this->project = $project;
		$this->data = $data;
	}

	/**
	 *
	 * @return type
	 */
	public function Name() {
		return $this->branch->getName();
	}

	/**
	 * Provides a DNBuildList of builds found in this project.
	 */
	function DNBuildList() {
		$blockBranch = $this->branch->getName() == 'master' ? null : 'master';
		return new DNReferenceList($this->project, $this->data, $this->branch, $blockBranch);
	}

	/**
	 *
	 * @return SS_Datetime 
	 */
	public function LastUpdated() {
		$created = $this->branch->getCommit()->getCommitterDate();

		$d = new SS_Datetime();
		$d->setValue($created->format('Y-m-d H:i:s'));
		return $d;
	}

}