<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加品牌 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="brandList.html">商品品牌</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加品牌 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="<?php echo U('brandEdit');?>"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称</td>
                <td>
                    <input type="hidden" value="<?php echo ($brand_data["id"]); ?>" name="id">
                    <input type="text" name="brand_name" maxlength="60" value="<?php echo ($brand_data["brand_name"]); ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <?php if(is_array($cate_all)): foreach($cate_all as $k=>$d): ?><tr>
                <td class="label">所属分类</td>
                <td>
                    <select name="cate_id" >
                        <option  value="">请选择</option>
                        <?php if(is_array($d)): foreach($d as $key=>$dd): ?><option  value="<?php echo ($dd["id"]); ?>"  <?php if($cate_data[$k][id] == $dd[id]): ?>selected<?php endif; ?>><?php echo ($dd["cate_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr><?php endforeach; endif; ?>
            <tr class="brand_url">
                <td class="label">品牌网址</td>
                <td>
                    <input type="text" name="brand_url" maxlength="60" size="40" value="<?php echo ($brand_data["brand_url"]); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type="file" name="brand_logo" id="logo" size="45"><br/>
                    <span class="notice-span" style="display:block"  id="warn_brandlogo">请上传图片，做为品牌的LOGO！</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌描述</td>
                <td>
                    <textarea  name="brand_description" cols="60" rows="4"  ><?php echo ($brand_data["brand_description"]); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="brand_sort" maxlength="40" size="15" value="50" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="brand_status" value="1" checked="checked" /> 是
                    <input type="radio" name="brand_status" value="0"  /> 否(当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌。)
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
<script>
    $(function(){
        $('table tr').find('select').live('change',function(){
            //选择前删除该行后面之前新添加的行
            $(this).parents('tr').nextUntil('.brand_url').remove();
            _this=$(this);
            id=$(this).val();
            $.post('<?php echo U("brand/sendAjax");?>',{'id':id},function(data){
                if(data!=''){
                    option= '<tr class="add_tr"><td class="label">下一级</td><td><select name="cate_id">';
                    option+='<option value="">请选择</option>'
                    for(var i=0;i < data.length;i++){
                        option+='<option value="'+data[i].id+'">'+data[i].cate_name+'</option>';
                    }
                    option+='</select></td></tr>';
                    _this.parents('tr').after(option);
                }

            },'json')

        })
    })

</script>
</body>
</html>