<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\ExternalApiService;
use App\Services\ModelCollectionService;
use Illuminate\Console\Command;




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
    public function handle(ModelCollectionService $modelCollectionService, ExternalApiService $externalApiService)
    {

        //This ask Api Url Input

        $url = $this->ask('Please input api url here:');

        //Validates Url Input

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error("INVALID API URL. Exiting........");
            return 1;
        }

        //here we added the page number as options

        $page = $this->option('?page');

        // Taking Api Url Here

        $response = $externalApiService->consumeUrl($url, $page);

        //Decode the data from HTTP response

        $httpRes = json_decode($response);


        //This calls the  modelCollection service class passing in new instance of user model

        $model = new User;
        $modelCollectionService->modelCollection( $model , $httpRes);

        //This echo out the stored user table in terminal

         $headers = ['ID','FirstName', 'LastName','Email','Avatar'];
         $users = User::Select('id','first_name','last_name','email','avatar')->get();
         $this->table($headers,$users);

         $this->info('Api successfully stored ');
         return 0;
    }
}
