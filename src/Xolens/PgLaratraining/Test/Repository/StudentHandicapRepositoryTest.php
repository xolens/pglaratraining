<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\StudentHandicapRepository;
use Xolens\PgLaratraining\App\Repository\StudentRepository;
use Xolens\PgLaratraining\App\Repository\HandicapRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class StudentHandicapRepositoryTest extends WritableTestPgLaratrainingBase
{
    protected $studentRepo;
    protected $handicapRepo;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new StudentHandicapRepository();
        $this->studentRepo = new StudentRepository();
        $this->handicapRepo = new HandicapRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $studentId = $this->studentRepo->model()::inRandomOrder()->first()->id;
        $handicapId = $this->handicapRepo->model()::inRandomOrder()->first()->id;
        $item = $this->repository()->make([
            "description" => "description".$i,
            "handicap_year" => $i,
            "student_id" => $studentId,
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
                $studentId = $this->studentRepo->model()::inRandomOrder()->first()->id;
                $handicapId = $this->handicapRepo->model()::inRandomOrder()->first()->id;
            $item = $this->repository()->create([
                "description" => "description".$i,
                "handicap_year" => $i,
            "student_id" => $studentId,
            "handicap_id" => $handicapId,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
