$(document).ready(function(){
    $(".add-product-order").click(function(){
        let name = $(this).parent().find(".p-name").html() ;
        let price = $(this).parent().find(".p-price").html() ;
        let pid = $(this).parent().find(".pId").html() ;

        let qty =document.getElementsByClassName(`${name}`).length;
        if (qty ===0) {
            $(".items").append(`
        <div class = "added-item row ${name}">
        <label class="col-md-5" for =${name}qty>${name} </label>
        <input class="form-control col-md-2 qty " min=1 type="number" name="quantity[]" id=${name}qty value="1"/>
        <input type="hidden" value=${price} name="price[]">
        <p class="item-price col-sm-3" value = ${price}> ${price} EGP</p>
        <input type="hidden" name = "product_id[]" value = ${pid} />
        <button type="button" class="btn btn-danger rounded-circle remove-item">X</button>
        </div>
    `)
        }
        else{

        }

$(".order-card").css({
  "display" : "block"
})
  $(".order-card").addClass("bounceInDown") ;
    // change  total price with changing item number
    $(`#${name}qty`).change(function(){
      $("#totalPrice").val(
          function(){
            let total = 0 ;
            let items = document.getElementsByClassName("added-item");
            console.log(items[0])
          for( let i =0; i< items.length; i++)
          {
            total += parseInt(items[i].getElementsByClassName("qty")[0].value) * parseInt(items[i].getElementsByClassName("item-price")[0].getAttribute("value"))
          }
          //  items.each(function(){
          //     total += parseInt($(this).find(".qty").val()) * parseInt($(this).find(".item-price").attr("value"))
          //   })
          console.log(total)
            return total ;
          }
      ) ;
    })



// When Remove ordered Item
    $(".remove-item").click( function () {
        $("#totalPrice").val(
            parseInt($("#totalPrice").val()) - ( parseInt($(this).parent().find(".qty").val()) * parseInt ($(this).parent().find(".item-price").attr("value") ) )
        ) ;
         $(this).parent().fadeOut().remove() ;

         if ( $(".items").children().length <= 1){
           $(".order-card").fadeOut() ;
         }
    }) ;

    $("#totalPrice").val(
        parseInt($("#totalPrice").val()) +parseInt (price )
    ) ;

    });


// change Add to User in admin manual  
$("#userId").change( function (){
  $("#userIdForm").val($(this).val()) ; 
})


  });
