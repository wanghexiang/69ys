<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="/69ys/Public/static/admin/css/admin/style.css" />
	<title><?php echo L('website_manage');?></title>
	<script>
	var URL = '/69ys/index.php/Admin/Article';
	var SELF = '/69ys/index.php?m=Admin&c=article&a=edit&A_ID=2400&menuid=155';
	var ROOT_PATH = '/69ys';
	var APP	 =	 '/69ys/index.php';
	//语言项目
	var lang = new Object();
	<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
	</script>
</head>

<body>
<div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div>
<?php if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!empty($big_menu)): ?><a class="add fb J_showdialog" href="javascript:void(0);" data-uri="<?php echo ($big_menu["iframe"]); ?>" data-title="<?php echo ($big_menu["title"]); ?>" data-id="<?php echo ($big_menu["id"]); ?>" data-width="<?php echo ($big_menu["width"]); ?>" data-height="<?php echo ($big_menu["height"]); ?>"><em><?php echo ($big_menu["title"]); ?></em></a>　<?php endif; ?>
        <?php if(!empty($sub_menu)): if(is_array($sub_menu)): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key; if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo U($val['module_name'].'/'.$val['action_name'],array('menuid'=>$menuid)); echo ($val["data"]); ?>" class="<?php echo ($val["class"]); ?>"><em><?php echo L($val['name']);?></em></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
</div><?php endif; ?>
<form id="info_form" action="<?php echo u('article/edit');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		<ul class="J_tabs tab_but cu_li">
			<li class="current"><?php echo L('article_basic');?></li>
			<li><?php echo L('article_seo');?></li>
		</ul>
		<div class="J_panes">
			<div class="content_list pad_10">
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="120"><?php echo L('article_cateid');?> :</th>
						<td><select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('article_cate/ajax_getchilds');?>" data-selected="<?php echo ($selected_ids); ?>"></select>
                			<input type="hidden" name="cate_id" id="J_cate_id" value="<?php echo ($info["cate_id"]); ?>" /></td>
					</tr>
		            <tr>
						<th><?php echo L('article_title');?> :</th>
						<td>
		                    <input type="text" name="title" id="J_title" rel="title_color" class="input-text iColorPicker" size="60" value="<?php echo ($info["title"]); ?>" style="color:<?php echo ($info["colors"]); ?>">
		                    <input type="hidden" value="<?php echo ($info["colors"]); ?>" name="colors" id="title_color">
					        <a href="javascript:;" class="color_picker_btn"><img class="J_color_picker" data-it="J_title" data-ic="J_color" src="__STATIC__/images/color.png"></a>
		                </td>
					</tr>
		            <tr>
						<th><?php echo L('tag');?> :</th>
						<td>
		                	<input type="text" name="tags" id="J_tags" class="input-text" size="50" value="<?php echo ($info["tags"]); ?>">
		                    <input type="button" value="<?php echo L('auto_get');?>" id="J_gettags" name="tags_btn" class="btn">
		                </td>
					</tr>
		            <tr>
						<th><?php echo L('author');?> :</th>
						<td><input type="text" name="author" class="input-text" size="30" value="<?php echo ($info["author"]); ?>"></td>
					</tr>
		            <tr>
						<th><?php echo L('article_img');?> :</th>
						<td>
                        <?php if(!empty($info['img'])): ?><span class="attachment_icon J_attachment_icon" file-type="image" file-rel="<?php echo ($img_dir); echo ($info["img"]); ?>"><img src="<?php echo ($img_dir); echo ($info["img"]); ?>" width="100" height="100" /></span><br /><?php endif; ?>
                        <input type="file" name="img" class="input-text"  style="width:200px;" />
                        </td>
		 			</tr>
					<tr>
						<th><?php echo L('publish');?> :</th>
		 				<td>
		                	<label><input type="radio" name="status" class="radio_style" value="1" <?php if($info["status"] == '1'): ?>checked="checked"<?php endif; ?>> <?php echo L('yes');?></label>&nbsp;&nbsp;
							<label><input type="radio" name="status" class="radio_style" value="0" <?php if($info["status"] == '0'): ?>checked="checked"<?php endif; ?>> <?php echo L('no');?></label>
						</td>
					</tr>
                    <tr>
						<th width="120"><?php echo L('article_abst');?> :</th>
						<td><textarea name="intro" id="abst" style="width:68%;height:50px;resize:none;"><?php echo ($info["intro"]); ?></textarea></td>
					</tr>
		            <tr>
		                <th>详细内容 :</th>
						<td><textarea name="info" id="info" style="width:80%;height:400px;visibility:hidden;resize:none;"><?php echo ($info["info"]); ?></textarea></td>
					</tr>
				</table>
			</div>
			<div class="content_list pad_10 hidden">
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="120"><?php echo L('seo_title');?> :</th>
		 				<td><input type="text" name="seo_title" id="seo_title" class="input-text" size="60" value="<?php echo ($info["seo_title"]); ?>"></td>
					</tr>
					<tr>
						<th><?php echo L('seo_keys');?> :</th>
						<td><input type="text" name="seo_keys" id="seo_keys" class="input-text" size="60" value="<?php echo ($info["seo_keys"]); ?>"></td>
					</tr>
					<tr>
						<th><?php echo L('seo_desc');?> :</th>
						<td><textarea name="seo_desc" id="seo_desc" cols="80" rows="8"><?php echo ($info["seo_desc"]); ?></textarea></td>
					</tr>
				</table>
			</div>
        </div>
		<div class="mt10"><input type="submit" value="<?php echo L('submit');?>" id="dosubmit" name="dosubmit" class="btn btn_submit" style="margin:0 0 10px 100px;"><br /><br /><br /></div>
	</div>
</div>
<input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/>
<input type="hidden" name="id" id="id" value="<?php echo ($info["id"]); ?>" />
</form>
<script type="text/javascript" src="/69ys/Public/static/admin/js/jquery/jquery.js"></script>
<script type="text/javascript" src="/69ys/Public/static/admin/js/jquery/plugins/jquery.tools.min.js"></script>
<script type="text/javascript" src="/69ys/Public/static/admin/js/jquery/plugins/formvalidator.js"></script>
<script type="text/javascript" src="/69ys/Public/static/admin/js/pinphp.js"></script>
<script type="text/javascript" src="/69ys/Public/static/admin/js/admin.js"></script>
<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>

<?php if(isset($list_table)): ?><script type="text/javascript" src="/69ys/Public/static/admin/js/jquery/plugins/listTable.js"></script>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>
<script src="__STATIC__/js/jquery/plugins/iColorPicker.js"></script>
<script src="__STATIC__/js/jquery/plugins/colorpicker.js"></script>
<script src="__STATIC__/js/kindeditor/kindeditor-min.js"></script>
<script>
$('.J_cate_select').cate_select('请选择');
$(function() {
	KindEditor.create('#info', {
		uploadJson : '<?php echo U("attachment/editer_upload");?>',
		fileManagerJson : '<?php echo U("attachment/editer_manager");?>',
		allowFileManager : true
	});
	$('ul.J_tabs').tabs('div.J_panes > div');
	
	//颜色选择器
	$('.J_color_picker').colorpicker();
	//自动获取标签
	$('#J_gettags').live('click', function() {
		var title = $.trim($('#J_title').val());
		if(title == ''){
			$.pinphp.tip({content:lang.article_title_isempty, icon:'alert'});
			return false;
		}
		$.getJSON('<?php echo U("article/ajax_gettags");?>', {title:title}, function(result){
			if(result.status == 1){
				$('#J_tags').val(result.data);
			}else{
				$.pinphp.tip({content:result.msg});
			}
		});
	});
});
</script>
</body>
</html>