<?php

namespace Xolens\PgLaratraining\Test\Repository;

use Xolens\PgLaratraining\App\Repository\TrainingCenterRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\WritableTestPgLaratrainingBase;

final class TrainingCenterRepositoryTest extends WritableTestPgLaratrainingBase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainingCenterRepository();
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
            "sigle" => "sigle".$i,
            "mailbox_number" => "mailbox_number".$i,
            "mailbox_city" => "mailbox_city".$i,
            "phone1" => "phone1".$i,
            "phone2" => "phone2".$i,
            "website" => "website".$i,
            "creation_year" => $i,
            "creation_order_number" => "creation_order_number".$i,
            "creation_order_date" => "10-10-201".$i,
            "opening_year" => $i,
            "promoter_name" => "promoter_name".$i,
            "promoter_gender" => $i%2==0?'M':'F',
            "local_array" => $i,
            "local_title" => $i>3,
            "local_property" => "local_property".$i,
            "manager_name" => "manager_name".$i,
            "center_type" => "center_type".$i,
            "center_order" => "center_order".$i,
            "approval_date" => "10-10-201".$i,
            "approval_order_number" => "approval_order_number".$i,
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
                "sigle" => "sigle".$i,
                "mailbox_number" => "mailbox_number".$i,
                "mailbox_city" => "mailbox_city".$i,
                "phone1" => "phone1".$i,
                "phone2" => "phone2".$i,
                "website" => "website".$i,
                "creation_year" => $i,
                "creation_order_number" => "creation_order_number".$i,
                "creation_order_date" => "10-10-201".$i,
                "opening_year" => $i,
                "promoter_name" => "promoter_name".$i,
                "promoter_gender" => $i%2==0?'M':'F',
                "local_array" => $i,
                "local_title" => $i>3,
                "local_property" => "local_property".$i,
                "manager_name" => "manager_name".$i,
                "center_type" => "center_type".$i,
                "center_order" => "center_order".$i,
                "approval_date" => "10-10-201".$i,
                "approval_order_number" => "approval_order_number".$i,
                "description" => "description".$i,
            ]);
            $generatedItemsId[] = $item->response()->id;
        }
        $this->assertEquals(count($generatedItemsId), $toGenerateCount);
        return $generatedItemsId;
    }
}   
