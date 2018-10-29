<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainingProposalModuleRepository;
use Xolens\PgLaratraining\App\Repository\TrainerRepository;
use Xolens\PgLaratraining\App\Repository\TrainingModuleRepository;
use Xolens\PgLaratraining\App\Repository\TrainingProposalRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainingProposalModuleRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainerRepo;
    protected $trainingProposalRepo;
    protected $trainingModuleRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainingProposalModuleRepository();
        $this->trainerRepo = new TrainerRepository();
        $this->trainingProposalRepo = new TrainingProposalRepository();
        $this->trainingModuleRepo = new TrainingModuleRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
        $trainingProposalId = $this->trainingProposalRepo->model()::inRandomOrder()->first()->id;
        $trainingModuleId = $this->trainingModuleRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "trainer_id" => $trainerId,
            "training_proposal_id" => $trainingProposalId,
            "training_module_id" => $trainingModuleId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id');
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
            $trainingProposalId = $this->trainingProposalRepo->model()::inRandomOrder()->first()->id;
            $trainingModuleId = $this->trainingModuleRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "trainer_id" => $trainerId,
                "training_proposal_id" => $trainingProposalId,
                "training_module_id" => $trainingModuleId, 
                ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
