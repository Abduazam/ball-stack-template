<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('clear:livewire-temp')->dailyAt('01:00')->runInBackground();;
Schedule::command('delete:import-file')->dailyAt('01:00')->runInBackground();;
