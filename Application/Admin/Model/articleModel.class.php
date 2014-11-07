<?php
namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel
{
    protected $tableName="cn_article";
    //自动完成
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );
    //自动验证
    protected $_validate = array(
        array('title', 'require', '{%article_title_empty}'),
    );
    //关联关系
    protected $_link = array(
        'cate' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'base_info',
            'foreign_key' => 'Class_ID',
           // 'relation_key'=>"Class_ID",
           // 'mapping_name'=>'auto_id',
           // 'as_fields '=>"cate_name",
        )
    );
    public function addtime()
    {
        return date("Y-m-d H:i:s",time());
    }
}