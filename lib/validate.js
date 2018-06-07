$("#buy_eth").on('blur', function (e) {
    $("#approx_buy").text("");
    var amt = parseInt($(this).val())
    if ($(this).val().length > 0) {
        switch (true) {
        case !$.isNumeric($(this).val()):
            $("#approx_buy").html("Please enter a numeric value.");
            $(this).focus();
            break;
		}
    }
});
$("#buy_eth,#sell_eth,#transferAddress,#transferTokenCount").keypress(function(e) {
      if (e.which == 13) {
        e.preventDefault();
        return false;
      }
    });
$("#sell_eth ").on('blur', function (e) {
    $("#approx_sell").text("");
    var amt = parseInt($(this).val())
    if ($(this).val().length > 0) {
        switch (true) {
        case !$.isNumeric($(this).val()):
            $("#approx_sell").html("Please enter a numeric value.");
            $(this).focus();
            break;
      
        }
         
    }
});
// $("#transferTokenCount").on('blur', function (e) {
//     $("#approx_token").text("");
//     var amt = parseInt($(this).val())
//     if ($(this).val().length > 0) {
//         switch (true) {
//         case !$.isNumeric($(this).val()):
//             $("#approx_token").html("Please enter a numeric value.");
//             $(this).focus();
//             break;
      
//         }
         
//     }
// });



