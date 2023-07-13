function calculateTotal() {
    $total = 0
    $('#cartTable tr').each(function(index, row) {
        $total += Number($(row).find("#total").html().replace('Ks', ''))
    })
    $("#alltotal").html($total + " Ks");
    $("#finalTotal").html(($total + 3000) + ' Ks')
}
$(document).ready(function() {
    $(".btn-plus").click(function() {
        $parent = $(this).parents("#details");
        $quantity = $parent.find('#qty').val();
        $price = Number($parent.find('#price').html().replace('Ks', ''));
        $total = $quantity * $price;
        $parent.find('#total').html($total + " Ks");
        calculateTotal();
    })
    $(".btn-minus").click(function() {
        $parent = $(this).parents("#details");
        $quantity = $parent.find('#qty').val();
        $price = Number($parent.find('#price').html().replace('Ks', ''));
        $total = $quantity * $price;
        $parent.find('#total').html($total + " Ks");
        calculateTotal();
    })
    $(".btn-cross").click(function() {
        $(this).parents('#details').remove();
        calculateTotal();
    })
})