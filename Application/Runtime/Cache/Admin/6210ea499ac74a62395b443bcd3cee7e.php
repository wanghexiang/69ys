<?php if (!defined('THINK_PATH')) exit();?><div id="admin_map" class="J_lmenu dialog_content">
	<table class="table_map">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
			<th align="center"><?php echo L($val['name']);?></th>
			<td>
				<table class="table_map_sub">
					<?php if(isset($val['sub'])): if(is_array($val['sub'])): $i = 0; $__LIST__ = $val['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sval): $mod = ($i % 2 );++$i;?><tr>
						<th><?php echo L($sval['name']);?></th>
						<td>
						<?php if(isset($sval['sub'])): if(is_array($sval['sub'])): $i = 0; $__LIST__ = $sval['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ssval): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);" data-id="<?php echo ($ssval["id"]); ?>" data-uri="<?php echo U($ssval['module_name'].'/'.$ssval['action_name'],array('menuid'=>$ssval['id'])); echo ($ssval["data"]); ?>"><?php echo L($ssval['name']);?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</table>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
</div>