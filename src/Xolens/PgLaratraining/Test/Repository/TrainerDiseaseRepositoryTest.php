<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainerDiseaseRepository;
use Xolens\PgLaratraining\App\Repository\TrainerRepository;
use Xolens\PgLaratraining\App\Repository\DiseaseRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainerDiseaseRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainerRepo;
    protected $diseaseRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainerDiseaseRepository();
        $this->trainerRepo = new TrainerRepository();
        $this->diseaseRepo = new DiseaseRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
        $diseaseId = $this->diseaseRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "description" => "description".$i,
            "trainer_id" => $trainerId,
            "disease_id" => $diseaseId,
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
                $diseaseId = $this->diseaseRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "description" => "description".$i,
            "trainer_id" => $trainerId,
            "disease_id" => $diseaseId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
