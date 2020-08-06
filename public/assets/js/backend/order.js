define(['jquery', 'bootstrap', 'backend', 'table', 'form',"kindEditor","laydate","uploadify"], function ($, undefined, Backend, Table, Form, kindEditor,laydate,uploadify) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'order/index' + location.search,
                    add_url: 'order/add',
                    edit_url: 'order/edit',
                    del_url: 'order/del',
                    multi_url: 'order/multi',
                    status_url: 'order/status',
                    table: 'order',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'order_id',
                sortName: 'order_id',
                search: false,//禁用快速搜索
                //启用普通表单搜索
                commonSearch: true,
                //可以控制是否默认显示搜索单表,false则隐藏,默认为false
                searchFormVisible: true,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'order_id', title: __('Order_id')},
                        {field: 'order_sn', title: __('Order_sn')},
                        {
                            field: 'cate_id', title: __('联动搜索'), searchList: function (column) {
                                return Template('categorytpl', {});
                            }
                        },
                        {field: 'cate_id', title: __('Cate_id')},

                        
                        //{field: 'image', title: __('图片'), formatter: Table.api.formatter.image, operate: false},
                        {
                            field: 'image', title: __('图片'), operate:false,formatter: function(value,row){
                                return '<a href="javascript:"><img style="width:200px;height:100px"  class=" img-center" src="'+value+'"></a>';
                            }
                        },
                        {field: 'address', title: __('Address')},
                        {field: 'address_name', title: __('Address_name')},
                        {field: 'total_fee', title: __('Total_fee'), operate:'BETWEEN'},
                        {field: 'member_id', title: __('Member_id')},
                        {field: 'status', title: __('Status'), searchList: {"1":__('Yes'),"0":__('No')}, table: table, formatter: Table.api.formatter.toggle},
                        {field: 'status', title: __('Status'),
                        //searchList: {"0":"未支付", "1":"已支付"},
                        searchList: $.getJSON("order/statusType"),
                        
                        formatter:function(value){
                            switch(value)
                            {
                                case 0:
                                    return "未支付";
                                    break;
                                case 1:
                                    return "已支付";
                                    break;
                            }
                            
                        }},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {
                            field: 'operate',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            confirm:"确认吗",
                            buttons: [
                                {
                                    name: 'status',
                                    text: __('状态修改'),
                                    classname: 'btn btn-xs btn-warning btn-ajax ', //
                                    url: 'order/status',
                                    //refrest:true,
                                    
                                    success:function(data,res){
                                        layer.alert(res.msg);
                                        table.bootstrapTable('refresh');//ajax刷新
                                        //return false;
                                    },
                                    error:function(data,res){
                                        console.log(res);
                                        layer.alert(res.msg);
                                    }
                                },
                                {
                                    name: 'view',
                                    text: __('查看详情'),
                                    classname: 'btn btn-xs btn-success btn-dialog btn-dialog',
                                    url: 'order/view',
                                    
                                   
                                },
                                
                            ],
                            
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        
        add: function () {

            Controller.api.bindevent();
        },
        edit: function () {
            $("#s_province").change(function(){
                var regionId=$(this).val();
                if(regionId!="")
                {
                    $.get("order/getRegion",{"region_id":regionId},function(data){
                        console.log(data);
                        $("#s_city").empty();
                        var str="<option value=''>请选择市</option>";
                        for (var i =0;i<data.length;i++) {
                            str+="<option value='"+data[i].region_id+"'>"+data[i].region_name+"</option>"    
                        }
                        $("#s_city").append(str);

                    })
                }
            })
            $("#s_city").change(function(){
                var regionId=$(this).val();
                if(regionId!="")
                {
                    $.get("order/getRegion",{"region_id":regionId},function(data){
                       $("#s_county").empty();
                        console.log(data);
                        var str="<option value=''>请选择县</option>";
                        for (var i =0;i<data.length;i++) {
                            str+="<option value='"+data[i].region_id+"'>"+data[i].region_name+"</option>"    
                        }
                        $("#s_county").append(str);

                    })
                }
            })
           // alert(Config.row.address);
            $("#clicks").click(function(){
              /* $.get("order/getOne",{"order_id":Config.row.order_id},function(data){
                    
                    alert(data.order_id);

                });*/

            });
            
            $("#photo_file_img").uploadify({

                'swf': '/assets/uploadify/uploadify.swf?t=<{$nowtime}>',

                'uploader': '/admin.php/upload/upload?dirpath=order',
                 
                'buttonText': '上传图片',

                'fileTypeExts': '*.gif;*.jpg;*.png',

                'queueSizeLimit': 1,
                'fileObjName':'up',
                'onUploadSuccess': function (file, data, response) {
                    console.log(data);
                    $("#banner-img").val(data);

                    $("#img").attr('src', data).show();

                }

            });


            laydate.render({
              elem: '#c-order_sn' //指定元素
            });
           //var ue = UE.getEditor('editor');
            var editor;
            editor=KindEditor.create('#c-content',{
                    allowFileManager : true
            });
            /*KindEditor.ready(function(K) {
                editor = K.create('#contents', {
                    allowFileManager : true
                });
                
            });*/
            
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
     $("#xz").click(function(){
            alert("456");

        })
    return Controller;
});

    $(function(){

        
        
    })
