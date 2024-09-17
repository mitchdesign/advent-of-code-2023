<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Validation\Validator;

class Day extends Command
{
    protected $signature = 'day {day} {puzzle}';

    protected $description = 'Run puzzle 1 or 2 for a particular day';

	public function handle(): int
    {
		$validator = $this->getValidator();

		if ($validator->fails()) {
			$this->showErrors($validator);
			return 1;
		}

		$this->line('Running puzzle');
		$this->newLine();

		$this->line($validator->getValue('day'));
	    $this->line($validator->getValue('puzzle'));

		return 0;
    }

	public function getValidator(): Validator
	{
		return validator(
			$this->arguments(),
			[
				'day' => 'required|integer|min:1',
				'puzzle' => 'required|integer|between:1,2',
			]
		);
	}

	public function showErrors(Validator $validator): void
	{
		foreach ($validator->errors()->all() as $error) {
			$this->error($error);
		}
	}
}
