$(document).ready(function(){

    $(".add-product-order").click(function(){
        let name = $(this).parent().find(".p-name").html() ;
        let price = $(this).parent().find(".p-price").html() ;
     $(".items").append(`
        <div class = "added-item row">
        <label class="col-md-5" for =${name}qty>${name} </label>
        <input class="form-control col-md-2 qty " min=1 type="number" name=${name} id=${name}qty value="1"/>
        <p class="item-price col-sm-3" value = ${price}> ${price} EGP</p>
        <button type="button" class="btn btn-danger rounded-circle remove-item">X</button>
    ` )

$(".order-card").css({
  "display" : "block"
})
  $(".order-card").addClass("bounceInDown") ;
    // change  total price with changing item number
    $(`#${name}qty`).change(function(){
      $("#totalPrice").val(
          function(){
            let total = 0 ;
            $(".items").children().each(function(element){
              total += parseInt($(this).find(".qty").val()) * parseInt($(this).find(".item-price").attr("value"))
            })
            return total ;
          }
      ) ;
    })



// When Remove ordered Item
    $(".remove-item").click( function () {
        $("#totalPrice").val(
            parseInt($("#totalPrice").val()) - ( parseInt($(this).parent().find(".qty").val()) * parseInt ($(this).parent().find(".item-price").attr("value") ) )
        ) ;
         $(this).parent().fadeOut() ;
    }) ;

    $("#totalPrice").val(
        parseInt($("#totalPrice").val()) +parseInt (price )
    ) ;

    });




  });
