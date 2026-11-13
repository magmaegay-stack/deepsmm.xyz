<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="big5">

    <base href="<?= site_url() ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
   <title><?php echo htmlspecialchars($settings['site_name']); ?> Admin</title>


   
    

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <link rel="stylesheet" type="text/css" href="public/admin/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/admin/style.css">
    <link rel="stylesheet" type="text/css" href="public/admin/toastDemo.css">
	<link rel="stylesheet" type="text/css" href="public/admin/tooltip.css">
	
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">


    <link rel="stylesheet" type="text/css" href="public/admin/tinytoggle.min.css" rel="stylesheet">
 <link rel="stylesheet" href="public/admin/iziToast.min.css">
  <script src="https://kit.fontawesome.com/f9fbee3ddf.js" crossorigin="anonymous"></script>
<script src="public/admin/iziToast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">

  <link href="//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<link rel="stylesheet" href="https://itsjavi.com/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
<link rel="stylesheet" href="css/admin/image-picker.css">
	<link href="css/admin/main.css" type="text/css" rel="stylesheet">
	<script src="https://checkout.cashfree.com/js/cf-checkout.js"></script>

<style>
 @import url("https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&display=swap");
 
#loading {
position: fixed;
display: flex;
justify-content: center;
align-items: center;
width: 100%;
height: 100%;
top: 0;
left: 0;
opacity: 0.7;
background-color: #fff;
z-index: 99;
}

#loading-image {
z-index: 100;
}

#buy-smm {
margin: 8px 15px;
font-size: 15px;
font-weight: 400;
}

#buy-smm a {
cursor: pointer;
}

a , body.dark-mode  a{
    color: #2176FF;
    text-decoration: none;
}


.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {

    color: #fff;
    background-color: #2176FF;
}

.nav-pills>li >a:focus, .nav-pills>li >a:hover {
    color: #fff;
    background-color: #2176FF;
}

.btn-primary  {
   background-color: #2176FF;
}
.text-primary {
    color:#2176FF;
}
.btn-primary:hover, .btn-primary:focus  {

   background-color: #2176FF;

}

body.dark-mode .nav-pills>li.active>a, body.dark-mode .nav-pills>li.active>a:focus, body.dark-mode .nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #2176FF;
}


body .checkAll-holder {
    padding: 4px 7px 3px 5px;
    padding-bottom: 5px !important;
    border: 1px solid #ddd;
    line-height: 0;
    z-index: 2;
    position: relative;
    border-radius: 4px;
    width: 28px;
}
.badge-success {

background-color: #198754!important;
}
.badge-error,.badge-danger{
    background-color: #dc3545!important;
}

.badge-warning {
    background-color: #ffc107!important;
}

.badge-info {
    background-color: #0dcaf0!important;
}
.badge-primary {
    background-color : #0d6efd !important;
}

body.dark-mode .btn-primary {

    background-color: #2176FF;
    border-color: #2176FF;
    color: #fff;
}


body.dark-mode .list-group-item.active, body.dark-mode .list-group-item.active:focus, body.dark-mode .list-group-item.active:hover {
    z-index: 2;
    color: #fff;
    background-color: #2176FF;
    border-color: #2176FF;
}

body.dark-mode ul.thumbnails.image_picker_selector li .thumbnail {
    border: 2px solid rgba(255,255,255,0.3);
}


body.dark-mode ul.thumbnails.image_picker_selector li .thumbnail.selected {
    border: 2px solid #3CCF4E;
}


.thumbnail {
    background-color: transparent;
}


body.dark-mode .btn-primary.focus, body.dark-mode .btn-primary:focus {
    background-color: #2176FF;
    border-color: #2176FF;
    color: #fff;
}





.text-danger {
    color:#D90429;
}

body.dark-mode .btn-danger {
    color: #fff;
    background-color: #D90429;
    border-color: #D90429;
}

.btn-danger {
    background-color: #D90429;
}

.text-success {
    color:#3CCF4E;
}
.btn-success {
    background-color: #3CCF4E;
}

.btn-primary.active, .btn-primary:active, .open>.dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #2176FF;
    border-color: #2176FF;
}



.btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover {
    color: #fff;
    background-color: #2176FF;
    border-color: #2176FF;
}


body.dark-mode .btn-primary.active.focus, body.dark-mode .btn-primary.active:focus, body.dark-mode .btn-primary.active:hover, body.dark-mode .btn-primary:active.focus, body.dark-mode .btn-primary:active:focus,body.dark-mode .btn-primary:active:hover, body.dark-mode .open>.dropdown-toggle.btn-primary.focus,body.dark-mode .open>.dropdown-toggle.btn-primary:focus,body.dark-mode .open>.dropdown-toggle.btn-primary:hover {
    color: #fff;
    background-color: #2176FF;
    border-color: #2176FF;
}





.hideextra { white-space: nowrap; overflow: scroll;}
   

.info-msg,
.success-msg,
.warning-msg,
.error-msg {
  margin: 10px 0;
  padding: 10px;
  border-radius: 3px 3px 3px 3px;
}
.info-msg {
  color: #059;
  background-color: #BEF;
}
.success-msg {
  color: #270;
  background-color: #DFF2BF;
}
.warning-msg {
  color: #9F6000;
  background-color: #FEEFB3;
}
.error-msg {
  color: #D8000C;
  background-color: #FFBABA;
}

.set-currency {
    font-family: "Sansita Swashed", cursive;
  border-left: 5px solid #FF1D58;
  padding: 10px;
  letter-spacing: 5px;
  font-weight: bold;
  padding-left: 10px;
}

.sansita {
    font-family: "Sansita Swashed", cursive;
}
.set-currency.b-blue {
   border-left: 5px solid #4285F4;
}
.disabledDiv {

    pointer-events: none;

    opacity: 0.4;
}

.select {
 
  padding: 7px 40px 7px 12px;
  width: 100%;
  border: 1px solid #e8eaed;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0 1px 3px -2px #9098a9;
  cursor: pointer;
  font-family: inherit;
  font-size: 16px;
  transition: all 150ms ease;
}


.select:required:invalid {
  color: #5a667f;
}
.select option {
  color: #223254;
}
.select option[value=""][disabled] {
  display: none;
}
.select:focus {
  outline: none;
  border-color: #07f;
  box-shadow: 0 0 0 2px rgba(0,119,255,0.2);
}
.select:hover + svg {
  stroke: #07f;
}

.form-control:focus {

  outline: none;

  border-color: #07f;
  box-shadow: 0 0 0 2px rgba(0,119,255,0.2);
}

.curr_conv {
   border:1px solid lightgrey;
   border-radius:5px;
}
.toggle {
  align-items: center;
  border-radius: 100px;
  display: flex;
  float:right;
  font-weight: 700;
  margin-top:-3px;
}


.toggle__input {
  clip: rect(0 0 0 0);
  clip-path: inset(50%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.toggle__input:not([disabled]):active + .toggle-track, .toggle__input:not([disabled]):focus + .toggle-track {
  border: 1px solid transparent;
  box-shadow: 0px 0px 0px 2px #121943;
}
.toggle__input:disabled + .toggle-track {
  cursor: not-allowed;
  opacity: 0.7;
}

.toggle-track {
  background: #fff;
  border: 1px solid #000000;
  border-radius: 100px;
  cursor: pointer;
  display: flex;
  height: 30px;
  margin-right: 12px;
  position: relative;
  width: 60px;
}

.toggle-indicator {
  align-items: center;
  background:#ff4444;
  border-radius: 24px;
  bottom: 2px;
  display: flex;
  height: 24px;
  justify-content: center;
  left: 2px;
  outline: solid 2px transparent;
  position: absolute;
  transition: 0.25s;
  width: 24px;
}


.checkMark {
  fill: #fff;
  height: 20px;
  width: 20px;
  opacity: 0;
  transition: opacity 0.25s ease-in-out;
}



.toggle__input:checked + .toggle-track .toggle-indicator {
  background: #00C851;
  transform: translateX(30px);
}
.toggle__input:checked + .toggle-track .toggle-indicator .checkMark {
  opacity: 1;
  transition: opacity 0.25s ease-in-out;
}


@media screen and (-ms-high-contrast: active) {
  .toggle-track {
    border-radius: 0;
  }
}


.form__group{
  padding:0.5rem;
}
.form__controls{
  margin-top:.2rem;
}
.form__input{
  width:100%;

}
.form__submit{
  margin-top: .5rem;
  width: 10rem;
  height: 3rem;
}

.grid{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.grid__col{
  flex-basis: 50%;
}


.button-1 {
  background-color: #EA4C89;
  border-radius: 8px;
  border-style: none;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  font-weight: 500;
  height: 40px;
  line-height: 20px;
  list-style: none;
  margin: 0;
  outline: none;
  padding: 10px 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  vertical-align: baseline;
  user-select: none;
  -webkit-user-select: none;
}
.add-currency {
    background-color: #439A97;
    float:right;
}


#headertext {
    font-size: 15px;
    font-weight: 700;
    padding: 3px;
    margin: 0px;
    width: 100%;
    border: 2px solid black;
    background-color: rgb(255, 255, 255);
}


.loader,
.loader:after {
  border-radius: 50%;
  width: 10em;
  height: 10em;
}
.loader {
  font-size: 5px;
  position: relative;
  text-indent: -9999em;
  border-top: 0.7em solid rgba(55, 114, 255, 0.2);
  border-right: 0.7em solid rgba(55, 114, 255, 0.2);
  border-bottom: 0.7em solid rgba(55, 114, 255, 0.2);
  border-left: 0.7em solid rgb(55, 114, 255);
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: load8 1.1s infinite linear;
  animation: load8 0.8s infinite linear;
}

body.dark-mode .loader {
  border-top: 0.7em solid rgba(255, 22, 84, 0.2);

  border-right: 0.7em solid rgba(255, 22, 84, 0.2);

  border-bottom: 0.7em solid rgba(255, 22, 84, 0.2);
  border-left: 0.7em solid rgb(255, 22, 84);
}
@-webkit-keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@media screen and (min-width : 906px){
 .navbar-header {
  display:none;
  }
}


.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: #fff;
    background-color: #2176FF;
    border-color: #2176FF;
}
.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 40px;
    height: 40px;
}
ul.thumbnails.image_picker_selector li .thumbnail {
    padding: 3px;
    border: 2px solid #DDD;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

ul.thumbnails.image_picker_selector li .thumbnail.selected {
    border : 2px solid #3CCF4E;
    border-radius:4px;
    background: none;
}
ul.thumbnails.image_picker_selector li {
    margin: 0px 4px 4px 0px;
}

 .services-table {
    overflow-x: scroll;
    overflow-y: visible;
 }
.service-block__header {
    width:calc(100% + 50px);
}
.service-block__category {
    width:calc(100% + 50px);
}
.category-visibility {
    width: 14px;
    height: 14px;
    border-radius:50%;
    display:inline-block;
    margin-right : 10px;
    cursor:pointer;
}
.category-visibility.category-visible {
    background-color: rgb(0, 128, 1);
    box-shadow: 0 0 0 2px #95c794;
}

.category-visibility.category-invisible {
    background-color: #fe0000;
    box-shadow:0 0 0 2px #f99394;
}
.spinner_2 {
  pointer-event: none;
  -webkit-animation: rotate 1.5s linear infinite;
  animation: rotate 1.5s linear infinite;
  width: 3.2rem;
  height: 3.2rem;
  transition: opacity 0.3s linear 0.15s;
  margin-right : 10px;

}

.spinner_2.large {
    width: 4rem;

  height: 4rem;
}

.spinner_2.medium {
    width: 2.5rem;
  height: 2.5rem;
}

.spinner_2.small {
    width: 1.6rem;
  height: 1.6rem;
}



 .spinner_2 .path_2 {
  stroke: #007bff;
  stroke-linecap: round;
  -webkit-animation: dash_1 1.5s ease-in-out infinite;
  animation: dash_1 1.5s ease-in-out infinite;
}

@-webkit-keyframes rotate {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes rotate {
  100% {
    transform: rotate(360deg);
  }
}
@-webkit-keyframes dash_1 {
  0% {
    stroke-dasharray: 1, 150;
    stroke-dashoffset: 0;
  }
  50% {
    stroke-dasharray: 90, 150;
    stroke-dashoffset: -35;
  }
  100% {
    stroke-dasharray: 90, 150;
    stroke-dashoffset: -124;
  }
}
@keyframes dash_1 {
  0% {
    stroke-dasharray: 1, 150;
    stroke-dashoffset: 0;
  }
  50% {
    stroke-dasharray: 90, 150;
    stroke-dashoffset: -35;
  }
  100% {
    stroke-dasharray: 90, 150;
    stroke-dashoffset: -124;
  }
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
    border-width: .2em;
}
.spinner-border {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: text-bottom;
    border: .25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: spinner-border .75s linear infinite;
    animation: spinner-border .75s linear infinite;
}

@keyframes spinner-border {
100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
}
}


.img-responsive {
    max-width: calc(1em + 10px);
    max-height: calc(1em + 10px);
}

.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-block;
}

.img-responsive {
    max-width: 100%;
    height: auto;
}

@media (max-width: 767px) {
    .table-responsive .dropdown-menu {
position: relative !important;
    }
}
li > a.nav-link {
    color:#000;
}
li.active > a.nav-link {
    color:#fff;
}

.navbar-nav a {
    color:#2176FF !important;
}


.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
    color:#fff !important;
    background-color: #2176FF !important;
}

.product-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #fff;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
  padding: 10px;
  border-radius: 10px;
  transition: all 0.2s ease-in-out;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-icon img {
  width: 100%;
  max-width: 80px;
  height: 80px;
  object-fit: contain;
}

.product-details {
  margin: 20px 0;
  text-align: center;
}

.product-name {
  font-size: 24px;
  font-weight: bold;
  margin: 0;
  color: #333;
}

.product-price {
  font-size: 18px;
  color: #555;
  margin: 10px 0;
}


.buy-button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.buy-button:hover {
  background-color: #0069d9;
  transform: scale(1.1);
}

@media (min-width: 768px) {
  .product-card {
    flex-direction: row;
    justify-content: space-between;
  }
  
  .product-icon img {
    max-width: none;
    height: 150px;
  }
  
  .product-details {
    margin: 0;
    text-align: left;
  }
  
  .product-name {
    font-size: 28px;
  }
  
  .product-price {
    font-size: 20px;
  }
}


.switch {
  display: block;
  margin: 12px auto;
}

.switch {
  position: relative;
  display: inline-block;
  vertical-align: top;
  width: 56px;
  height: 20px;
  padding: 3px;
  border-radius: 18px;
}

.switch-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.switch-label {
  position: relative;
  display: block;
  height: inherit;
  font-size: 10px;
  text-transform: uppercase;
  background: #eceeef;
  border-radius: inherit;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
  -webkit-transition: 0.15s ease-out;
  -moz-transition: 0.15s ease-out;
  -o-transition: 0.15s ease-out;
  transition: 0.15s ease-out;
  -webkit-transition-property: opacity background;
  -moz-transition-property: opacity background;
  -o-transition-property: opacity background;
  transition-property: opacity background;
}
.switch-label:before, .switch-label:after {
  position: absolute;
  top: 50%;
  margin-top: -.5em;
  line-height: 1;
  -webkit-transition: inherit;
  -moz-transition: inherit;
  -o-transition: inherit;
  transition: inherit;
}
.switch-label:before {
  content: attr(data-off);
  right: 11px;
  color: #aaa;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
  content: attr(data-on);
  left: 11px;
  color: white;
  text-shadow: 0 1px rgba(0, 0, 0, 0.2);
  opacity: 0;
}
.switch-input:checked ~ .switch-label {
  background: rgb( 4, 231, 98);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
  opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
  opacity: 1;
}

.switch-handle {
  position: absolute;
  top: 4px;
  left: 4px;
  width: 18px;
  height: 18px;
  background: white;
  border-radius: 10px;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
  background-image: -webkit-linear-gradient(top, white 40%, #f0f0f0);
  background-image: -moz-linear-gradient(top, white 40%, #f0f0f0);
  background-image: -o-linear-gradient(top, white 40%, #f0f0f0);
  background-image: linear-gradient(to bottom, white 40%, #f0f0f0);
  -webkit-transition: left 0.15s ease-out;
  -moz-transition: left 0.15s ease-out;
  -o-transition: left 0.15s ease-out;
  transition: left 0.15s ease-out;
}
.switch-handle:before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -6px 0 0 -6px;
  width: 12px;
  height: 12px;
  background: #f9f9f9;
  border-radius: 6px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
  background-image: -webkit-linear-gradient(top, #eeeeee, white);
  background-image: -moz-linear-gradient(top, #eeeeee, white);
  background-image: -o-linear-gradient(top, #eeeeee, white);
  background-image: linear-gradient(to bottom, #eeeeee, white);
}
.switch-input:checked ~ .switch-handle {
  left: 34px;
  box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}

.switch-green > .switch-input:checked ~ .switch-label {
  background: #4fb845;
}



/* ==================== DEEPSMM EMERALD GREEN THEME OVERRIDES ==================== */
:root {
    --primary-green: #10b981;
    --primary-green-hover: #059669;
    --primary-green-glow: rgba(16, 185, 129, 0.35);
}

a, body.dark-mode a {
    color: #10b981 !important;
}
a:hover, body.dark-mode a:hover {
    color: #34d399 !important;
}

.btn-primary, body.dark-mode .btn-primary, .btn-primary:focus, body.dark-mode .btn-primary:focus {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    border-color: #059669 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 14px var(--primary-green-glow);
    transition: all 0.25s ease;
}

.btn-primary:hover, body.dark-mode .btn-primary:hover {
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%) !important;
    border-color: #10b981 !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45);
}

.text-primary, body.dark-mode .text-primary {
    color: #10b981 !important;
}

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover,
body.dark-mode .nav-pills>li.active>a, body.dark-mode .nav-pills>li.active>a:focus, body.dark-mode .nav-pills>li.active>a:hover {
    background-color: #10b981 !important;
    border-color: #10b981 !important;
    color: #fff !important;
    box-shadow: 0 4px 12px var(--primary-green-glow);
}

.navbar-default, body.dark-mode .navbar-default {
    background: #090e1a !important;
    border-bottom: 1px solid rgba(16, 185, 129, 0.2) !important;
}

.navbar .container-fluid #navbar .navbar-left-block .active a,
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
    background-color: #10b981 !important;
    color: #fff !important;
    border-radius: 6px;
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover,
.pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    background-color: #10b981 !important;
    border-color: #10b981 !important;
}

.panel-primary>.panel-heading {
    background-color: #059669 !important;
    border-color: #059669 !important;
}

body.dark-mode .list-group-item.active, body.dark-mode .list-group-item.active:focus, body.dark-mode .list-group-item.active:hover {
    background-color: #10b981 !important;
    border-color: #10b981 !important;
}

.table-hover>tbody>tr:hover {
    background-color: rgba(16, 185, 129, 0.06) !important;
}

.badge-primary {
    background-color: #10b981 !important;
}
/* ============================================================================== */

</style>
<style>
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Container fluid */
.navbar .container-fluid{
 font-family:'Inter', sans-serif;
}

.container-fluid .dropdown-menu li a {
    
    border-width:1px !important;
    width : 100% !important;
    color: #ffffff; /* Text color */
    padding: 14px 28px; /* Padding for a more prominent button */
    font-size: 14px; /* Font size */
    font-weight: 500; /* Font weight */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slightly rounded corners */
    
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}

/* Dropdown toggle */
.navbar-left-block li .dropdown-toggle{
 color:#5a5a5a !important;
}

/* Ajax link */
.navbar .container-fluid #navbar .navbar-left-block > li > .ajax-link{
 color:#5a5a5a !important;
}



/* Link */
.navbar .container-fluid #navbar .navbar-left-block .active a{
 color:#ffffff !important;
 
}

.dropdown-menu>li>a{
 color:#5a5a5a !important;
}
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
     background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
     
     font-size: 14px;
    font-weight: 500;
}
     .navbar-nav li.active{
         background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
     
     }
     .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
         background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
     
     font-size: 14px;
    font-weight: 500;
}
/* Alert Division */
.alert-warning{
 text-align:center;
 color:#2c3e50;

}

/* Pull left */
.container a .pull-left{
 color:#2c3e50;
}
.nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
    background-color: unset !important;
}

/* ==================== DEEPSMM EMERALD GREEN THEME OVERRIDES ==================== */
:root {
    --primary-green: #10b981;
    --primary-green-hover: #059669;
    --primary-green-glow: rgba(16, 185, 129, 0.35);
}

a, body.dark-mode a {
    color: #10b981 !important;
}
a:hover, body.dark-mode a:hover {
    color: #34d399 !important;
}

.btn-primary, body.dark-mode .btn-primary, .btn-primary:focus, body.dark-mode .btn-primary:focus {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    border-color: #059669 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 14px var(--primary-green-glow);
    transition: all 0.25s ease;
}

.btn-primary:hover, body.dark-mode .btn-primary:hover {
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%) !important;
    border-color: #10b981 !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45);
}

.text-primary, body.dark-mode .text-primary {
    color: #10b981 !important;
}

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover,
body.dark-mode .nav-pills>li.active>a, body.dark-mode .nav-pills>li.active>a:focus, body.dark-mode .nav-pills>li.active>a:hover {
    background-color: #10b981 !important;
    border-color: #10b981 !important;
    color: #fff !important;
    box-shadow: 0 4px 12px var(--primary-green-glow);
}

.navbar-default, body.dark-mode .navbar-default {
    background: #090e1a !important;
    border-bottom: 1px solid rgba(16, 185, 129, 0.2) !important;
}

.navbar .container-fluid #navbar .navbar-left-block .active a,
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
    background-color: #10b981 !important;
    color: #fff !important;
    border-radius: 6px;
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover,
.pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    background-color: #10b981 !important;
    border-color: #10b981 !important;
}

.panel-primary>.panel-heading {
    background-color: #059669 !important;
    border-color: #059669 !important;
}

body.dark-mode .list-group-item.active, body.dark-mode .list-group-item.active:focus, body.dark-mode .list-group-item.active:hover {
    background-color: #10b981 !important;
    border-color: #10b981 !important;
}

.table-hover>tbody>tr:hover {
    background-color: rgba(16, 185, 129, 0.06) !important;
}

.badge-primary {
    background-color: #10b981 !important;
}
/* ============================================================================== */

</style>
</head>

<body>

    <div class="container">
<div class="row">
<div id="loading">
<div class="loader">Loading...</div>
</div>
</div>
</div>
<body class="<?php if($admin["mode"]=="dark" ): echo "dark-mode" ; endif; ?>">

<nav class="navbar navbar-static-top  navbar-default">
<div class="container-fluid">
<div class="navbar-header">
<?php $brand_logo = json_decode($ADMIN_CONSTANTS["brand_logo"]);?>
<a class="navbar-brand" href="<?= site_url("$rentaladmin") ?>" style="display:flex;align-items:center;padding:8px 15px;height:50px;">
  <img src="/public/Eternity/logo.png" alt="DeepSMM" style="height:34px;max-width:140px;object-fit:contain;">
</a>

<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>

</div>
<div id="navbar" class="collapse navbar-collapse">

<ul class="nav navbar-nav navbar-left-block">
<?php if ($admin["access"]["admin_access"]  && $_SESSION["msmbilisim_adminlogin"]) : ?>
<?php if ($admin["access"]["admin_access"]): ?>
<li class="<?php if(route(1) == "index"): echo 'active' ; endif; ?>">
<a class="ajax-link"
href="<?php echo site_url("$rentaladmin") ?>">Dashboard</a>
</li>

<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["users"]): ?>
<li class="" class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
aria-haspopup="true" aria-expanded="false">
  Users <span class="caret"></span></a>

<ul class="dropdown-menu dropdown-max-height">
<li class="<?php if (route(1) == "clients") : echo 'active' ; endif; ?>"><a class="ajax-link"
href="<?php echo site_url("$rentaladmin/clients") ?>"><span>Users</span></a>
</li>

<li><a class="ajax-link" href="<?php echo site_url("$rentaladmin/special-pricing");?>">Special Pricing</a></li>
</ul></li>
<?php endif; ?>



<?php if ($admin["access"]["admin_access"] && $admin["access"]["orders"]): ?>
<li class="" class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
aria-haspopup="true" aria-expanded="false">Orders <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-max-height">

<?php if ($admin["access"]["admin_access"] && $admin["access"]["orders"]): ?>
<li class="<?php if (route(1) == "orders") : echo 'active' ; endif; ?>"><a
class="ajax-link" href="<?php echo site_url("$rentaladmin/orders") ?>"><span>Orders</span></a></li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["tasks"]): ?>
<li class="<?php if (route(1) == "tasks") : echo 'active' ; endif; ?>"><a class="ajax-link" href="<?php echo site_url("$rentaladmin/tasks") ?>"><span>Refill and Cancel Tasks</span></a></li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["dripfeed"]): ?>
<?php if(countRow(["table"=>"orders","where"=>["dripfeed"=>2]])>0){   ?>
<li class="<?php if (route(1) == " dripfeed") : echo 'active' ; endif; ?>"><a
class="ajax-link" href="<?php echo site_url("$rentaladmin/dripfeed") ?>"><span>Drip-Feed</span></a></li>
<?php

}else{
}
?>
<?php endif; ?>


<?php if(countRow(["table"=>"orders","where"=>["subscriptions_type"=>2]])>0){
?>
<li class="<?php if (route(1) == "subscriptions") : echo 'active' ; endif; ?>"><a
class="ajax-link" href="<?php echo site_url("$rentaladmin/subscriptions") ?>"><span> Subscriptions</span></a></li>
<?php
 } else {

}
?>
</ul>
</li>

<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["services"]): ?>

<li class="" class="dropdown">

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
aria-haspopup="true" aria-expanded="false">
 Services <span class="caret"></span></a>

<ul class="dropdown-menu dropdown-max-height">

<?php if ($admin["access"]["admin_access"] && $admin["access"]["services"]): ?>
<li class="<?php if (route(1) == "services") : echo 'active' ; endif; ?>"><a
class="ajax-link" href="<?php echo site_url("$rentaladmin/services") ?>"><span>Services</span></a></li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["update-prices"]): ?>
<li class="<?php if (route(1) == "update-prices") : echo 'active' ; endif; ?>"><a
class="ajax-link" href="<?php echo site_url("$rentaladmin/update-prices") ?>"><span>Update Prices</span></a></li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["bulk"]): ?>
<li class="<?php if (route(1) == "bulk") : echo 'active' ; endif; ?>"><a
class="ajax-link" href="<?php echo site_url("$rentaladmin/bulk") ?>"><span>Bulk Services & Categories Manager</span></a></li>
<?php endif; ?>






</ul></li>
<?php endif; ?>
<li><a class="ajax-link" href="<?php echo site_url("$rentaladmin/fund-add-history");?>">Payments</a></li>



<?php if ($admin["access"]["admin_access"] && $admin["access"]["tickets"]): ?>
<li class="<?php if (route(1) == "tickets") : echo 'active' ; endif; ?>"><a class="ajax-link"
href="<?php echo site_url("$rentaladmin/tickets") ?>"><span>Support
<?php if(countRow(["table"=>"tickets","where"=>["client_new"=>2]])>0){

?><span class="badge" style="background-color:#cc9616 ">
<?=countRow(["table"=>"tickets","where"=>["client_new"=>2]]);?>
</span>
<?php
} else{
}
?>

</span></a>
</li>
<?php endif; ?>


<?php if ($admin["access"]["admin_access"] && $admin["access"]["additionals"]): ?>
<li class="dropdown">
<a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true"
aria-expanded="false">Menu <span
class="caret"></span></a>

<ul class="dropdown-menu dropdown-max-height">

<?php if ($admin["access"]["admin_access"] && $admin["access"]["referral"]): ?>
<li class="<?php if (route(1) == "payouts" || route(1) == "referrals") : echo 'active' ; endif; ?>"><a
    class="ajax-link" href="<?php echo site_url("$rentaladmin/referrals") ?>"><span>Affiliates</span></a></li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["broadcast"]): ?>
<li class="<?php if (route(1) == "broadcasts") : echo 'active' ; endif; ?>"><a
    class="ajax-link" href="<?php echo site_url("$rentaladmin/broadcasts") ?>"><span>Notifications</span></a>
</li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["logs"]): ?>
<li class="<?php if (route(1) == "logs") : echo 'active' ; endif; ?>"><a class="ajax-link" href="<?php echo site_url("$rentaladmin/logs") ?>"><span>Logs</span></a>
</li>
<?php endif; ?>


<?php if ($admin["access"]["admin_access"] && $admin["access"]["reports"]): ?>
<li class="<?php if (route(1) == "reports") : echo 'active' ; endif; ?>"><a class="ajax-link" href="<?php echo site_url("$rentaladmin/reports") ?>"><span>Reports</span></a>
</li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["coupon"]): ?>
<li class="<?php if (route(1) == "kuponlar") : echo 'active' ; endif; ?>"><a
    class="ajax-link" href="<?php echo site_url("$rentaladmin/kuponlar") ?>"><span>Coupon Code</span></a></li>
<?php endif; ?>

<?php if ($admin["access"]["admin_access"] && $admin["access"]["child-panels"]): ?>
<li class="<?php if (route(1) == "child-panels") : echo 'active' ; endif; ?>"><a
    class="ajax-link" href="<?php echo site_url("$rentaladmin/child-panels") ?>"><span>Child Panels</span></a></li>
<?php endif; ?>


</ul>

<?php endif; ?>

<?php if ($admin["access"]["admin_access"]): ?>
<li class="" class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
aria-haspopup="true" aria-expanded="false">
  Control Panel <span class="caret"></span></a>

<ul class="dropdown-menu dropdown-max-height">
<li class="<?php if (route(1) == "appearance") : echo 'active' ; endif; ?>"><a class="ajax-link"
href="<?php echo site_url("$rentaladmin/appearance") ?>"><span>
Appearance</span></a>
</li>

<li class="<?php if (route(1) == "settings") : echo 'active' ; endif; ?>"><a class="ajax-link"
href="<?php echo site_url("$rentaladmin/settings") ?>"><span>Settings</span></a></li>
</ul></li>
<?php endif; ?>







<li class="dropdown">
<a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true"
aria-expanded="false"> Manage
<span class="caret"></span></a>
<ul class="dropdown-menu">

<?php if ($admin["access"]["admin_access"] && $admin["access"]["manager"]): ?>
<li class="<?php if(route(1) == "manager") : echo "active" ; endif;?>"><a href="<?php echo site_url("$rentaladmin/manager"); ?>" class="ajax-link"> Staff Members</a></li>
<?php endif; ?>

<li class="<?php if (route(1) == "account") : echo 'active' ; endif; ?>"><a class="ajax-link"
href="<?php echo site_url("$rentaladmin/account") ?>"><span>
    Account</span></a>
</li>

<li><a class="ajax-link" href="https://<?php echo "$url/"; echo $rentaladmin; ?>/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>

</li>
</ul>
</li>

<?php endif; ?>







</ul>
    </div>

</div>
</nav>
