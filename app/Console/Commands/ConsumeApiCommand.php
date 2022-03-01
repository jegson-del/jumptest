<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ConsumeApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//   Added option for paginated page number {?page}
    protected $signature = 'consume:api {--?page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '_This allows you consume external api ';


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
     * @return
     */
    public function handle()
    {
//         Validating Api Url
        $url = $this->ask('Please input api url here:');
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error("Invalid Api URL. Exiting...");
            return 1;
        }
//here we added the page number as options
        $page = $this->option('?page');
        $response = Http::get($url.$page)->body();

//Decode the data from response
         $results = json_decode($response);

//Storing  Api on database this would be moved to service  and try catch needed
        foreach ($results->data as $data){
            $user = new User;
            $user->id = $data->id;
            $user->first_name = $data->first_name;
            $user->last_name = $data->last_name;
            $user->email = $data->email;
            $user->avatar = $data->avatar;
            $user->save();
        }

         $headers = ['ID','FirstName', 'LastName','Email','Avatar'];
         $users = User::Select('id','first_name','last_name','email','avatar')->get();
         $this->table($headers,$users);

         $this->info('Api successfully stored ');
    }


}
