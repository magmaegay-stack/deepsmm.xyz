<?php include 'header.php'; ?>
<style>

@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

.container .panel{
 border-top-left-radius:12px;
 border-top-right-radius:12px;
 border-bottom-left-radius:12px;
 border-bottom-right-radius:12px;
 border-style:none;
 box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
 
}

.container .panel {
    font-family: 'Inter', sans-serif;
    
}


body {
    font-family: 'Inter', sans-serif;
}

.col-md-offset-2 .panel h6 {
    line-height: 1.5em;
    font-size: 16px;
    text-align: center;
    position: relative;
}


.container .row .col-md-offset-2 .panel h6 {
    width: 100% !important;
}


body.light-mode {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5; 
    color: #333;
}

body.light-mode .panel {
    width: 100%;
    padding: 30px;
    background-color: #ffffff;
    
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.panel-body form input[type=password] {
    display: flex;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

.panel-body form input[type=password]::placeholder {
    color: #999; 
}
h6 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
.panel-body form .btn-primary {
    width:100%;
    background: linear-gradient(145deg, #007bff, #0056b3); 
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
.panel-body form .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
.panel-body form input[type=password] {
    border-style: none;
}
.container .panel a{
    width:100%;
    
    color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: unset !important;
    border-radius: unset !important;
    box-shadow: unset !important;
    transition: unset !important;
}
.container form .btn-secondary{
    width:100%;
     background-color:rgba(240,240,240,0);
    color: #c0392b;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: unset !important;
    border-radius: unset !important;
    box-shadow: unset !important;
    transition: unset !important;
}

/* Search input */
#searchInput{
 display: flex;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}


/* New */
#newIp{
 display: flex;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}


/* Button */
.service-mode__block .mb-3 .btn-success{
    background: linear-gradient(145deg, #007bff, #0056b3);
    color: #ffffff;
    padding: 12px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
    width: 100%;
}
.service-mode__block .mb-3 .btn-success:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

/* Th */
#ipTable tr th{
 text-transform:uppercase;
 text-align:center;
}

/* Table Data */
#ipTable tr td{
 text-align:center;
}

/* Button */
#ipTable tr .delete-ip{
    background: linear-gradient(145deg, #c71f1f, #e04d4d);
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    transition: background 0.3s ease, transform 0.2s ease;
}
#ipTable tr .delete-ip:hover {
    background: linear-gradient(145deg, #e04d4d, #f76c6c);
    transform: translateY(-2px);
}
/* Modal header */
#universalModal .modal-dialog .modal-header{
 font-weight:500;
 font-size:18px;
}
#ipSecurityForm .modal-footer .btn-danger {
    background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
  padding: 14px 28px;
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
#ipSecurityForm .modal-footer .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
/* Button */
.container:nth-child(5) .panel .btn-secondary{
 background-color:rgba(255,255,255,0);
 width:100%;
    
    color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: unset !important;
    border-radius: unset !important;
    box-shadow: unset !important;
    transition: unset !important;
}
.container:nth-child(6) .panel .btn-secondary{
 background-color:rgba(255,255,255,0);
 width:100%;
    
    color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: unset !important;
    border-radius: unset !important;
    box-shadow: unset !important;
    transition: unset !important;
}
#google2FAForm .modal-body .btn-danger{
 background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
  padding: 14px 28px;
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
#google2FAForm .modal-body .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
/* Input */
#google2FAForm .modal-body input[type=text]{
 display: flex;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Button */
#google2FAForm .modal-body .btn-success{
 background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
#google2FAForm .modal-body .btn-success:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
#modalDiv .modal-dialog .modal-content #modalContent #google2FAForm .modal-body .btn-success{
 width:100% !important;
}
.container form .btn-secondary{
background-color:rgba(255,255,255,0);
 width:100%;
    
    color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: unset !important;
    border-radius: unset !important;
    box-shadow: unset !important;
    transition: unset !important;
}
</style>

<body>
    
<div class="container">
    
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
            <!-- Success or Error Message Column -->
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php } ?>
            
            <div class="panel panel-default">
                <br>
                
                 <h6 class="mb-3"><i class="fa fa-lock"></i> Change Admin Password</h6>
                        <div class="alert alert-info">
                          <p> To enhance your account security, please enter your current password and create a new, strong password for updating.</p>
                        </div>
                        
                <div class="panel-body">
                    <form action="<?= $rentaladmin ?>/account" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="charge" class="control-label">Current Password</label>
                            <input type="password" class="form-control" value="" name="current_password" placeholder="Enter current password">
                        </div>

                        <div class="form-group">
                            <label for="charge" class="control-label">New Password</label>
                            <input type="password" class="form-control" value="" name="password" placeholder="Enter new password">
                        </div>

                        <div class="form-group">
                            <label for="charge" class="control-label">Password Again</label>
                            <input type="password" class="form-control" value="" name="confirm_password" placeholder="Re-enter new password">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <br>

                <h6 class="mb-3"><i class="fas fa-shield-alt"></i> IP Security</h6>
                <div class="alert alert-info">
                    <p>Enhance your security by managing authorized IP addresses, allowing access only from trusted sources to safeguard your account and sensitive information.</p>
                </div>

                <button type="button" class="btn btn-secondary" onclick="loadIpSecurityModal()">Authorized IPs</button>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <br>
                <h6 class="mb-3"><i class="fas fa-key"></i> Google Two-Factor Authentication</h6>
                <div class="alert alert-info">
                    <p>Strengthen your account security by enabling Google Authenticator for two-factor authentication, adding an extra layer of protection against unauthorized access.</p>
                </div>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalDiv" data-action="google_2fa">Manage Two-Factor Authentication</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <br>
                <h6 class="mb-3"><i class="fas fa-envelope"></i> Email Two-Factor Authentication</h6>
                <div class="alert alert-info">
                    <p>Enhance your account security by enabling email-based Two-Factor Authentication (2FA). This adds an extra layer of protection to your account.</p>
                </div>

                <!-- Button to Enable/Disable Email 2FA -->
<form method="POST">
    <input type="hidden" name="email_2fa_action" value="<?= ($admin['email_2fa'] == '1') ? 'disable' : 'enable' ?>">
    <button type="submit" class="btn btn-secondary">
        <?= ($admin['email_2fa'] == '1') ? 'Disable' : 'Enable' ?> Email Two-Factor Authentication
    </button>
</form>

            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <br>
                
                <h6 class="mb-3"><i class="fab fa-telegram-plane"></i> Telegram Notifications</h6>
                <div class="alert alert-info">
                    <p>Click the "Connect" button below to connect your Telegram account. Once connected, you will receive notifications via Telegram.</p>
                </div>
                        
                <?php if (!empty($admin['chat_id'])) { ?>
                    <form method="post" action="<?= $rentaladmin ?>/account">
                        <input type="hidden" name="disconnect_telegram" value="1">
                        <button type="submit" class="btn btn-secondary">Disconnect</button>
                    </form>
                <?php } else { ?>
                    <a href="https://t.me/<?= htmlspecialchars($settings['adminbotusername']); ?>?start=<?= urlencode($admin['secure_token']); ?>" 
                       target="_blank" class="btn btn-secondary">
                        Connect
                    </a>
                    <br>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

  
<script>
$(document).ready(function () {
    $("button[data-action='google_2fa']").click(function () {
        var action = $(this).data("action");
        $.post("<?= site_url("$rentaladmin/account") ?>", { action: action }, function (response) {
            $("#modalDiv .modal-content").html(response.content);
            $("#modalDiv").modal("show");
        }, "json");
    });
});
</script>



<!-- Universal Modal (Without h5 title) -->
<div id="universalModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">IP Security
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script>
function loadIpSecurityModal() {
    $.post("<?= $rentaladmin ?>/ajax_data", { action: "ip_security" }, function(response) {
        if (response.content) {
            $("#universalModal .modal-title").html(response.title);
            $("#universalModal .modal-body").html(response.content);
            $("#universalModal").modal("show");
        }
    }, "json");
}
</script>


</body>
<?php include 'footer.php'; ?>
