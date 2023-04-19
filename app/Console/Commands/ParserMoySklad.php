<?php

namespace App\Console\Commands;

use App\Facades\MoySklad_1_2_Facade;
use App\Models\Log;
use App\Services\MoySkladParserService;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Carbon;

class ParserMoySklad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:parser';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $categories;
    protected $products;
    protected $assortment;

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
     */
    public function handle(MoySkladParserService $moySkladParserService)
    {
        $log = Log::create([
            'start' => Carbon::now(),
            'status' => 0,
            'total_record' => count(MoySklad_1_2_Facade::getProducts()),
        ]);

        $moySkladParserService->storeCategory();

        $moySkladParserService->storeAssortment();

       $moySkladParserService->storeProducts($log);

       $moySkladParserService->storeModifiers();

        $log->finish = Carbon::now();
        $log->save();

    }

}

