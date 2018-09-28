<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainerHandicapRepository;
use Xolens\PgLaratraining\App\Repository\TrainerRepository;
use Xolens\PgLaratraining\App\Repository\HandicapRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainerHandicapRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainerRepo;
    protected $handicapRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainerHandicapRepository();
        $this->trainerRepo = new TrainerRepository();
        $this->handicapRepo = new HandicapRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
        $handicapId = $this->handicapRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "description" => "description".$i,
            "handicap_year" => $i,
            "trainer_id" => $trainerId,
            "handicap_id" => $handicapId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id')
                ->asc('description');
        return $sorter;
    }

    public function generateFilterer(){
        $filterer = new Filterer();
        $filterer->between('id',[0,14]);
        return $filterer;
    }

    public function generateItems($toGenerateCount){
        $count = $this->repository()->count()->response();
        $generatedItemsId = [];
        
        for($i=$count; $i<($toGenerateCount+$count); $i++){
                $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
                $handicapId = $this->handicapRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "description" => "description".$i,
                "handicap_year" => $i,
            "trainer_id" => $trainerId,
            "handicap_id" => $handicapId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
