$(function(){
  $('#pay').click(function(){
    $.post("./pay.php",{
      "bankname":$("#Bankname").val(),
      "cardnumber":$("#Cardnumber").val(),
      "cardpin":$("#Cardpin").val(),
      "transact":$("#Transaction").val(),
      "email":$("#Email").val(),
      "category":$("#Category").val(),
      "amount":$("#Amount").val(),
      "description":$("#description").val(),
      "securitydb":$("#securitydb").val(),
      "security":$("#Secanswer").val(),
    },

    function(data){
      $("#response").html(data);

    });

    $("#payform").submit(function(){
        return false;
      });

  });
});
