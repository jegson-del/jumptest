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
    // Added argument for Api Ur and option for paginated page number {?page}
    protected $signature = 'consume:api {url} {--page=}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = '_This allows you consume external api ';


    /**
     * Create a new command instance.
     *
     * @return
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

//      Using try catch all error

        try {
            $page = $this->option('page');
            $url = $this->argument('url');

            // Taking Api Url Here

            $response = $externalApiService->consumeUrl($url, $page);

            //Decode the data from HTTP response

            $httpRes = json_decode($response);

            //This calls the  modelCollection service class passing in new instance of user model

            $model = new User;
            $modelCollectionService->modelCollection($model, $httpRes);

        }catch (\Exception $e){
            $this->error($e->getMessage());
            exit('Oops!!! please check url is correct');
        }

        //This echo out the stored user table in terminal

         $headers = ['ID','FirstName','LastName','Email','Avatar'];
         $users = User::Select('id','first_name','last_name','email','avatar')->get();
         $this->table($headers,$users);

         $this->info('Api successfully stored ');
         return 0;
    }
}
