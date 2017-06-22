<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="/index.php/Admin/Goods/goodsAdd">添加新商品</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="" name="searchForm" id="searchForm">
        <img src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="cate_id" class="allcate">
            <option value="0">所有分类</option>
            <?php if(is_array($cate_data)): foreach($cate_data as $key=>$d): ?><option value="<?php echo ($d["id"]); ?>" pid="<?php echo ($d["cate_pid"]); ?>" level="<?php echo ($d["level"]); ?>"><?php echo (str_repeat('&nbsp;',$d["level"]*3)); echo ($d["cate_name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <!-- 品牌 -->
        <select name="brand_id" class="allbrand">
            <option value="0">所有品牌</option>
            <?php if(is_array($brand_data)): foreach($brand_data as $key=>$d): ?><option value="<?php echo ($d["id"]); ?>"><?php echo ($d["brand_name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <!-- 推荐 -->
        <select name="intro_type" class="tuijian">
            <option value="0">全部</option>
            <option value="is_best">精品</option>
            <option value="is_new">新品</option>
            <option value="is_hot">热销</option>
        </select>
        <!-- 上架 -->
        <select name="is_on_sale" class="is_on_sale">
            <option value=''>全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="15" class="keyword"/>
        <input type="button" value=" 搜索 "  />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1" id="goods_list">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>货号</th>
                <th>价格</th>
                <th>上架</th>
                <th>精品</th>
                <th>新品</th>
                <th>热销</th>
                <th>推荐排序</th>
                <th>库存</th>
                <th>操作</th>
            </tr>

            <?php if(is_array($goods_data)): foreach($goods_data as $key=>$d): ?><tr>
                <td align="center"><?php echo ($d["id"]); ?></td>
                <td align="center" class="first-cell"><span><?php echo ($d["goods_name"]); ?></span></td>
                <td align="center"><span onclick=""><?php echo ($d["goods_onlynu"]); ?></span></td>
                <td align="center"><span><?php echo ($d["goods_price"]); ?></span></td>
                <td align="center" data-id="<?php echo ($d["id"]); ?>"><img class='is_show' src="<?php if(($d["is_show"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/></td>
                <td align="center"><img src="<?php if(($d["is_best"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/></td>
                <td align="center"><img src="<?php if(($d["is_new"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/></td>
                <td align="center"><img src="<?php if(($d["is_hot"] == 1)): ?>/Public/Admin/Images/yes.gif <?php else: ?> /Public/Admin/Images/no.gif<?php endif; ?>"/></td>
                <td align="center"><span><?php echo ($d["goods_sort"]); ?></span></td>
                <td align="center"><span><?php echo ($d["goods_number"]); ?></span></td>
                <td align="center">
                <a href="/index.php/Goods/?goods_id=<<?php echo ($val["goods_id"]); ?>>" target="_blank" title="查看"><img src="/Public/Admin/Images/icon_view.gif" width="16" height="16" border="0" /></a>
                <a href="__GROUP__/Goods/goodsEdit?goods_id=<<?php echo ($val["goods_id"]); ?>>" title="编辑"><img src="/Public/Admin/Images/icon_edit.gif" width="16" height="16" border="0" /></a>
                <a href="__GROUP__/Goods/goodsTrash?goods_id=<<?php echo ($val["goods_id"]); ?>>" onclick="" title="回收站"><img src="/Public/Admin/Images/icon_trash.gif" width="16" height="16" border="0" /></a></td>
            </tr><?php endforeach; endif; ?>
                <input type="hidden" value="" id="brandinfo">
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <<?php echo ($showPage); ?>>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
</form>

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 1895-2017 世界子龙网络科技有限公司(注册资本100亿)，并保留所有权利。</div>
</body>
<script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
<script>
//    tp={'ADMIN':'/Public/Admin/'};
    $(function(){
        //点击上架 下架功能
        $('.is_show').live('click',function(){
            _this=$(this);
            id=_this.parent('td').attr('data-id');
            tag=_this.attr('src').indexOf('yes');
            $.post('<?php echo U("goods/showEdit");?>',{'tag':tag,'id':id},function(data){
                if(data.status==1){
                    if(tag>0){
                        _this.attr('src',"/Public/Admin/Images/no.gif");
                    }else{
                        _this.attr('src',"/Public/Admin/Images/yes.gif");
                    }
                }
            },'json');

        })
        //选择分类搜索  动态改变 品牌搜索框中的内容
        $('.allcate').change(function(){
            _this=$(this);
            cate_id=[];
            cate_id[0]=$(this).val();
            tag=1;
           //遍历每一个Option 判断无下属分类的直接作为cate_id传递
            $(this).find('option').each(function(){
                if($(this).attr('pid')==cate_id){
                    //作为判断是否最下级的标记
                    tag=0;
                    //非最下级 则cate_id 需要用数组传递
                     cate_id=[];
                    //默认选中的对象
                    selectedObj=_this.find(':selected');
                    //选中对象的在同级中的位置
                     index=selectedObj.index();
                    //选中对象的level  即第几级目录
                     level=selectedObj.attr("level");
                    //选中对象的下级对象  要求 >index  =level
                     obj=selectedObj.nextUntil($('option:gt('+index+')[level='+level+']'));
                    //在过滤后的对象中 选择所有最下级分类 传递cate_id
                    obj.each(function(){
                        var t=1;    //判断最下级分类的标记
                        var cateId=$(this).val();
                        obj.each(function(){
                            if($(this).attr('pid')==cateId){
                                t=0;
                                return false;
                            }
                        })
                        if(t){cate_id.push(cateId);}
                    })
                    $.post('<?php echo U("goods/cateEdit");?>',{'cate_id':cate_id},function(data){
                        brandstr=getBrandId(data);
//                        $('#brandinfo').val(brandstr);
                        if(data){
                            html='<option value="0">请选择</option>';
                            for(var i=0;i < data.length;i++){
                                html+= '<option value="'+data[i].id+'">'+data[i].brand_name+'</option>';
                            }
                        }else{
                            html='<option value="0">请选择</option>';
                        }
                        $('.allbrand').html(html);
                    },'json');
                    return false;
                }
            })
            if(tag){
                $.post('<?php echo U("goods/cateEdit");?>',{'cate_id':cate_id},function(data){
                    //将传来的brand数据保存到隐藏域
                    brandstr=getBrandId(data);
//                    $('#brandinfo').val(brandstr);
                    if(data){
                        html='<option value="0">请选择</option>';
                        for(var i=0;i < data.length;i++){
                            html+= '<option value="'+data[i].id+'">'+data[i].brand_name+'</option>';
                        }
                    }else{
                        html='<option value="0">请选择</option>';
                    }
                    $('.allbrand').html(html);

                },'json');
            }

        })
            function  getBrandId(data) {
                var str='';
                for(var i in data){
                    str+=data[i].id;
                }
                return str;
            }
       //按条件搜索功能
        $('#searchForm input[type=button]').click(function(){
           //获取各项条件
//            formData=$('form').serialize();
            formdata=new Array();
            formdata['cate_id']=$('.allcate').val();
            formdata['brand_id']=$('.allbrand').val();
            formdata['tuijian']=$('.tuijian').val();
            formdata['is_show']=$('.is_on_sale').val();
            formdata['keyword']=$('.keyword').val();
            str='';
            for(i in formdata){
                str+=i+','+formdata[i]+';';
            }
//            brand=$('#brandinfo').val();
            //str 是各项选择的数据    brand 选择cate 后的所有品牌数据
            console.log(brandstr);
            $.post('<?php echo U("goods/goodsList");?>',{'str':str,'brand':brandstr},function(data){
                html='<tr><th>编号</th> <th>商品名称</th> <th>货号</th> <th>价格</th>\
<th>上架</th> <th>精品</th> <th>新品</th> <th>热销</th> <th>推荐排序</th>\
<th>库存</th> <th>操作</th> </tr>';
//                console.log(data);
                if(data!=''){
                    for(var i=0;i<data.length;i++){
                        //拼接html内容
                        html+='<tr>\
<td align="center">'+data[i].id+'</td>\
<td align="center" class="first-cell"><span>'+data[i].goods_name+'</span></td>\
<td align="center"><span>'+data[i].goods_onlynu+'</span></td>\
<td align="center"><span>'+data[i].goods_price+'</span></td>\
<td align="center" data-id="'+data[i].id+'">';
                        if(data[i].is_show==1){
                            html+='<img class="is_show" src="/Public/Admin/Images/yes.gif"/></td>';
                        }else{
                            html+='<img class="is_show" src="/Public/Admin/Images/no.gif"/></td>';
                        }
                        if(data[i].is_best==1){
                            html+='<td align="center"><img src="/Public/Admin/Images/yes.gif"/></td>';
                        }else{
                            html+='<td align="center"><img src="/Public/Admin/Images/no.gif"/></td>';
                        }
                        if(data[i].is_new==1){
                            html+='<td align="center"><img src="/Public/Admin/Images/yes.gif"/></td>';
                        }else{
                            html+='<td align="center"><img src="/Public/Admin/Images/no.gif"/></td>';
                        }
                        if(data[i].is_hot==1){
                            html+='<td align="center"><img src="/Public/Admin/Images/yes.gif"/></td>';
                        }else{
                            html+='<td align="center"><img src="/Public/Admin/Images/no.gif"/></td>';
                        }
                        html+='<td align="center"><span>'+data[i].goods_sort+'</span></td>\
<td align="center"><span>'+data[i].goods_number+'</span></td><td align="center">\
<a href="" target="_blank" title="查看"><img src="/Public/Admin/Images/icon_view.gif" width="16" height="16" border="0" /></a>\
<a href="" title="编辑"><img src="/Public/Admin/Images/icon_edit.gif" width="16" height="16" border="0" /></a> <a href="" onclick="" title="回收站"><img src="/Public/Admin/Images/icon_trash.gif" width="16" height="16" border="0" /></a></td>\
</tr>';
                    }
                }
                $('#goods_list').html(html);
            },'json')


        })
    })
</script>
</html>