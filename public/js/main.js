console.log('main.js loaded');

var Page = {
    init : function () {
        this.listen();
    },

    listen : function () {
        $('.tgh-btn-ajax').click(function () {
            var btn = this;
            $(btn).attr('disabled' , true);
            var form = $(this).closest('form');
            var url = $(this).data('url');
            var input = Page.tool.getFormData(form);
            var countDown = $(this).data('count-down');
            Page.post(url , {
                data : input
            } , function (e) {
                var data = e.data;

                if(countDown && data[countDown]){
                    $(btn).data('old-html' , $(btn).html());
                    $(btn).html('<span class="tgh-count-down">' + data[countDown] + '</span>' + '秒');
                    Page.timerCountDown(btn);
                }else {
                    $(btn).attr('disabled' , false);
                }

                if(e.code == 10000){
                    $(btn).attr('disabled' , false);
                }else {
                    Page.tool.toast(e.msg);
                }

            });
        });
    },

    timerCountDown : function(btn){
        var set = setInterval(function () {
            log('-');
            var numHtml = $(btn).find('.tgh-count-down');
            var num = numHtml.html();
            if(num && num > 0){
                num --;
                if(num == 0){
                    clearInterval(set);
                    $(btn).html($(btn).data('old-html'));
                    $(btn).attr('disabled' , false);
                }else {
                    numHtml.html(num);
                }

            }
        } , 1000)
    },

    post : function (url , data , cb) {
        $.post(url , data , function (e) {
            Page.tool.log(e);
            if(cb)cb(e);
        })
    },

    tool : {
        getFormData : function (form) {
            var input = {};
            var serializeArray = $(form).serializeArray();
            $.each(serializeArray, function() {
                input[this.name] = this.value;
            });
            return input;
        },
        log : function (a , b , c) {
            a = a || '';
            b = b || '';
            c = c || '';
            console.log(a , b , c);
        },
        toast : function (msg) {
            alert(msg);
        }
    },
};

var log = Page.tool.log;

Page.init();