<?php

namespace App\Providers;

use App\Services\Macros;
use Collective\Html\HtmlServiceProvider;
use Collective\Html\FormBuilder;

/**
 * Class MacroServiceProvider
 * @package App\Providers
 */
class MacroServiceProvider extends HtmlServiceProvider
{

    public function register()
    {
        parent::register();
		FormBuilder::macro('selectJob', function ($name, $selected = null, $jobs, $options = array())
		{
			$array_job = array(); 
			foreach($jobs as $job){
				$array_job = $array_job + array($job->id => $job->name);
			}
			return $this->select($name, $array_job, $selected, $options);
  		});
  		FormBuilder::macro('decimalInput', function ($name, $selected = null, $jobs, $options = array())
		{
			$array_job = array(); 
			foreach($jobs as $job){
				$array_job = $array_job + array($job->id => $job->name);
			}
			return $this->select($name, $array_job, $selected, $options);
  		});
    }

}