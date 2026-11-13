<style>
/* Body */
/* General Styles */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* Prevent scrolling */
    font-family: 'Inter', sans-serif;
    
  }

/* Column 12/12 */
div .row .col{
 width:100% !important;
}

/* Span Tag */
.row .mb-3 span{
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
.row span i{
 color:#ffffff;
}
/* Column 12/12 */
div .row .col{
 width:100% !important;
}

/* Column 12/12 */
div .col{
 overflow-x:hidden;
}
/* Column 12/12 */
div .col:nth-child(3){
 position:relative;
 left:80px;
}
@media (max-width:992px){

 /* Column 12/12 */
 div .col:nth-child(3){
  left:0px;
 }
 
}
/* Red circle */
.row div .red-circle{
 box-shadow:2px 2px 2px 0px rgba(239,35,60,0);
}

/* Green circle */
.row div .green-circle{
 box-shadow:2px 2px 2px 0px rgba(41,191,18,0);
}
/* Image */
.row div img{
 display:none;
}



/* Column 4/12 */
.payment-card{
 
 padding:10px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Add depth to form */
         margin-left:10px;
 margin-right:10px;
}
@media (max-width:992px){

 /* Column 12/12 */
 div .col{
  left:140px !important;
 }
 
}

@media (max-width:768px){

 /* Column 4/12 */
 .payment-card{
  position:relative;
  left:-10px;
 }
 
 /* Column 12/12 */
 div .col{
  left:0px !important;
 }
 
}
/* Button */
.row div .btn{
    width:100%;
 border-style:none;
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
.row div .btn:hover{
     background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
.modal-content{
  
    font-family:'Inter';


    
    border-radius: 8px; /* Rounded corners */
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); /* Light shadow for modal */
  }
  .modal-header,
  .modal-footer {
    border-bottom: 1px solid #444444;
  }

  .modal-header .modal-title {
    font-weight: 600;
  }

  .custom-modal-footer .modal-footer .btn-secondary {
    background-color: #555555;
    color: #ffffff;
  }

  .custom-modal-footer .modal-footer .btn-primary {
    background-color: #333333;
    color: #ffffff;
  }
  /* Button Styles */
  .btn-primary {
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
  .btn-primary:hover {
     background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

  
  /* Danger Button Styles */
.btn-danger {
  background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
  padding: 14px 28px; /* Padding for consistency with primary button */
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}

.btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}

.btn-danger:focus,
.btn-danger:active {
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.3); /* Focus effect */
  transform: translateY(0); /* Reset lift effect */
}
.form-control{
    display: flex;
    align-items: center;
 
    border-style: none;
    border-radius: 8px;
    padding: 12px;
   
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5);
    min-height:50px;
    
}
.input-group-text{
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
.modal div .fsb-button{

    text-transform:capitalize;
  display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Select */
.modal div .fsb-select{
 border-style:none;
 border-top-left-radius:8px;
 border-top-right-radius:8px;
 border-bottom-left-radius:8px;
 border-bottom-right-radius:8px;
}

/* Button */
.modal div .fsb-button{
 border-style:none;
}
/* Input */
.row .mb-3 input[type=text]{
display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}





</style>
<div class="container-fluid margin-top-container">
    <div class="row">
        <div class="col mb-3 col-12 col-md-4">
            <div class="input-group mb-3">
                <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                <input type="text" id="payment_methods_search" class="form-control" placeholder="Search Payment Method" >
            </div>
        </div>
            <div id="page-loader">
                <center><svg class="spinner large" viewBox="0 0 48 48">
                        <circle class="path" cx="24" cy="24" r="20" fill="none" stroke-width="5"></circle>
                    </svg></center>
            </div>
            <div id="paymentMethods" class="page-content col col-lg-12">
            </div>
        </div>
    </div>