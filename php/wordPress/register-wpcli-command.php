1. download scaffold package
	# wp package install git@github.com:wp-cli/scaffold-package-command.git

2. Use the Package to create a basic command in ~.wp_cli/packages
	# wp scaffold package 'cubetech/commandname'

<?php
// only execute when we are in cli mode
if (! class_exists('WP_CLI')) {
	return;
}

class DBbReset {
	/**
	*  Create a DB-Dump in wp-content/ct-dump/base-db-dump.sql
	*/
	public function createDump()
		{
			$config = $this->getconfig();
			if (!file_exists($config->path)) {
				exec('mkdir ' . $config->path);
			}
			WP_CLI::runcommand('db export ' . $config->path . $config->file);
			WP_CLI::success('Created Database-Dump in ' . $config->path . $config->file);
		}
	/**
	* Resets the installation
	*/
	public function resetInstallation()
		{
		$config = $this->getConfig();
		if (!file_exists($config->path . $config->file)) {
			WP_CLI::error('No basedump found. Run "wp ct create-dump" and try again');
			return 0;
		}

		WP_CLI::runcommand('db import ' . $config->path . $config->file);
		WP_CLI::success("Database successfully reseted");

		//send mail
		//reset media
		//delete cache?
		//reset plugin / theme files?
	}

}

