<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainingProposalLevelModuleRepository;
use Xolens\PgLaratraining\App\Repository\TrainerRepository;
use Xolens\PgLaratraining\App\Repository\TrainingProposalLevelRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainingProposalLevelModuleRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainerRepo;
    protected $trainingProposalLevelRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainingProposalLevelModuleRepository();
        $this->trainerRepo = new TrainerRepository();
        $this->trainingProposalLevelRepo = new TrainingProposalLevelRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
        $trainingProposalLevelId = $this->trainingProposalLevelRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "name" => "name".$i,
            "description" => "description".$i,
            "trainer_id" => $trainerId,
            "training_proposal_level_id" => $trainingProposalLevelId,
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
                $trainerId = $this->trainerRepo->model()::inRandomOrder()->first()->id;
                $trainingProposalLevelId = $this->trainingProposalLevelRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "name" => "name".$i,
                "description" => "description".$i,
            "trainer_id" => $trainerId,
            "training_proposal_level_id" => $trainingProposalLevelId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
