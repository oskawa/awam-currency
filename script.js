$(document).ready(function () {
  $('#currency_addition').on('click', function () {
    let amount_one = $('#amount_one').val()
    let amount_two = $('#amount_two').val()
    let currency_one = $('#currency_one').val()
    let currency_two = $('#currency_two').val()
    let result

    console.log(amount_one)
    console.log(amount_two)
    console.log(currency_one)
    console.log(currency_two)

    if (amount_one && amount_two && currency_one && currency_two) {
      if (currency_one == currency_two) {
        result = Number(amount_one) + Number(amount_two)
        $('#calcul').text(result + ' ' + currency_one)
      } else {
        percentage_one = $('#currency_one').find(':selected').data('value')
        percentage_two = $('#currency_two').find(':selected').data('value')
        result =
          Number(amount_one) * percentage_one +
          Number(amount_two) * percentage_two
        console.log(result)

        $('#calcul').text(result + ' EUR')
      }

      $.ajax({
        url: 'core/Currencies.php',
        type: 'POST',

        data: {
          callFunction: 'save_currency',
          amount_one,
          amount_two,
          currency_one,
          currency_two,
          result,
        },

        success: function (result) {
          console.log(result)
        },
      })
    } else {
      console.log('Il manque une valeur ou il y a une erreur')
      $('#calcul').text('Il y a une erreur dans votre demande ! ')
    }
    // if (amount_one && amount_two && currency_one && currency_two){
    //     if (currency_one == currency_two){
    //         console.log('allez on additionne juste')
    //     }else{

    //         $.ajax({
    //             url: "core/Currencies.php",
    //             type: "POST",

    //             data:{
    //                 callFunction : 'get_currency',
    //                 currency_one,
    //                 currency_two
    //             },

    //             success:function(result){

    //           JsonResult = JSON.parse(result)
    //           percentage_one = JsonResult[0]['Percentage']
    //           percentage_two = JsonResult[1]['Percentage']
    //           console.log(percentage_one)
    //           console.log(percentage_two)
    //         }
    //     })
    // }

    // }else{
    //     console.log('Il manque une valeur ou il y a une erreur')
    // }
  })
})
