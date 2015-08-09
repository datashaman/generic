<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateIndex extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'create-index';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create index for things';

    public function getArguments()
    {
        return [];
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
        $laravel = $this->getLaravel();
        $elasticsearch = $laravel->make('elasticsearch');
        try {
            $elasticsearch->indices()->delete([ 'index' => 'generic' ]);
        } catch (\Elasticsearch\Common\Exceptions\Missing404Exception $e) {
            // Don't care
        }

        $elasticsearch->indices()->create(json_decode(file_get_contents(__DIR__.'/index.json'), true));
	}

}
