<!DOCTYPE html>
 
<html>
 
<head>
 
 <title>Notification using PHP Ajax Bootstrap</title>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style>
     .count {
  color: white;
  background-color: red;
     }
 </style>
</head>
 
<body>
 
 <br /><br />
 
 <div class="container">
 
  <nav class="navbar navbar-inverse">
 
   <div class="container-fluid">
 
    <div class="navbar-header">
 
     <a class="navbar-brand" href="#">PHP Notification System</a>
 
    </div>
 
    <ul class="nav navbar-nav navbar-right">
 
     <li class="dropdown">
 
      <a href="#" class="dropdown-toggle sample" data-toggle="dropdown">
          <span class="label label-pill  count" style="border-radius:10px;">
              
          </span> 
          <span class="glyphicon glyphicon-bell" style="font-size:18px;">
              
          </span></a>
 
      <ul class="dropdown-menu"></ul>
 
     </li>
 
    </ul>
 
   </div>
 
  </nav>
 
  <br />
 
  <form method="post" id="comment_form" action="">
 
   <div class="form-group">
 
    <label>Enter Subject</label>
 
    <input type="text" name="subject" id="subject" class="form-control">
 
   </div>
 
   <div class="form-group">
 
    <label>Enter Comment</label>
 
    <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
 
   </div>
 
   <div class="form-group">
 
    <input type="submit" name="post" id="post" class="btn btn-info" value="Post" >
    <?php echo date('d-m-Y') ?>
 
   </div>
 
  </form>
 
 
 </div>
 
</body>
 <script>
 
$(document).ready(function(){
 
 //updating the view with notifications using ajax

function load_unseen_notification(view = '')
 
{

 $.ajax({
 
  url:"<?php echo base_url();?>Notify/user_notifi",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
 
  {
     
   $('.dropdown-menu').html(data.notification);
   $('.count').show();
   if(data.unseen_notification > 0)
   {
       
    $('.count').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('.count').hide();

   }
 
  }
 
 });
 
}
 
load_unseen_notification();
 
 //submit form and get new records
 
$('#comment_form').on('submit', function(event){
 event.preventDefault();
 

 var subject=document.getElementById('subject').value;
  var comment=document.getElementById('comment').value;
  
 if(subject!=""||comment!="")
 {
  $.ajax({
 
   url:"<?php echo base_url();?>Notify/submit_comm",
   method:"POST",
   data:{subject:subject,comment:comment},
   success:function(data)
 
   {
 
    $('#comment_form')[0].reset();
    load_unseen_notification();
 
   }
 
  });
 
 }
 
 else
 
 {
  alert("Both Fields are Required");
 }
 
});
 
// load new notifications
 
$(document).on('click', '.dropdown-toggle', function(){
 
 $('.count').html('');
 
 load_unseen_notification('yes');
 
});
 
setInterval(function(){
 
 load_unseen_notification();;
 
}, 5000);
 
});
 
</script>
</html>
