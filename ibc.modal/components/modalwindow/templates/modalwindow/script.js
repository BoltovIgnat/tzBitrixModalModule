$( document ).ready(function() {
    let modal = new ibcModal(
        $(".ibc-modal"),
        $(".ibc-modal-backdrop"),
        $('.ibc-barcode-input'),
        $('.ibc-barcode-input-group'),
        $('.ibc-modal-body'),
        $('.ibc-btn-submit'),
        $('.ibc-result-msg'),
    );

    modal.init("1","88");

    $( ".ibc-btn-modal" ).click(function() {
        modal.showModal()
    });

    $( ".ibc-btn-submit" ).click(function() {
        modal.updateBarcodeAjax(modal.getBarcodeValue(),modal.getBarcodeNewValue())
    });

    $( ".ibc-btn-close" ).click(function() {
        modal.hideModal()
        modal.init("1","88")
    });
});

class ibcModal {
    name = "ibc";
    submittext = "";
    modalWindow = "";
    backdrop = "";
    barcodeinput = "";
    barcodeinputgroup = "";
    barcodevalue = "";
    modalbody = "";
    submitBtn = "";
    resultMsg = "";

    constructor(modalWindow, backdrop, barcodeinput,barcodeinputgroup, modalbody, submitBtn, resultMsg) {
        // вызывает сеттер
        this.modalWindow = modalWindow;
        this.backdrop = backdrop;
        this.barcodeinput = barcodeinput;
        this.barcodeinputgroup = barcodeinputgroup;
        this.modalbody = modalbody;
        this.submitBtn = submitBtn;
        this.resultMsg = resultMsg;
    }

    init(id, price){

        var $this = this;

        $.ajax({
            "type" : "post",
            "url" : "/ajax/modalwindow/init.php",
            "data" : {
                "ajaxMethod" : "getBarcode",
                "id" : id,
                "price" : price,
            },
            "dataType" : "json"

        }).done(function(response) {

            if (response['status'] == '1'){

                $(".ibc-btn-modal").removeAttr('disabled');
                $this.setBarcode(response['BarCode'])
                $this.setBarcodeValue(response['BarCode'])
                $this.resultMsg.hide()
                $this.barcodeinputgroup.show()

            }else{

                $(".ibc-btn-modal").remove();
                $(".ibc-container").append('<span>Данные не найдены</span>')

            }

        });
    }

    setBarcode(value){
        this.barcodeinput.val(value)
    }

    setBarcodeValue(value){
        this.barcodevalue = value
    }

    getBarcodeValue(){
        return this.barcodevalue
    }

    getBarcodeNewValue(){
        return this.barcodeinput.val()
    }

    updateBarcodeAjax(oldBarCode, newBarCode){

        var $this = this;

        $.ajax({
            "type" : "post",
            "url" : "/ajax/modalwindow/init.php",
            "data" : {
                "ajaxMethod" : "updateBarcode",
                "oldBarCode" : oldBarCode,
                "newBarCode" : newBarCode,
            },
            "dataType" : "json"

        }).done(function(response) {

            $this.showSubmitText(response.Msg)
            $this.submitBtn.hide()

        });
    }

    showModal() {
        this.backdrop.css({visibility:"visible", opacity: 0.0}).animate({opacity: 0.4, "z-index": 2000},100);
        this.modalWindow.css({visibility:"visible", opacity: 0.0}).animate({opacity: 1, "z-index": 2000},100);
        this.modalWindow.css({display:"block"});
    }

    hideModal() {
        this.submitBtn.show();
        this.backdrop.css({visibility:"visible", opacity: 0.4}).animate({opacity: 0.0, "z-index": -1, 'display': 'none'},200);
        this.modalWindow.css({visibility:"visible", opacity: 1}).animate({opacity: 0.0, "z-index": -1, 'display': 'none'},200);

    }

    showSubmitText(text) {
        this.barcodeinputgroup.hide()
        this.resultMsg.text(text)
        this.resultMsg.show()
    }

}
