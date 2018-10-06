<?php

namespace Xolens\PgLaratraining\App\Repository\View;

use Xolens\PgLaratraining\App\Model\View\TrainingProposalLevelModuleView;
use Xolens\PgLaratraining\App\Model\TrainingProposalLevelModule;
use Xolens\LaratrainingContract\App\Repository\View\Contract\TrainingProposalLevelModuleViewRepositoryContract;
use Xolens\PgLarautil\App\Repository\AbstractReadableRepository;
use Xolens\LarautilContract\App\Util\Model\Filterer;
use Xolens\LarautilContract\App\Util\Model\Sorter;


class TrainingProposalLevelModuleViewRepository extends AbstractReadableRepository implements TrainingProposalLevelModuleViewRepositoryContract
{
    public function model(){
        return TrainingProposalLevelModuleView::class;
    }
    
    public function paginateByTrainer($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINER_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }

    public function paginateByTrainerSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINER_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainerFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINER_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainerSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINER_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }

    public function paginateByTrainingProposalLevel($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_PROPOSAL_LEVEL_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }    
    
    public function paginateByTrainingProposalLevelSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_PROPOSAL_LEVEL_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainingProposalLevelFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_PROPOSAL_LEVEL_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainingProposalLevelSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_PROPOSAL_LEVEL_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }

    public function paginateByTrainingModule($parentId, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_MODULE_PROPERTY, $parentId);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }    
    
    public function paginateByTrainingModuleSorted($parentId, Sorter $sorter, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_MODULE_PROPERTY, $parentId);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainingModuleFiltered($parentId, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_MODULE_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateFiltered($parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
    public function paginateByTrainingModuleSortedFiltered($parentId, Sorter $sorter, Filterer $filterer, $perPage=50, $page = null,  $columns = ['*'], $pageName = 'page'){
        $parentFilterer = new Filterer();
        $parentFilterer->equals(TrainingProposalLevelModule::TRAINING_MODULE_PROPERTY, $parentId);
        $parentFilterer->and($filterer);
        return $this->paginateSortedFiltered($sorter, $parentFilterer, $perPage, $page,  $columns, $pageName);
    }
    
}
