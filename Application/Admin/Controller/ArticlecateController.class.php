<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BackendController;
class ArticlecateController extends backendController {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('articlecate');
    }

    public function index() {
        $sort = I("sort", '', 'trim');
        $order =I("order", 'asc', 'trim');
        $tree = new \Common\Lib\Tree();
        $tree->icon = array('│ ','├─ ','└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $result = $this->_mod->order("auto_id asc")->select();
       // exit();
        $array = array();
        foreach($result as $r) {
            $r['str_img'] = $r['img_icon'] ? '<div class="img_border"><img src="'.attach($r['img_icon'], 'article_cate').'" width="26" height="26" class="J_preview" data-bimg="'.attach($r['img_icon'], 'article_cate').'"/></div>' : '';
            $r['str_status'] = '<img data-tdtype="toggle" data-id="'.$r['auto_id'].'" data-field="status" data-value="'.$r['status'].'" src="__PUBLIC__/static/admin/images/admin/toggle_' . ($r['status'] == 0 ? 'disabled' : 'enabled') . '.gif" />';
            $r['str_manage'] = '<a href="javascript:;" class="J_showdialog" data-uri="'.U('articlecate/add',array('pid'=>$r['auto_id'])).'" data-title="'.L('add_article_cate').'" data-id="add" data-width="500" data-height="360">'.L('add_article_subcate').'</a> |
                                <a href="javascript:;" class="J_showdialog" data-uri="'.U('articlecate/edit',array('id'=>$r['auto_id'])).'" data-title="'.L('edit').' - '. $r['name'] .'" data-id="edit" data-width="500" data-height="360">'.L('edit').'</a> |
                                <a href="javascript:;" data-acttype="ajax" class="J_confirmurl" data-uri="'.U('articlecate/delete',array('id'=>$r['auto_id'])).'" data-msg="'.sprintf(L('confirm_delete_one'),$r['name']).'">'.L('delete').'</a>';
            $r['parentid_node'] = ($r['parent_id'])? ' class="child-of-node-'.$r['parent_id'].'"' : '';
            $r['cate_type'] = $r['type'] ? '<span class="blue">'.L('article_cate_type_'.$r['type']).'</span>' : L('article_cate_type_'.$r['type']);
            $array[] = $r;
        }
        $str  = "<tr id='node-\$id' \$parentid_node>
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td>\$spacer<span data-tdtype='edit' data-field='name' data-id='\$id' class='tdedit'>\$name</span></td>
                <td align='center'>\$id</td>
                <td align='center'>\$cate_type</td>
                <td align='center'>\$str_img</td>
                <td align='center'><span data-tdtype='edit' data-field='ordid' data-id='\$id' class='tdedit'>\$ordid</span></td>

                <td align='center'>\$str_status</td>
                <td align='center'>\$str_manage</td>
                </tr>";
        $tree->init($array);
        $list = $tree->get_tree(0, $str);
        $this->assign('list', $list);
        //bigmenu (标题，地址，弹窗ID，宽，高)
        $big_menu = array(
            'title' => L('add_article_cate'),
            'iframe' => U('articlecate/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '360'
        );
        $this->assign('big_menu', $big_menu);
        $this->assign('list_table', true);
        $this->display();
    }

    /**
     * 添加子菜单上级默认选中本栏目
     */
    public function _before_add() {
        $pid = $this->_get('parent_id', 'intval', 0);
        if ($pid) {
            $spid = $this->_mod->where(array('auto_id'=>$pid))->getField('full_path');
            $spid = $spid ? $spid.$pid : $pid;
            $this->assign('full_path', $spid);
        }
    }

    /**
     * 入库数据整理
     */
    protected function _before_insert($data = '') {
        //检测分类是否存在
        if($this->_mod->name_exists($data['b_name'], $data['parent_id'])){
            $this->ajaxReturn(0, L('article_cate_already_exists'));
        }
        //生成spid
        $data['full_path'] = $this->_mod->get_spid($data['full_path']);
        return $data;
    }

    /**
     * 修改提交对数据
     */
    protected function _before_update($data = '') {
        if ($this->_mod->name_exists($data['b_name'], $data['parent_id'], $data['auto_id'])) {
            $this->ajaxReturn(0, L('article_cate_already_exists'));
        }
        $old_pid = $this->_mod->field('img,pid')->where(array('id'=>$data['id']))->find();
        if ($data['parent_id'] != $old_pid['parent_id']) {
            //不能把自己放到自己或者自己的子目录们下面
            $wp_spid_arr = $this->_mod->get_child_ids($data['auto_id'], true);
            if (in_array($data['parent_id'], $wp_spid_arr)) {
                $this->ajaxReturn(0, L('cannot_move_to_child'));
            }
            //重新生成spid
            $data['full_path'] = $this->_mod->get_spid($data['pid']);
        }
        return $data;
    }

    public function ajax_upload_img() {
        //上传图片
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'article_cate', array('width'=>'80', 'height'=>'80'));
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
                $ext = array_pop(explode('.', $result['info'][0]['savename']));
                $data['img'] = str_replace('.' . $ext, '_thumb.' . $ext, $result['info'][0]['savename']);
                $this->ajaxReturn(1, L('operation_success'), $data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

    public function ajax_getchilds() {
        $id = I('id', "",'intval');
        $return = $this->_mod->field('auto_id as id,b_name as name')->where(array('parent_id'=>$id))->select();
        if ($return) {
            $this->ajaxReturn(1, L('operation_success'), $return);
        } else {
            $this->ajaxReturn(0, L('operation_failure'));
        }
    }
}