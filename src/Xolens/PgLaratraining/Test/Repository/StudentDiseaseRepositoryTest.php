<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\StudentDiseaseRepository;
use Xolens\PgLaratraining\App\Repository\StudentRepository;
use Xolens\PgLaratraining\App\Repository\DiseaseRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class StudentDiseaseRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $studentRepo;
    protected $diseaseRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new StudentDiseaseRepository();
        $this->studentRepo = new StudentRepository();
        $this->diseaseRepo = new DiseaseRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $studentId = $this->studentRepo->model()::inRandomOrder()->first()->id;
        $diseaseId = $this->diseaseRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "description" => "description".$i,
            "student_id" => $studentId,
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
                $studentId = $this->studentRepo->model()::inRandomOrder()->first()->id;
                $diseaseId = $this->diseaseRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "description" => "description".$i,
            "student_id" => $studentId,
            "disease_id" => $diseaseId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
