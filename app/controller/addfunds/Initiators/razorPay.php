<?php
if (!defined('ADDFUNDS')) {
    http_response_code(404);
    die();
}

$APIPublicKey = $methodExtras["APIPublicKey"];
$APISecretKey = $methodExtras["APISecretKey"];
$redirectURL = site_url("payment/" . $methodCallback);
$orderId = md5(RAND_STRING(5) . time());

$redirectForm .= '
<script type="text/javascript">
$.getScript("https://checkout.razorpay.com/v1/checkout.js", function() {
    var options = {
        "key": "' . $APIPublicKey . '",
        "amount": "' . ($paymentAmount * 100) . '",
        "currency": "' . $methodCurrency . '",
        "name": "' . ($settings["site_name"] ?: site_url()) . '",
        "description": "Balance Recharge (' . $user["username"] . ')",
        "image": "' . $settings["favicon"] . '",
        "handler": function (response){
            $.ajax({
                url: "' . site_url("payment/" . $methodCallback) . '",
                type: "POST",
                data: {
                    paymentId: response.razorpay_payment_id,
                    paymentAmount: "' . $paymentAmount . '"
                },
                success: function(json){
                    var msgDiv = $("#formSubmitResponseMessage");
                    if (json.success) {
                        msgDiv.html(`<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            ${json.message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>`);
                        setTimeout(() => { location.reload(); }, 2000);
                    } else {
                        msgDiv.html(`<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            ${json.message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>`);
                    }
                }
            });
        },
        "prefill": {
            "name": "' . ($user["name"] ?: "Customer") . '",
            "email": "' . ($user["email"] ?: "") . '",
            "contact": "' . ($user["telephone"] ?: "") . '"
        },
        "theme": {
            "color": "' . ($methodExtras["gatewayThemeColour"] ?: "#F37254") . '"
        }
    };
    var rzp = new Razorpay(options);
    rzp.open();
});
</script>';

$response["success"] = true;
$response["message"] = "Your payment has been initiated and you will now be redirected to the payment gateway.";
$response["content"] = $redirectForm;
