<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportThings extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'import-things';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import things';

    public function getArguments()
    {
        return [
            [ 'input', InputArgument::REQUIRED, 'Input file with JSON array of things' ],
        ];
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
        $things = json_decode(file_get_contents($this->argument('input')), true);

        foreach ($things as $thing) {
            $thing['title_raw'] = $thing['title'];
            $thing['description_raw'] = $thing['description'];
            $elasticsearch->index([ 'index' => 'generic', 'type' => 'thing', 'body' => $thing ]);
        }
	}

}
