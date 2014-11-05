<?php
namespace Admin\Model;
use Think\Model;
class ArticlecateModel extends Model
{
    protected $tableName="base_info";
    /**
     * 生成spid 
     * 
     * @param int $pid 父级ID
     */
    public function get_spid($pid) {
        if (!$pid) {
            return 0; 
        }
        $pspid = $this->where(array('auto_id'=>$pid))->getField('full_path');
        if ($pspid) {
            $spid = $pspid . $pid . '|';
        } else {
            $spid = $pid . '|';
        }
        return $spid;
    }
    
    /**
     * 获取分类下面的所有子分类的ID集合
     * 
     * @param int $id
     * @param bool $with_self
     * @return array $array 
     */
    public function get_child_ids($id, $with_self=false) {
        $spid = $this->where(array('auto_id'=>$id))->getField('full_path');
        $spid = $spid ? $spid .= $id .'|' : $id .'|';
        $id_arr = $this->field('auto_id')->where(array('full_path'=>array('like', $spid.'%')))->select();
        $array = array();
        foreach ($id_arr as $val) {
            $array[] = $val['auto_id'];
        }
        $with_self && $array[] = $id;
        return $array;
    }
    
    /**
     * 检测分类是否存在
     * 
     * @param string $name
     * @param int $pid
     * @param int $id
     * @return bool 
     */
    public function name_exists($name, $pid, $id=0) {
        $where = "b_name='" . $name . "' AND parent_id='" . $pid . "' AND auto_id<>'" . $id . "'";
        $result = $this->where($where)->count('auto_id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 写入缓存
     */
    public function cate_cache() {
        $artcate_list = array();
        $cate_data = $this->field('auto_id,parent_id,b_name')->where('status=1')->order('ordid')->select();
        foreach ($cate_data as $val) {
            if ($val['parent_id'] == '0') {
                $artcate_list['p'][$val['auto_id']] = $val;
            } else {
                $artcate_list['s'][$val['parent_id']][] = $val;
            }
        }
        F('artcate_list', $artcate_list);
        return $artcate_list;
    }

    /**
     * 更新则删除缓存
     */
    protected function _before_write(&$data) {
        F('artcate_list', NULL);
    }

    /**
     * 删除也删除缓存
     */
    protected function _after_delete($data, $options) {
        F('artcate_list', NULL);
    }
}