<?php

class Stash_sledgehammer_ext {

	var $name               = 'Stash Sledgehammer';
	var $version            = '1.0';
	var $description        = 'Delete the stash cache when entries are updated';
	var $settings_exist     = 'n';
	var $docs_url           = '';

	var $settings           = array();

	/**
	 * Constructor
	 *
	 * @param       mixed   Settings array or empty string if none exist.
	 */
	function __construct($settings = '')
	{
		$this->EE =& get_instance();

		$this->settings = $settings;
	}

	function activate_extension()
	{
		$this->settings = array(
			'active' => 'y'
		);
		$hooks = array(
			'delete_entries_start'          => 'delete_entries_start',
			'update_multi_entries_start'    => 'update_multi_entries_start',
			'entry_submission_absolute_end' => 'entry_submission_absolute_end'
		);
		foreach ($hooks as $h => $m)
		{
			$data = array(
				'class' => __CLASS__,
				'method' => $m,
				'hook' => $h,
				'settings' => serialize($this->settings),
				'priority' => 10,
				'version' => $this->version,
				'enabled' => $this->settings['active']
			);
			$this->EE->db->insert('extensions',$data);
		}
	}

	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	function delete_entries_start() {
		$this->sledgehammer();
	}

	function update_multi_entries_start() {
		$this->sledgehammer();
	}

	function entry_submission_absolute_end($entry_id, $meta, $data, $view_url) {
		$this->sledgehammer();
	}

	function sledgehammer() {
		$this->EE->db->where('site_id', 1)->delete('stash');
	}
}
