<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainingProposalRepository;
use Xolens\PgLaratraining\App\Repository\TrainingCenterRepository;
use Xolens\PgLaratraining\App\Repository\TrainingSpecialityRepository;
use Xolens\PgLaratraining\App\Repository\TrainingTypeRepository;
use Xolens\PgLaratraining\App\Repository\TrainingDegreeRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainingProposalRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $trainingCenterRepo;
    protected $trainingSpecialityRepo;
    protected $trainingTypeRepo;
    protected $trainingDegreeRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainingProposalRepository();
        $this->trainingCenterRepo = new TrainingCenterRepository();
        $this->trainingSpecialityRepo = new TrainingSpecialityRepository();
        $this->trainingTypeRepo = new TrainingTypeRepository();
        $this->trainingDegreeRepo = new TrainingDegreeRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $trainingCenterId = $this->trainingCenterRepo->model()::inRandomOrder()->first()->id;
        $trainingSpecialityId = $this->trainingSpecialityRepo->model()::inRandomOrder()->first()->id;
        $trainingTypeId = $this->trainingTypeRepo->model()::inRandomOrder()->first()->id;
        $trainingDegreeId = $this->trainingDegreeRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "name" => "name".$i,
            "total_fees" => 524300*$i,
            "total_duration" => 8*$i,
            "year" => 200+$i,
            "description" => "description".$i,
            "training_center_id" => $trainingCenterId,
            "training_speciality_id" => $trainingSpecialityId,
            "training_type_id" => $trainingTypeId,
            "training_degree_id" => $trainingDegreeId,
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
                $trainingSpecialityId = $this->trainingSpecialityRepo->model()::inRandomOrder()->first()->id;
                $trainingTypeId = $this->trainingTypeRepo->model()::inRandomOrder()->first()->id;
                $trainingDegreeId = $this->trainingDegreeRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "name" => "name".$i,
                "total_fees" => 524300*$i,
                "total_duration" => 8*$i,
                "year" => 200+$i,
                "description" => "description".$i,
                "training_center_id" => $trainingCenterId,
                "training_speciality_id" => $trainingSpecialityId,
                "training_type_id" => $trainingTypeId,
                "training_degree_id" => $trainingDegreeId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
