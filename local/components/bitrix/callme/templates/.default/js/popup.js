/**
 * Created by work on 26.07.2015.
 */
function showDialog(id,url,title,width,height)
{
    var that = this;
    /**
     *	@id - id button object
     */
    that.id = id;

    /**
     *	@url - content for window
     */
    that.url = url;

    /**
     *	@title - title of window
     */
    that.title = title || 'title';

    /**
     * @height  - height window popup
     */
    that.height = height || 'auto';

    /**
     * @type  - width window popup
     */
    that.width = width || '400px';

    /**
     *	handler view the window
     */
    that.click = function(){
        that.id.on('click',function(){
            var but = $(this);
            but.after('<div id = "dialog"><div id = "modal"><span class="title">'+that.title+'</span><a class = "close" href="">X</a></div></div><div id = "wrap"></div>');
            that.style($('#modal'),$('#wrap'));

            $('.close, #wrap').on('click',function(){
                that.close();
                return false;
            });

            that.beforSubmit();
            that.submit();
            that.afterSubmit();
        });
    }

    /**
     * befor get template contents popup
     */
    that.beforSubmit = function(){};

    /**
     * uploading content with ajax
     */
    that.submit = function() {
        var content = '';
        for (i in that.url) {
            if (that.url[i]['type'] == 'tpl')
            {
                $.ajax({
                    url: that.url[i]['url'],
                    type: "POST",
                    async: false,
                    success: function (html) {
                        $('#modal').append(html);
                    }
                });
            }
            else if(that.url[i]['type'] == 'form')
            {
                $.ajax({
                    url: that.url[i]['url'],
                    type: "POST",
                    async: false,
                    dataType: "html",
                    data: jQuery('#'+that.url[i]['id']).serialize(),
                    success: function (html) {
                        $('#modal').append(html);
                    }
                });
            }
        }
    }

    /**
     * after get template contents popup
     * @param content - content popup window
     */
    that.afterSubmit = function(content){};

    /**
     *	функция стилей окна и фона
     *	@modal - объект с дивом модального окна
     *	@wrap - объект с дивом фона
     */
    that.style = function(modal,wrap){
        modal.css({
            'width' : that.width,
            'height' : that.height
        });
        wrap.css({
            'opacity' : '0.8'
        });
    }

    /**
     * handler close the window
     */
    that.close = function()
    {
        $('#dialog, #wrap').fadeOut(500, function(){$(this).remove()});
    }

    that.click();
}