<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\StudentSubscriptionRepository;
use Xolens\PgLaratraining\App\Repository\StudentRepository;
use Xolens\PgLaratraining\App\Repository\ScholarshipRepository;
use Xolens\PgLaratraining\App\Repository\TrainingProposalRepository;
use Xolens\PgLarautil\App\Util\Model\Sorter;
use Xolens\PgLarautil\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class StudentSubscriptionRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $studentRepo;
    protected $scholarshipRepo;
    protected $trainingProposalRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new StudentSubscriptionRepository();
        $this->studentRepo = new StudentRepository();
        $this->scholarshipRepo = new ScholarshipRepository();
        $this->trainingProposalRepo = new TrainingProposalRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $studentId = $this->studentRepo->model()::inRandomOrder()->first()->id;
        $scholarshipId = $this->scholarshipRepo->model()::inRandomOrder()->first()->id;
        $trainingProposalId = $this->trainingProposalRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            //"subscription_state" => "subscription_state".$i,
            "student_id" => $studentId,
            "scholarship_id" => $scholarshipId,
            "training_proposal_id" => $trainingProposalId,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id')
                ->asc('subscription_state');
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
                $studentId = $this->studentRepo->model()::inRandomOrder()->first()->id;
                $scholarshipId = $this->scholarshipRepo->model()::inRandomOrder()->first()->id;
                $trainingProposalId = $this->trainingProposalRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
            //"subscription_state" => "subscription_state".$i,
            "student_id" => $studentId,
            "scholarship_id" => $scholarshipId,
            "training_proposal_id" => $trainingProposalId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
