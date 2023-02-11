<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User ;
class GenerateTokenForAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:genesis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate token for all users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users =  User::all() ;
        foreach ($users as $user)
        {
            if ($user->api_token == null)
            {
                $user->api_token = Str::random(60) ;
                $user->save() ;
            }
        }
    }
}
