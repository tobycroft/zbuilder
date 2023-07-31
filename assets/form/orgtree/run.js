$('.orgtree').each(function () {
    // 调用
    $('.form-control', this).orgTree({
        all: true,                //人物组织都开启
        area: ['650px', '600px'],  //弹窗框宽高
        search: true,              //开启搜索
        url: $('.form-control', this).data('url')
    });
});