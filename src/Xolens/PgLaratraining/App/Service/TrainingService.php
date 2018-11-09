<?php

namespace Xolens\PgLaratraining\App\Service;

use Illuminate\Support\Facades\DB;
use Xolens\LarautilContract\App\Repository\RepositoryResponse;

use PglarapollCreateFunctionCreateSelectInvestigationValuesQuery;

use PgLaratrainingCreateTableTrainingCenters;
use PgLaratrainingCreateTableTrainingSpecialities;
use PgLaratrainingCreateTableTrainingDegrees;
use PgLaratrainingCreateTableStudentDegrees;
use PgLaratrainingCreateTableTrainingTypes;
use PgLaratrainingCreateTableTrainingProposals;
use PgLaratrainingCreateTableStudents;

class TrainingService {
        
    public static function listTrainingCenter(){
        return self::returnDataResponse(DB::select(DB::raw('SELECT id, name FROM '.PgLaratrainingCreateTableTrainingCenters::table().' ORDER BY name ASC')));
    }
    
    public static function listTrainingSpeciality(){
        return self::returnDataResponse(DB::select(DB::raw('SELECT id, name FROM '.PgLaratrainingCreateTableTrainingSpecialities::table().' ORDER BY name ASC')));
    }
    
    public static function listTrainingDegree(){
        return self::returnDataResponse(DB::select(DB::raw('SELECT id, name FROM '.PgLaratrainingCreateTableTrainingDegrees::table().' ORDER BY name ASC')));
    }
    
    public static function listTrainingtype(){
        return self::returnDataResponse(DB::select(DB::raw('SELECT id, name FROM '.PgLaratrainingCreateTableTrainingTypes::table().' ORDER BY name ASC')));
    }

    public static function listProposalYear(){
        return self::returnDataResponse(DB::select(DB::raw('SELECT DISTINCT year as name, year as id FROM '.PgLaratrainingCreateTableTrainingProposals::table().' ORDER BY name DESC')));
    }

    public static function listStudentGender(){
        return self::returnDataResponse(DB::select(DB::raw('SELECT DISTINCT gender as name, gender as id FROM '.PgLaratrainingCreateTableStudents::table().' ORDER BY name ASC')));
    }


    public static function enquote($value, $quoted = true, $quote = "'"){
        if($quoted){
            return $quote.$value.$quote;
        }else{
            return $value;
        }
    }
    public static function arrayWhereCondition($colName, $val, $quoted = false){
        if(!is_array($val)&&$val != null){
            $val = [$val];
        }
        if($val == null || (is_array($val)&&count($val)==0)){
            return ' true ';
        }else{
            $condition = ' '.$colName.' in (';
            foreach ($val as $value) {
                $condition .= self::enquote($value, $quoted).', ';
            }
            $condition = rtrim($condition,',| ');
            $condition .= ') ';
            return $condition;
        }
    }
    public static function isTrue($stm){
        if($stm==' true '){
            return ' true ';
        }
        return ' false ';
    }
    
    public static function paginateFilteredStudent(array $filters, $perPage, $page, $orderProperty, $orderDirection, $likePatern = '%'){
        $orderDirection = ($orderDirection == 'ASC'?'ASC':'DESC');
        $orderProperty = ( $orderProperty == null?'id':$orderProperty );
        $orderProperty = preg_replace('/[^\w]+/','_', $orderProperty);
        
        $data = DB::select(DB::raw('
            WITH student_intersection as (
                '.self::filteredStudenQueryt($filters).'
            )
            SELECT 
                *,
                count(*) OVER() as total
            FROM
                student_intersection
            ORDER BY '.$orderProperty.' '.$orderDirection.'
            LIMIT ? OFFSET ? 
        '),[$perPage, ($page-1)*$perPage]);
        $total = 0;
        if(count($data)>0){
            $total = $data[0]->total;
        }
        return self::returnResponse([
            'total'=>$total,
            'data'=>$data,
        ]);
    }

    public static function filteredStudenByIdQueryt(array $identifiers){
        $query = '
            SELECT * FROM '.PgLaratrainingCreateTableStudents::table().'
            WHERE '.self::arrayWhereCondition('id', $identifiers).'
        ';
        return $query;
    }

    public static function filteredStudenQueryt(array $filters){
        $studentGender = $filters['student_gender'];

        $proposalYear = $filters['proposal_year'];
        $spaciality = $filters['spaciality'];
        $studentDegree = $filters['student_degree'];
        $subscriptionState = $filters['subscription_state'];
        $trainingCenter = $filters['training_center'];
        $trainingType = $filters['training_type'];

        $query = '
        (
            SELECT * FROM '.PgLaratrainingCreateTableStudents::table().'
            WHERE '.self::arrayWhereCondition('gender', $studentGender, true).'
        ) INTERSECT (
            SELECT * FROM '.PgLaratrainingCreateTableStudents::table().'
            WHERE id in ( 
                SELECT student_id FROM '.PgLaratrainingCreateTableStudentDegrees::table().' 
                WHERE '.self::arrayWhereCondition('id', $studentDegree).' 
            ) OR '.self::isTrue(self::arrayWhereCondition('id', $studentDegree)).'
        ) INTERSECT (
            WITH selected_proposal as(
                (
                    SELECT * FROM '.PgLaratrainingCreateTableTrainingProposals::table().'
                    WHERE '.self::arrayWhereCondition('year', $proposalYear).'
                    OR '.self::isTrue(self::arrayWhereCondition('year', $proposalYear)).'
                ) INTERSECT (
                    SELECT * FROM '.PgLaratrainingCreateTableTrainingProposals::table().'
                    WHERE '.self::arrayWhereCondition('training_center_id', $trainingCenter).'
                    OR '.self::isTrue(self::arrayWhereCondition('training_center_id', $trainingCenter)).'
                ) INTERSECT (
                    SELECT * FROM '.PgLaratrainingCreateTableTrainingProposals::table().'
                    WHERE '.self::arrayWhereCondition('training_speciality_id', $spaciality).'
                    OR '.self::isTrue(self::arrayWhereCondition('training_speciality_id', $spaciality)).'
                ) INTERSECT (
                    SELECT * FROM '.PgLaratrainingCreateTableTrainingProposals::table().'
                    WHERE '.self::arrayWhereCondition('training_type_id', $trainingType).'
                    OR '.self::isTrue(self::arrayWhereCondition('training_type_id', $trainingType)).'
                )
            )
            SELECT * FROM '.PgLaratrainingCreateTableStudents::table().'
            WHERE id in ( 
                select student_id from pglaratraining_student_subscriptions
                where training_proposal_id in (
                    SELECT id from selected_proposal
                ) AND (
                    '.self::arrayWhereCondition('subscription_state', $subscriptionState, true).'
                    OR '.self::isTrue(self::arrayWhereCondition('subscription_state', $subscriptionState, true)).'
                )
            ) OR (
                '.self::isTrue(self::arrayWhereCondition('year', $proposalYear)).' AND
                '.self::isTrue(self::arrayWhereCondition('training_center_id', $trainingCenter)).' AND
                '.self::isTrue(self::arrayWhereCondition('training_speciality_id', $spaciality)).' AND
                '.self::isTrue(self::arrayWhereCondition('training_type_id', $trainingType)).' AND
                '.self::isTrue(self::arrayWhereCondition('subscription_state', $subscriptionState, true)).'
            )
        )';
        return $query;
    }

    public static function returnDataResponse($response){
        $resp = new RepositoryResponse();
        $resp->setSuccess(true);
        $resp->setResponse(['data'=>$response]);
        return $resp;
    }

    public static function returnResponse($response){
        $resp = new RepositoryResponse();
        $resp->setSuccess(true);
        $resp->setResponse($response);
        return $resp;
    }
    
    public static function returnErrors($errors){
        $err = new RepositoryResponse();
        $err->setSuccess(false);
        $err->setErrors($errors);
        return $err;
    }
}
