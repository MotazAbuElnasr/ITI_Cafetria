$(document).ready(function() {
    $(".add-product-order").click(function(){
        let name = $(this).parent().find(".p-name").html();
        let price = $(this).parent().find(".p-price").html();
        let pid = $(this).parent().find(".pId").html();
        let qty = document.getElementsByClassName(`${name}`).length;
        if (qty === 0) {
            $(".items").append(`
        <div class = "added-item row ${name}">
        <label class="col-md-5" for =${name}>${name} </label>
        <input oninput="changeI(event)" data-element = ${name} class="form-control col-md-2 qty " min=1 type="number" name=${name} id=${name} value="1"/>
        <p class="item-price col-sm-3" value = ${price}> ${price} EGP</p>
        <input type="text" name = "productId" value = ${pid} style="display:none"/>
            <button onclick="deleteI(event)" data-name=${name} data-price = ${price} data-qty = "1" type="button" class="btn btn-danger rounded-circle remove-item">X</button>
        </div>
    `)
        } else {
            $(`[name=${name}]`).val((i, oldval) => {
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

        $(`#${name}`).change(function(){

        })

        });

// change Add to User in admin manual
    $("#userId").change( function (){
        $("#userIdForm").val($(this).val()) ;

    })
});



const changeI = (event)=>{
    let name = event.target.dataset.element;
    let oldValue = $(`[data-name=${name}]`).data('qty');
        $(`[data-name=${name}]`).data('qty',event.target.value);
        let newValue = $(`[data-name=${name}]`).data('qty');
        let price =  $(`[data-name=${name}]`).data('price');
        let totalPrice = parseInt(document.getElementById("totalPrice").value);
        if(newValue>oldValue)
            document.getElementById("totalPrice").value=totalPrice+price;
        else
            document.getElementById("totalPrice").value=totalPrice-price;
        }

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


