<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainerDegreeView;
use Xolens\PgLaratraining\App\Model\TrainerDegree;
use Xolens\LaratrainingContract\App\Contract\Repository\View\TrainerDegreeViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\LarautilContract\App\Util\Model\Sorter;


class TrainerDegreeViewRepository extends AbstractReadableRepository implements TrainerDegreeViewRepositoryContract
{
    public function model(){
        return TrainerDegreeView::class;
    }
    
    public function paginateByTrainer($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINER_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }

    public function paginateByTrainerSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINER_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainerFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINER_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainerSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINER_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }

    public function paginateByDegree($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINING_DEGREE_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }    
    
    public function paginateByDegreeSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINING_DEGREE_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByDegreeFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINING_DEGREE_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByDegreeSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainerDegree::TRAINING_DEGREE_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
}
