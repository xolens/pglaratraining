<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainingProposalLevelRepository;
use Xolens\PgLaratraining\App\Repository\TrainingProposalRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainingProposalLevelRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainingProposalRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainingProposalLevelRepository();
        $this->trainingProposalRepo = new TrainingProposalRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainingProposalId = $this->trainingProposalRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "name" => "name".$i,
            "duration" => 7*$i,
            "registration_fees" => 76300*$i,
            "training_fees" => 350*$i,
            "training_capacity" => 67*$i,
            "description" => "description".$i,
            "training_proposal_id" => $trainingProposalId,
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
                $trainingProposalId = $this->trainingProposalRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "name" => "name".$i,
                "duration" => 7*$i,
                "registration_fees" => 76300*$i,
                "training_fees" => 350*$i,
                "training_capacity" => 67*$i,
                "description" => "description".$i,
            "training_proposal_id" => $trainingProposalId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
