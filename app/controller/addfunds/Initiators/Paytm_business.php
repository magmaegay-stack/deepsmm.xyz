<?php
if (!defined('ADDFUNDS')) {
    http_response_code(404);
    exit;
}

$merchantId = $methodExtras["merchantId"];
$upi_id = $methodExtras["upi_id"];
$time = $methodExtras["time"];
$orderId = strtoupper(bin2hex(random_bytes(8)));
$callbackURL = site_url("payment/" . $methodCallback);
$site_name = $_SERVER['SERVER_NAME'];

$insert = $conn->prepare(
    "INSERT INTO payments SET
    client_id=:client_id,
    payment_amount=:amount,
    payment_method=:method,
    payment_mode=:mode,
    payment_create_date=:date,
    payment_ip=:ip,
    payment_extra=:extra"
    );
$insert->execute([
    "client_id" => $user["client_id"],
    "amount" => $paymentAmount,
    "method" => $methodId,
    "mode" => "Automatic",
    "date" => date("Y.m.d H:i:s"),
    "ip" => GetIP(),
    "extra" => $orderId
    ]);
    
$upiUri = "upi://pay?pa=$upi_id&am=$paymentAmount&pn=$site_name&tn=Addfunds&tr=$orderId";
$qr_code_url = 'https://api.qrserver.com/v1/create-qr-code/?size=320x320&data=' . urlencode($upiUri);

$redirectForm = '';
$redirectForm .= '<style>.button-34,.button-35{margin:10px 0 5px;font-size:16px;padding:8px 18px;touch-action:manipulation;cursor:pointer}#pay-modal .btn,.button-34,.button-35{width:100%;font-weight:700}#pay-modal-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.55);display:flex;align-items:center;justify-content:center;z-index:9999}#pay-modal{z-index:99999;padding:2px;background:#fff;border-radius:12px;max-width:500px;width:90%;box-shadow:0 30px 80px rgba(0,0,0,.2);overflow:hidden;font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif}#pay-modal header{padding:14px 16px;border-bottom:1px solid #eee;display:flex;align-items:center;justify-content:space-between}#pay-modal header h3{margin:0;font-size:18px}#pay-modal .close{cursor:pointer;border:none;background:0 0;font-size:22px;line-height:1;color:#666;border-radius:8px;padding:6px}#pay-modal .close:hover{background:#f2f2f2;color:#222}#pay-modal .body2{padding:20px;text-align:center;border-radius:10px;background:linear-gradient(to bottom,#120b2e 0,#1f0b6c 100%)}#pay-modal .meta{display:flex;justify-content:center}#pay-modal .chip{background:#f8f8f8;border:1px solid #333;border-radius:3px;padding:0 0 0 10px;margin:5px;font-size:13px}#pay-modal .grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:5px}#pay-modal .qr{border-radius:4px;border:1px solid #eee;padding:10px;display:inline-block;background:#fff}#pay-modal .actions{padding:0 16px 16px}#pay-modal .btn{display:block;padding:12px 14px;border-radius:12px;text-decoration:none;border:1px solid #d0d0d0;text-align:center}#pay-modal .btn:hover{background:#f7f7f7}#pay-modal .subtle{font-size:12px;color:#666;margin-top:8px}#pay-modal .timer{font-variant-numeric:tabular-nums;font-weight:700}.button-34{background:#5e5df0;border-radius:4px;box-shadow:#5e5df0 0 5px 10px -2px;color:#fff;border:0}.button-35{background:#ff3e3e;border-radius:4px;box-shadow:#f43737 0 5px 10px -2px;color:#fff;border:0}#pay-modal .chip i{background:#33333333;padding:10px;border:1px solid #0000001a;margin-left:10px}.fa-copy:hover,.hv:hover{color:#00f;cursor:pointer}.button-34:focus,.button-34:hover,.button-35:hover{opacity:.8}.amount-display{text-align:center;margin-bottom:16px}.amount-label{color:#fff;font-size:17px;margin-bottom:4px}.amount-value{font-size:30px;font-weight:700;color:#fff}.countdown{margin:10px 0 18px;display:flex;justify-content:center}.countdown .timetext{color:#fff;font-size:18px}.countdown .time{color:#fff;font-size:23px;margin-left:10px}.info-text{color:#fff;margin:15px 0;font-size:14px;font-weight:500}</style>';

$redirectForm .= '<div id="pay-modal-backdrop" role="dialog" aria-modal="true" aria-label="UPI Payment">
  <div id="pay-modal" data-expires="'.$time.'">
    <div class="body2">
    <div class="hidden" id="payment-data" data-callback="'.$callbackURL.'" data-orderid="'.$orderId.'"></div>
    <div class="amount-display">
                <div class="amount-label">Amount to pay</div>
                <div class="amount-value">₹'.$paymentAmount.'</div>
            </div>
      <div class="qr"><img src="'.$qr_code_url.'" alt="UPI QR code" width="230" height="230"></div>
      <div class="meta">
        <span class="chip hv" id="download">Download QR<i class="fa fa-download" aria-hidden="true"></i></span>
      </div>
       <div class="countdown" data-time="'.$time.'">
    <span class="timetext" > Auto cancel in </span><span class="time" id="time">00:00</span>
  </div>
  
  <div class="info-text">Scan QR with PhonePe, GPay, Paytm or Any UPI App</div>

    </div>
    <div class="actions">
     <div class="grid">
<button id="checking" class="button-34" role="button" disabled>Checking...</button>
<button onclick="location.reload()" class="button-35" role="button">Cancel</button>
    </div> <div id="alert" style="margin-top:3px;"class="hidden alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">✕</button>
          Payment Successful!
      </div> </div>
  </div>
</div>';

$redirectForm .= '<script>
const el=document.querySelector(".countdown");
let sec=el.dataset.time*60,timeEl=document.getElementById("time");
function update(){
    let m=String(Math.floor(sec/60)).padStart(2,"0");
    let s=String(sec%60).padStart(2,"0");
    timeEl.textContent=`${m}:${s}`;
}
update();
const timer=setInterval(()=>{
    if(sec<=0){clearInterval(timer);location.reload();return}
    sec--;update();
},1000);

!function(){
    const e=document.getElementById("pay-modal-backdrop");
    const t=e.querySelector("#download"),n=e.querySelector(".qr img");
    if(t&&n){
        t.addEventListener("click",async()=>{
            try{
                const e=await fetch(n.src);
                const t=await e.blob(),o=URL.createObjectURL(t),a=document.createElement("a");
                a.href=o,a.download="upi_qr.png",document.body.appendChild(a),a.click(),a.remove();
            }catch(err){ window.open(n.src, "_blank"); }
        });
    }
}();

const btn=document.getElementById("checking");
function check(){
    const e=document.getElementById("payment-data"),t=e.dataset.callback,n=e.dataset.orderid;
    $.ajax({
        type:"post",
        url:t,
        data:{orderid:n},
        dataType:"json",
        success:function(e){
            if(e.success){
                $("#alert").removeClass("hidden").show();
                btn.innerHTML="Paid ✓";
                setTimeout(function(){location.reload()},2000);
            }
        }
    });
}
setInterval(check,5000);
</script>';

$response['success'] = true;
$response['message'] = 'Your payment has been initiated.';
$response['content'] = $redirectForm;
