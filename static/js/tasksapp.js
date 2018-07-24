/**
 * Модальное окно
 */
window.SupportModalWindow = function() {
    var me = this;
    me.windowId = "#supportModalWindow";
    me.titleSpanClass = '.modal-title';
    me.bodyClass = '.modal-body';
    me.closeButtonClass = '.close-button';

    me.modalWindow = $(me.windowId);
    me.modalTitle  = $(me.modalWindow).find(me.titleSpanClass);
    me.modalBody   = $(me.modalWindow).find(me.bodyClass);

    me.showModalWindow = function(title, body, callbackOnClose) {
        if(title !== undefined) {
            $(me.modalTitle).html(title);
        }
        if(body !== undefined) {
            $(me.modalBody).html(body);
        }
        if(callbackOnClose !== undefined) {
            $(me.modalWindow).on('hidden.bs.modal', function (e) {
                callbackOnClose();
            });
        }
        $(me.modalWindow).modal();
    };

    me.cleanModalWindow = function() {
        $(me.modalTitle).html('');
        $(me.modalBody).html('');
    };

    $(me.modalWindow).on('click', me.closeButtonClass, function(e){
        e.preventDefault();
        me.cleanModalWindow();
        $(this).modal('hide');
    });

}

var modalWindow = new SupportModalWindow();
modalWindow.showModalWindow('Hi', '123');

$(document).ready(function(){

    var Content = function(){
        var me = this;
        me.initContent = function() {

        };

    };


    var taskContent = new Content();
    taskContent.initContent();

});