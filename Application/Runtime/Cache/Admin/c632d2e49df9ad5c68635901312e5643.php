<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/mymall/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/mymall/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <script src="/mymall/Public/Admin/Js/jquery-1.8.3.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('category/categoryAdd');?>">添加分类</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品分类 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>分类名称</th>
                <th>导航栏显示</th>
                <th>是否显示</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($cate_data)): foreach($cate_data as $key=>$d): ?><tr align="center"  class="level<?php echo ($d["level"]); ?>" rid="<?php echo ($d["id"]); ?>" pid="<?php echo ($d["cate_pid"]); ?>">
                <td align="left" class="first-cell" >
                    <?php echo (str_repeat('&nbsp;',$d["level"]*8)); ?><img src="/mymall/Public/Admin/Images/menu_minus.gif" width="9" height="9" border="0" style="margin-left:0em" />
                <span><a href="javascript:void(0)"><?php echo ($d["cate_name"]); ?></a></span>
                </td>

                <td width="15%"><img src="/mymall/Public/Admin/Images/<?php if($d["is_show"] == 1): ?>yes.gif <?php else: ?>no.gif<?php endif; ?>" /></td>
                <td width="15%"><img src="/mymall/Public/Admin/Images/<?php if($d["cate_status"] == 1): ?>yes.gif<?php else: ?>no.gif<?php endif; ?>"  /></td>
                <td width="15%" align="center"><span><?php echo ($d["cate_sort"]); ?></span></td>
                <td width="30%" align="center">
                <a href="<?php echo U('categoryEdit','cate_id='.$d[id]);?>">编辑</a> |
                <a href="javascript:void(0);" title="移除" class="remove"  data-id="<?php echo ($d["id"]); ?>">移除</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </table>
    </div>
</form>
<div id="footer">
共执行 1 个查询，用时 0.055904 秒，Gzip 已禁用，内存占用 2.202 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<script>
    $(function(){

        $('tr').find('.first-cell').live('click',function(){
            rid=$(this).parents('tr').attr('rid');
            $('#list-table tr[pid='+rid+']').toggle();
            confirm();
        })
        function confirm(){
            $('#list-table tr').each(function(){
                _this=$(this);
                if(_this.is(':hidden')==true){
                    rid=_this.attr('rid');
                    _this.each(function(){
                        $('#list-table tr[pid='+rid+']').hide();
                    })
                }
            })

            $('tr:visible').each(function(){
                _this=$(this);
                a=0;
                rid=$(this).attr('rid');
                $('tr:hidden').each(function(){
                    if($(this).attr('pid')==rid){
                        a=1;
                        return false;
                    }
                })
                if(a==1){
                    _this.find('img:first').attr('src','/mymall/Public/Admin/Images/menu_plus.gif');
                }else{
                    _this.find('img:first').attr('src','/mymall/Public/Admin/Images/menu_minus.gif');
                }
            })
        }

        // 移除该行的分类
        $('.remove').live('click',function(){
            _this=$(this);
            id=$(this).attr('data-id');
            $.post('<?php echo U("category/categoryDel");?>',{'id':id},function(data){
//                console.log(data);
                if(data.status==0){
                    alert(data.info);
                }else{
                    _this.parents('tr').remove();
                }
            },'json')
        })
    })
</script>
</body>
</html>