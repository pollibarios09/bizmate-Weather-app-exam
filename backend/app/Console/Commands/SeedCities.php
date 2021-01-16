<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Coordinate;
use Illuminate\Console\Command;
use App\Utilities\ModelHelper\CityModelHelper;
use App\Utilities\ModelHelper\ModelHelperManager;
use App\Utilities\ModelHelper\CoodinateModelHelper;

class SeedCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:city {country?} {json_filename?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var App\Utilities\ModelHelperManager
     */
    private $cityModelHelper;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        ModelHelperManager $modelHelperManager
    )
    {
        $this->modelHelperManager = $modelHelperManager;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $country = $this->argument('country') ?? 'JP';
        $filename = $this->argument('json_filename') ?? '\city.list.json';

        $cityList = collect(json_decode(file_get_contents(public_path() . $filename), true))->where('country', $country);

        foreach ($cityList as $city) {
            $cityCreated = City::create(
                $this->modelHelperManager
                    ->init(CityModelHelper::class)
                    ->prepareParameter($city)
            );
            
            $coordinate = $city['coord'];
            // add city_id comming from created city.
            $coordinate['city_id'] = $cityCreated->id;

            Coordinate::create(
                $this->modelHelperManager
                    ->init(CoodinateModelHelper::class)
                    ->prepareParameter($coordinate)
            );
        }
    }
}
