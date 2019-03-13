$(document).ready(function(){

    $(".add-product-order").click(function(){
        let name = $(this).parent().find(".p-name").html() ;
        let price = $(this).parent().find(".p-price").html() ;
<<<<<<< HEAD
=======
        let pid = $(this).parent().find(".pId").html() ;

>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
     $(".items").append(`
        <div class = "added-item row">
        <label class="col-md-5" for =${name}qty>${name} </label>
        <input class="form-control col-md-2 qty " min=1 type="number" name=${name} id=${name}qty value="1"/>
        <p class="item-price col-sm-3" value = ${price}> ${price} EGP</p>
<<<<<<< HEAD
=======
        <input type="text" name = "productId" value = ${pid} style="display:none"/>
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
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
<<<<<<< HEAD
         $(this).parent().fadeOut() ;
=======
         $(this).parent().fadeOut().remove() ;
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
    }) ;

    $("#totalPrice").val(
        parseInt($("#totalPrice").val()) +parseInt (price )
    ) ;

    });


<<<<<<< HEAD

=======
// change Add to User in admin manual  
$("#userId").change( function (){
  $("#userIdForm").val($(this).val()) ; 
})
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38

  });
