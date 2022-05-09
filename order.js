function ConfirmOrder() {
    var retailername = $("#rname").val();
    var retailershop = $("#rsname").val();
    var retailerphone = $("#rphone").val();
    var retaileraddress = $("#raddress").val();
    var retailerid = $("#rtid").val();
  


  if (retailername != "") {
    $("#loader").css({ display: "block" });
   $.ajax({
      type: "post",
      url: "php/order.php",
      data: {
        order: "order",
        retailername:retailername,
        retailershop:retailershop,
        retailerphone:retailerphone,
        retaileraddress:retaileraddress,
        retailerid:retailerid,
 
      },
     
      success: function (response) {
        if (response !=" ") {
            window.location.href="payment.php?orderid="+response;
            alert(response);
        } else {
          $("#loader").css({ display: "none" });
          alert(response);
          window.location.href="new-order.php";
        }
      },
    });
  } else {
    alert("Please Fill All The Details");
  }

  return false;
}
