<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainingCenterConventionRepository;
use Xolens\PgLaratraining\App\Repository\TrainingCenterRepository;
use Xolens\PgLarautil\App\Util\Model\Sorter;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainingCenterConventionRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainingCenterRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainingCenterConventionRepository();
        $this->trainingCenterRepo = new TrainingCenterRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainingCenterId = $this->trainingCenterRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "name" => "name".$i,
            "type" => "type".$i,
            "description" => "description".$i,
            "training_center_id" => $trainingCenterId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id')
                ->asc('name');
        return $sorter;
    }

    public function generateFilterer(){
        $filterer = new Filterer();
        $filterer->between('id',[0,14])
                ->like('name','%tab%');
        return $filterer;
    }

    public function generateItems($toGenerateCount){
        $count = $this->repository()->count()->response();
        $generatedItemsId = [];
        
        for($i=$count; $i<($toGenerateCount+$count); $i++){
                $trainingCenterId = $this->trainingCenterRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "name" => "name".$i,
                "type" => "type".$i,
                "description" => "description".$i,
            "training_center_id" => $trainingCenterId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
