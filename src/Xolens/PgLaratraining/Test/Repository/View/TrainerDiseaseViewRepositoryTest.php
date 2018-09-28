<?php

namespace Xolens\PgLaratraining\Test\View\Repository;

use Xolens\PgLaratraining\App\Repository\View\TrainerDiseaseViewRepository;
use Xolens\LarautilContract\App\Util\Model\Sorter;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\PgLaratraining\Test\ReadOnlyTestPgLaratrainingBase;

final class TrainerDiseaseViewRepositoryTest extends ReadOnlyTestPgLaratrainingBase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate');
        $repo = new TrainerDiseaseViewRepository();
        $this->repo = $repo;
    }

    public function generateSorter(){
        $sorter = new Sorter();
        $sorter->asc('id');
                //->asc('name');
        return $sorter;
    }

    public function generateFilterer(){
        $filterer = new Filterer();
        $filterer->between('id',[0,14]);
                //->like('name','%tab%');
        return $filterer;
    }
}
