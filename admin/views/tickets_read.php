<?php include 'header.php'; ?>

<style>
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Button */
.container-md .nav-tabs a{
 font-family:'Inter', sans-serif;
 color:#5a5a5a;
}

/* Body */
body{
 font-family:'Inter', sans-serif;
}

.form-inline .input-group input[type=text]{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}

/* Select */
.input-group .search-select-wrap select{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}

/* Button */
.input-group .search-select-wrap .btn{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}
/* Input */
.form-inline .input-group input[type=text]{
 border-top-left-radius:8px !important;
 border-bottom-left-radius:8px !important;
 border-top-right-radius:0px !important;
 border-bottom-right-radius:0px !important;
}
.search-select-wrap:before{
    display:none !important;
}
/* Select */
.input-group .search-select-wrap select{
 text-align:center;
}


/* Text Area */
.ticket-header__textarea form textarea{
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Button */
.ticket-header__textarea form .btn-primary{
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
.ticket-header__textarea form .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

/* Button */
.ticket-header__textarea .btn-group .btn{
   color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
.ticket-header__textarea .btn-group .btn:hover {
    transform: translateY(-2px);
}
.ticket-header-id{
    color: #ffffff;
}

/* Ticket header  title */
.container-md .ticket-header__title{
  background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
}

/* Ticket Messages Styling */
.ticket-message__block {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 10px;
}

.ticket-message__support {
    background-color: #e9f7ef;
    border: 1px solid #d4edda;
}

.ticket-message__client {
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
}

.ticket-message__title {
    font-weight: 500;
    margin-bottom: 5px;
}

.ticket-message__text {
    color: #333;
    font-size: 14px;
}

/* Ticket message  text */
.ticket-message__support .ticket-message .ticket-message__text{
 background-color:rgba(223,240,216,0);
 border-style:none;
 box-shadow:0px 1px 1px 0px rgba(189,189,189,0);
}

/* Ticket message  text */
.ticket-message__client .ticket-message .ticket-message__text{
 background-color:rgba(217,237,247,0);
 box-shadow:0px 1px 1px 0px rgba(189,189,189,0);
}

/* Link */
.ticket-message__footer .ticket-btn-group a{
 color:#5a5a5a;
}
/* Ticket message  footer */
.ticket-body .ticket-message__support .ticket-message__footer{
 padding-left:10px;
}

/* Modal header */
#modalDiv .modal-dialog .modal-header{
 text-transform:capitalize;
}

/* Text Area */
.modal-body .form-group textarea
{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

}

.form .modal-footer .btn-primary{
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
.form .modal-footer .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
.form .modal-footer .btn-danger{
  background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
   padding: 14px 28px;
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0,danger 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
.form .modal-footer .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}



</style>
 <div class="container container-md"> <div class="row"><div class="col-md-12">
                  <ul class="nav nav-tabs"> <a href="/<?= $rentaladmin ?>/tickets" class="details_backButton btn btn-link"><span>‹</span> Back</a><li class="pull-right custom-search">
         <form class="form-inline" action="<?=site_url("$rentaladmin/orders")?>" method="get" target="_blank">
            <div class="input-group">
               <input type="text" name="search" class="form-control" value="<?=$search_word?>" placeholder="Search">
               <span class="input-group-btn search-select-wrap">
                  <select class="form-control search-select" name="search_type">
                     <option value="order_id" <?php if( $search_where == "order_id" ): echo 'selected'; endif; ?> >ID</option>
                  </select>
                  <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
               </span>
            </div>
         </form>
      </li></ul> 
 </div> </div>
   <div class="row">
       <div class="col-md-12">
        <div class="ticket-header__title border-radius-top">
        <div class="row">
            <div class="col-md-12">
                <div class="ticket-header-title">
					 <?php foreach($ticket as $tickets ): ?>
       

		   <?php echo $ticketMessage[0]["subject"]; echo ' <span class="service-block__provider-value">';
               if($tickets["support_new"] == 2){
                                           echo' ';
                                           }elseif ($tickets["support_new"] == 1){
                                           echo' ';
                                           } ?></span><?php endforeach; ?>
               <?php if( $ticketMessage[0]["canmessage"] == 1 ): ?>
               <span class="badge"><i class="fa fa-lock"></i> Support request locked, User can't reply.</span>
               <?php endif; ?>
                    <div class="ticket-header-id">ID: <?=$ticketMessage[0]["ticket_id"]?></div>
             </div>
            </div>
        </div>
    </div>

          <div class="row">
               <div class="col-md-12">
                   
                  <div class="ticket-header__textarea">
                     <div class="row">
                        <div class="col-md-12">
                           <form action="<?php echo site_url("$rentaladmin/tickets/read/".$ticketMessage[0]["ticket_id"]) ?>" method="post">
                              <div class="col-md-12">
                                 <div class="ticket-message-submit">
                                    <textarea name="message" id="" cols="30" rows="5" class="form-control ticket-edit__textarea"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <button class="btn btn-primary click" type="submit">Submit</button>
                                 <div class="btn-group">
                                   <?php if( $ticketMessage[0]["client_new"] == 1 ): ?>
                                     <a href="<?php echo site_url("$rentaladmin/tickets/unread/".$ticketMessage[0]["ticket_id"]) ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Okunmadı olarak işaretle">Mark as Unread</a>
                                   <?php endif; if( $ticketMessage[0]["canmessage"] == 2 ): ?>
                                     <a href="<?php echo site_url("$rentaladmin/tickets/lock/".$ticketMessage[0]["ticket_id"]) ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Destek talebini kilitle">Lock Ticket</a>
                                   <?php else: ?>
                                     <a href="<?php echo site_url("$rentaladmin/tickets/unlock/".$ticketMessage[0]["ticket_id"]) ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Destek talebi kilidini aç">Unlock Ticket</a>
                                   <?php endif; if( $ticketMessage[0]["status"] != "closed" ): ?>
                                     <a href="<?php echo site_url("$rentaladmin/tickets/close/".$ticketMessage[0]["ticket_id"]) ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Destek talebi kapat">Close Ticket</a>
                                   <?php endif; ?>
</div>
                              </div>
                           </form>
							 
                            </div></div>
                           
                            </div></div></div>
                        
 <div class="row">
            <div class="col-md-12">
                          <div class="ticket-body">
                           <div class="ticket-message__container">
    <?php foreach($ticketMessage as $message): if( $message["support"] == 2 ): ?>
                              <div class="ticket-message__block ticket-message__support">
                                 <div class="ticket-message">
                                    <div class="ticket-message__title">
                                       <div class="row">
                                           <div class="col-sm-6">
                                             <strong>Support Team</strong>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="ticket-message__title-date">
                                          <?=$message["time"]?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="ticket-message__text"><?=$message["message"]?></div>
                                 </div>   
<div class="ticket-message__footer">
<div class="btn-group ticket-btn-group" role="group" aria-label="...">
<a data-toggle="modal" data-target="#modalDiv" data-action="edit_ticket" data-id="<?=$message['id']?>">Edit</a> • <a href="<?php echo site_url("$rentaladmin/tickets/remove/".$ticketMessage[0]["id"]) ?>">Delete</a>
    
</div></div>
                                             

                                  
                         </div>
                              <?php else: ?>
                                           <div class="ticket-message__block ticket-message__client">
                                 <div class="ticket-message">
                                    <div class="ticket-message__title">
                                       <div class="row">
                                          <div class="col-sm-6">
                                             <strong><?=$message["username"]?></strong>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="ticket-message__title-date">
                                                <?=$message["time"]?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="ticket-message__text"><?=str_replace("</script>","</ script >",str_replace("<script>","< script >",$message["message"]))?></div>
                                 </div>
                              </div>
                              <?php endif; endforeach; ?>
                           </div>
                        
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include 'footer.php'; ?>
