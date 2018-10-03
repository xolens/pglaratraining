<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\StudentRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class StudentRepositoryTest extends WritableTestPgLaratrainingBase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new StudentRepository();
        $this->repo = $repo;
    }

    /**
     * @test
     */
    public function test_make(){
        $i = rand(0, 10000);
        $item = $this->repository()->make([
            "matricule" => "matricule".$i,
            "email" => "email".$i."@test.com",
            "name" => "name".$i,
            "gender" => $i%2==0?'M':'F',
            "birth_date" => "10-10-201".$i,
            "birth_place" => "birth_place".$i,
            "phone1" => "phone1".$i,
            "phone2" => "phone2".$i,
            "person_to_contact" => "person_to_contact".$i,
            "person_to_contact_description" => "person_to_contact_description".$i,
            "person_to_contact_phone_1" => "person_to_contact_phone_1".$i,
            "person_to_contact_phone_2" => "person_to_contact_phone_2".$i,
            "description" => "description".$i,
        ]);
        $this->assertTrue(true);
    }
    
    /** HELPERS FUNCTIONS --------------------------------------------- **/

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id')
                ->asc('matricule');
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
            $item = $this->repository()->create([
                "matricule" => "matricule".$i,
                "email" => "email".$i."@test.com",
                "name" => "name".$i,
                "gender" => $i%2==0?'M':'F',
                "birth_date" => "10-10-201".$i,
                "birth_place" => "birth_place".$i,
                "phone1" => "phone1".$i,
                "phone2" => "phone2".$i,
                "person_to_contact" => "person_to_contact".$i,
                "person_to_contact_description" => "person_to_contact_description".$i,
                "person_to_contact_phone_1" => "person_to_contact_phone_1".$i,
                "person_to_contact_phone_2" => "person_to_contact_phone_2".$i,
                "description" => "description".$i,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
