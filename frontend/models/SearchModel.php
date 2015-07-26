<?php
namespace frontend\models;

use yii\base\Model;
use yii\db\Query;

/**
 * Password reset request form
 */
class SearchModel extends Model
{
    public $name;

    public $preview_text;

    public $seourl;

    public $image;

    protected $_query_string = false;

    public function rules()
    {
        return [
            [['name', 'preview_text', 'seourl', 'image'], 'string'],
        ];
    }


    public function find($string){
        $this->_query_string = $string;
        return $this;
    }

    protected function _prepareQuery(){
        if(!$this->_query_string){
            throw new \Exception("Error query string cannot be empty");
        }

        $q = $this->_query_string;

        $queryArticle = new Query();
        $queryArticle->select('name, preview_text, seourl, image')
                      ->from('article')
                      ->where(['like', 'name', $q])
                      ->orWhere(['like', 'preview_text',$q])
                      ->orWhere(['like', 'detail_text', $q])
                      ->orWhere(['like', 'soc_text', $q])
                      ->orWhere(['like', 'title', $q])
                      ->limit(10);


        $queryStructure = new Query();
        $queryStructure->select('label AS name, description AS preview_text, seourl, image')
                    ->from('structure')
                    ->where(['is_dir'=>0])
                    ->andWhere(['or', ['like', 'label',$q], ['like', 'content', $q], ['like', 'info', $q], ['like', 'title', $q]])
                    ->limit(10);

        $queryArticle->union($queryStructure);


        return $queryArticle;

    }

    /**
     * 
     */
    public function getAllModels()
    {
       $result = [];

       $query = $this->_prepareQuery();

       foreach($query->each() as $row){

            $model = new SearchModel();

            $model->attributes = $row;

            $result[] = $model;

       }

       return $result;
    }
}
