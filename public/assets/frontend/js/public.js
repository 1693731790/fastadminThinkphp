//弹窗
function OpenPop(id) {
    $(id).show();
    $(document).bind('touchmove',
    function(event) {
        event.preventDefault();
    });
}
function ClosePop(id) {
    $(id).hide();
    $(document).unbind('touchmove')
}
//底部滑出
function showtab(id){
	$(id).css("display","block");
	$(id).animate({bottom:"0"}, 200);
}
function hidetab(id){
	$(id).css("display","none");
	$(id).animate({bottom:"-100%"}, 200);
}


 

