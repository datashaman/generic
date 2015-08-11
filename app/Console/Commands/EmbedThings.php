<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EmbedThings extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'embed-things';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Embed things';

    public function getArguments()
    {
        return [
            [ 'input', InputArgument::REQUIRED, 'Input file with JSON array of embed instructions' ],
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
        $embeds = json_decode(file_get_contents($this->argument('input')), true);

        foreach ($embeds as $embed) {
            $index = $embed['index'];
            $type = $embed['type'];
            $id = $embed['id'];

            $src = $elasticsearch->get(compact('index', 'type', 'id'));
            $body = $src['_source'];

            $value = array_get($embed, 'value');
            $values = array_get($embed, 'values');

            if (!empty($value)) {
                $response = $elasticsearch->get($value);
                $embedded = $response['_source'];
            } elseif (!empty($values)) {
                $embedded = [];
                foreach ($values as $value) {
                    $response = $elasticsearch->get($value);
                    $embedded[] = $response['_source'];
                }
            }

            array_set($body, $embed['field'], $embedded);

            $elasticsearch->index([
                'index' => $src['_index'],
                'type' => $src['_type'],
                'id' => $src['_id'],
                'body' => $body
            ]);
        }
	}

}
