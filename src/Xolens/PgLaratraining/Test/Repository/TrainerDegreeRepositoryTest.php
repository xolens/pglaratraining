<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainerDegreeRepository;
use Xolens\PgLaratraining\App\Repository\TrainingDegreeRepository;
use Xolens\PgLaratraining\App\Repository\TrainerRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\TestPgLaratrainingBase;

final class TrainerDegreeRepositoryTest extends TestPgLaratrainingBase
{
    protected $trainingDegreeRepo;
    protected $trainerRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainerDegreeRepository();
        $this->trainingDegreeRepo = new TrainingDegreeRepository();
        $this->trainerRepo = new TrainerRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainingDegreeId = $this->trainingDegreeRepo->model()::inRandomOrder()->first()->id;
        $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "issued_institute" => "issued_institute".$i,
            "issued_date" => "10-10-201".$i,
            "training_degree_id" => $trainingDegreeId,
            "trainer_id" => $trainerId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id')
                ->asc('issued_institute');
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
                $trainingDegreeId = $this->trainingDegreeRepo->model()::inRandomOrder()->first()->id;
                $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "issued_institute" => "issued_institute".$i,
                "issued_date" => "10-10-201".$i,
            "training_degree_id" => $trainingDegreeId,
            "trainer_id" => $trainerId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
