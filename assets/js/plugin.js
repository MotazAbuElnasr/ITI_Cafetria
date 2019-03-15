$(document).ready(function() {
    $("#searchBar").on('input',function(e){
        const allProduct = document.getElementsByClassName('Products');
        console.log(allProduct)
        for (const product of allProduct) {
            const productName=product.children[0].children[1].children[0].innerHTML;
            const regx = new RegExp(e.target.value,"i");
             if(productName.search(regx)==-1)
                product.style.display='none';
             else    product.style.display='block';
        }
    });
    $(".add-product-order").click(function(){
        let name = $(this).parent().find(".p-name").html();
        let price = $(this).parent().find(".p-price").html();
        let pid = $(this).parent().find(".pId").html();
        let qty = document.getElementsByClassName(`${name}`).length;
        if (qty === 0) {
            $(".items").append(`
        <div class = "added-item row ${name}">
        <label class="col-md-5" for =${name}qty>${name} </label>
        <input class="form-control col-md-2 qty " data-count = "${name}" min=1 type="number" name="quantity[]" id=${name}qty value="1"/>
        <input type="hidden" value=${price} name="price[]">
        <p class="item-price col-sm-3" value = ${price}> ${price} EGP</p>
        <input type="hidden" name = "product_id[]" value = ${pid} />
        <button onclick="deleteI(event)" data-name=${name} data-price = ${price} data-qty = "1" type="button" class="btn btn-danger rounded-circle remove-item">X</button>
        </div>
    `)
        } else {
            $(`[data-count=${name}]`).val((i, oldval) => {
                return parseInt(oldval, 10) + 1;
            });
            let quantity = parseInt($(`[data-name=${name}]`).data('qty'))+1;
            $(`[data-name=${name}]`).data('qty',quantity);
            let num = parseInt($(`[name=${name}]`).innerText);
            $(`[name=${name}]`).innerText = num + 1;

        }
        $("#totalPrice").val(
            parseInt($("#totalPrice").val()) + parseInt (price )
        ) ;

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
            return total ;
          }
      ) ;
    })
        $(".order-card").css({
            "display" : "block"
        })
        $(".order-card").addClass("bounceInDown") ;
        // change  total price with changing item number

        $(`#${name}`).change(function(){

        })

        });
// change Add to User in admin manual
    $("#userId").change( function (){
        $("#userIdForm").val($(this).val()) ;

    })
});



const deleteI = (event)=>{
    let price = event.target.dataset.price;
    let name = event.target.dataset.name;
    let qty = parseInt($(`[data-name=${name}]`).data('qty'))
    let totalPrice = price * qty;
    document.getElementById("totalPrice").value-=totalPrice;
    $(`.${name}`).fadeOut().remove() ;
    if ( $(".items").children().length <= 1){
        $(".order-card").fadeOut() ;
    }
}


