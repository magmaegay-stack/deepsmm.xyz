<style>
/* General Styling */
body {
  font-family: 'Inter', sans-serif;
  background-color: #f7f9fc;
  color: #333333;
}
.settings-emails__block {
  border-radius: 8px;
  background-color: #ffffff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  margin-bottom: 20px;
}
.settings-emails__block-title {
  font-weight: 600;
  font-size: 1.2em;
  color: #333333;
  padding: 16px;
  border-bottom: 1px solid #e9ecef;
}
/* Table Styling */
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  text-align: left;
  padding: 12px;
}
.settings-emails__row {
  border-bottom: 1px solid #e9ecef;
}
.settings-emails__row:hover {
  background-color: #f9fbfd;
}
.settings-emails__row-img img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}
/* Row Styling */
.settings-emails__row-name {
  font-weight: 600;
  color: #333333;
}
.settings-emails__row-description {
  color: #777777;
  font-size: 0.9em;
}
.settings-emails__row-disable {
  opacity: 0.6;
}
/* Button Styling */
.btn-default {
  background-color: #f0f0f0;
  color: #333333;
  border: 1px solid #ccc;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 0.85em;
}
.btn-default:hover {
  background-color: #e9ecef;
}
/* Select */
.form-control{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}


/* Button */
.btn-primary{
    width:100%;
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
.btn-primary:hover{
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

</style>
<div class="col-md-8 mx-auto">
  <div class="settings-emails__block">
    
    <div class="settings-emails__block-body">
      <table>
        <thead>
         
        </thead>
        <tbody>
               <tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Admin URL Changer</div>
    <div class="settings-emails__row-description">Admins will have the ability to change the admin panel path for enhanced security and customization.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="changeadmin-url">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Admin IP Security</div>
    <div class="settings-emails__row-description">Restrict access to the admin panel by allowing only authorized IP addresses.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_ip_protect">Edit</button>
  </td>
</tr>
<tr class="settings-emails__td-actions">
  <td>
    <div class="settings-emails__row-name">Favorite Services</div>
    <div class="settings-emails__row-description">This module allows you to enable/disable the favorite services feature. Users can mark their favorite services, and the icon will change accordingly.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_fav_services">Edit</button>
  </td>
</tr>

<tr class="settings-emails__td-actions">
  <td>
    <div class="settings-emails__row-name">Rank System</div>
    <div class="settings-emails__row-description">Users will be able to see their ranks based on their total spent amount. Admins can enable/disable the system and configure ranks accordingly.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_rank_system">Edit</button>
  </td>
</tr>

         
          <tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">IP Blacklist Manager</div>
    <div class="settings-emails__row-description">
      Manage allowed and blacklisted IPs to prevent spam, block fake users, and stop suspicious activities effectively.
    </div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="blacklist_ips">Edit</button>
  </td>
</tr>
<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Auto Order Resend</div>
    <div class="settings-emails__row-description">Automatically resend all failed orders to the provider, ensuring seamless order processing without manual intervention.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_auto_order_resend">Edit</button>
  </td>
</tr>
<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Auto Failed Order Handling</div>
    <div class="settings-emails__row-description">
      Automatically cancel or retry failed orders after a custom time delay. Manage automation to keep your system efficient without manual updates.
    </div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" 
            class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_auto_failed_order_handling">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Auto Average Time Fetch</div>
    <div class="settings-emails__row-description">Automatically fetch and update the average processing time for services from the provider, ensuring accurate time estimations.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_auto_avg_time">Edit</button>
  </td>
</tr>
<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Currency Manager</div>
    <div class="settings-emails__row-description">Currency converter to allow users to view and convert prices to their preferred currency, ensuring seamless international transactions.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_currency_manager">Edit</button>
  </td>
</tr>
<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Telegram Notifications</div>
    <div class="settings-emails__row-description">Send automated Telegram notifications to both admins and users for important updates, ensuring real-time alerts and seamless communication.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_telegram_notifications">Edit</button>
  </td>
</tr>
<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Order Completion Time</div>
    <div class="settings-emails__row-description">Track and display the estimated order completion time based on provider processing speed, ensuring accurate delivery expectations.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_order_completion_time">Edit</button>
  </td>
</tr>
      <tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Google Login</div>
    <div class="settings-emails__row-description">Users will have the ability to securely log in to the panel using their Google Account credentials.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_google_login">Edit</button>
  </td>
</tr>
<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Reset Password</div>
    <div class="settings-emails__row-description">Allow users to securely manage and reset their passwords for account recovery.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_reset_password">Edit</button>
  </td>
</tr>
           
     



<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Support Ticket System</div>
    <div class="settings-emails__row-description">Enable users to configure and manage ticket system settings for efficient support and issue tracking.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_ticket_system">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Child Panel</div>
    <div class="settings-emails__row-description">Allow users to configure and manage child panel system settings for seamless integration and control.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_child_panel">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Free Balance</div>
    <div class="settings-emails__row-description">Enable automatic allocation of free balance to new users based on predefined settings.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_free_balance">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Affiliate System</div>
    <div class="settings-emails__row-description">Allow users to configure and manage affiliate system settings for tracking referrals and commissions.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_affiliate_system">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Funds Transfer</div>
    <div class="settings-emails__row-description">Allow users to configure and manage the funds transfer system for seamless balance transfers between accounts.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_fund_transfer">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Mass Order</div>
    <div class="settings-emails__row-description">Enable users to use mass order settings for efficient bulk order processing.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_mass_order">Edit</button>
  </td>
</tr>

<tr class="settings-emails__row">
  <td>
    <div class="settings-emails__row-name">Updates Log</div>
    <div class="settings-emails__row-description">Allow users to enable or disable access to the updates log, providing control over visibility of service updates.</div>
  </td>
  <td class="settings-emails__td-actions">
    <button type="button" class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#modalDiv" 
            data-action="edit_updates_log">Edit</button>
  </td>
</tr>




        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Include necessary JS for modals -->
<script>$(document).ready(function () {
    $("button[data-toggle='modal']").click(function () {
        var action = $(this).data("action");  // Get data-action value
        var modal = $("#modalDiv"); // Target modal
        var modalBody = modal.find(".modal-body"); // Modal content area

        // Reset modal content before loading new data
        modalBody.html('<div class="text-center"><b>Loading...</b></div>');

        // AJAX request to `admin/ajax_data.php`
        $.ajax({
            url: "<?php echo "/$rentaladmin/ajax_data"; ?>",  // Your actual AJAX handler file
            type: "POST",
            data: { action: action },
            success: function (response) {
                modalBody.html(response); // Load the response inside modal
            },
            error: function () {
                modalBody.html('<div class="text-danger text-center"><b>Failed to load data.</b></div>');
            }
        });
    });
});
</script>
