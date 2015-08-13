/**
 * Created by User on 18.04.2015.
 * validation forms javascript
 *
 * @param id - id form
 * @param fraimWork - name fraimwork for add class error
 * @constructor
 */


function FormValidate(id,fraimWork,action, errMsg, additionalVar){

    var that = this;

    that.id = id;

    that.fraimWork = fraimWork || undefined;

    /**
     * @param formObj - object jQuery form
     */
    that.formObj = jQuery('form#'+id);

    /**
     *  @param classRequired - name class for validate
     */
    that.classRequired = "required";

    /**
     * additional data for ajax
     */
    that.dataSubmit = additionalVar || {ajax_submit: 1};

    that.action = action || that.formObj.attr('action');

    /**
     *
     * @type {*|boolean} - true - показывать сообщения об ошиках, false - нет
     */
    that.errMsg = errMsg || false;

    /**
     * функция вызываемая после проверки введенных данных, перед отправкой данных на сервер
     */
    that.afterValidate = function(f) {}

    /**
     * метод выполняющийся в случае успешной отправки формы
     */
    that.success = function(res){}

    /**
     *  clear result validation
     */
    that.clearOutputResult = function()
    {
        that.formObj.find('.'+that.errorClass()).removeClass(that.errorClass());
    }

    /**
     * сброс формы
     */
    that.resetForm = function()
    {
        that.formObj.resetForm();
    }

    /**
     *  return of name element
     */
    that.getElement = function(name){
        var el = that.formObj.find('[name="'+name+'"]');
        if(el.length == 0)
        {
            var new_name='';
            var name_arr = name.split('[');
            var l = name_arr.length;
            for(var i=0; i<l; i++)
            {
                name_arr[i] = name_arr[i].replace(']', '');
                if(i==0)new_name+=name_arr[i];
                else
                {
                    var anum=/(^\d+$)|(^\d+\.\d+$)/
                    if (anum.test(name_arr[i]))
                    {
                        el = that.formObj.find('[name="'+new_name+'[]"]:eq('+name_arr[i]+')');
                        if(el.length>0) break;
                    }
                    new_name+="["+name_arr[i]+"]"
                }
                el = that.formObj.find('[name="'+new_name+'"]');
                if(el.length>0) break;
            }
        }
        return el;
    }

    /**
     * output result validation after ajax
     * @param res
     */
    that.outputResult = function(res){
        is_success = parseInt(res.IS_SUCCESS);
        if (is_success)
        {
            that.clearOutputResult();
            that.resetForm();
        }
        else
        {
            that.clearOutputResult();
            for (var key in res.ERROR_FIELDS) {
                var el = that.getElement(key);
                that.setError(el);
            }
            that.errMessage(res.ERROR_FIELDS)
        }
    }



    /**
     *  form submit
     */
    that.formObj.submit(function(){

        if (!that.action) that.action = window.location.href;
        action += "?rand" + Math.random();

        var defOptions = {
            data: that.dataSubmit,
            dataType: 'json',
            url: that.action,
            beforeSubmit: function(formData){
                var fval = that.validate(formData);
                that.afterValidate(fval);
                return fval;
            },

            success: function(res){
                that.outputResult(res);
                that.success(res);
            }
        }
        var opt = jQuery.extend( {}, defOptions, that.ajaxOptions );
        that.formObj.ajaxSubmit(opt);
        return false;
    });

    /**
     * cnt validation
     * @param formData
     */
    that.validate = function(formData){
        that.formObj.find(that.errorClass).removeClass(that.errorClass);
        var err = 0;
        for (var i = 0; i<formData.length; i++)
        {
            var el = that.formObj.find('[name="'+formData[i].name+'"]');
            if (el.hasClass('empty')) err += that.validEmpty(el);
            if (el.hasClass('email')) err += that.validEmail(el);
            if (el.hasClass('phone')) err += that.validPhone(el);
        }
        if (err>0) return false;
        else return true;
    }

    /**
     *  add class "error" for element's form
     *  @param el = object date form
     */
    that.setError = function(el){

        if (typeof that.fraimWork == 'undefined')
            el.addClass(that.errorClass);
        else if(that.fraimWork == 'bootstrap')
            el.closest('.form-group').addClass(that.errorClass);
    }

    /**
     * Функция вывода сообщений об ошибках
     * @param errObj - объект с ошибками
     */
    that.errMessage = function(errObj)
    {
        if (that.errMsg){
            that.formObj.find('.control-label').remove();
            for (var error in errObj)
            {
                var span = $("<span/>", {
                    text: function() {
                        for (var i in errObj[error]) {
                            return errObj[error][i];
                            break;
                        }
                    },
                    class: 'control-label'
                }).css({
                    fontSize: '10px',
                    fontWeight: 'bold'
                });
                that.formObj.find("input[name = "+error+"]").after(span);
            }
        }
    }

    /**
     * Определение названия класса ошибки от типа фреймворка
     * @returns {string} - название класса
     */
    that.errorClass = function(){
        var nameClass = '';
        if (typeof that.fraimWork == 'undefined') nameClass = 'error';
        else if(that.fraimWork == 'bootstrap') nameClass = 'has-error';
        return nameClass;
    }
    /**
     * valid empty
     */
    that.validEmpty = function(el){
        if (el.val() == '')
        {
            that.setError(el);
            return 1;
        }
        else return 0;
    }

    /**
     * valid email
     */
    that.validEmail = function(el){
        var res = 0;
        if (el.val() != '') {

            if (!el.val().match(/..+@.+\..+/)) {
                that.setError(el);
                res = 1;
            }
            else res = 0;
        } else res = 0;
        return res;
    }

    /**
     * valid phone
     */
    that.validPhone = function(el){
        var res = 0;
        if (el.val() != '') {

            if (!el.val().match(/^\d+$/)) {
                that.setError(el);
                res = 1;
            }
            else res = 0;
        } else res = 0;
        return res;
    }
}