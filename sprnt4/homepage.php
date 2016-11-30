<!DOCTYPE html>
<html>
<head>
	
	<?php $this->load->helper('url'); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/bootstrap.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/style.css'; ?>">
	<script type="text/javascript" src="<?php echo base_url().'js/jquery-2.2.3.min.js';?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'js/bootstrap.min.js';?>"></script>
	<title></title>

  <script type="text/javascript">
    $(document).ready(function()
    {
    
    function un_friend(uid)
    {

      $("#"+uid).click(function(){
        alert(uid);
        var frnd=$("#rqst_sesion").val();
        alert(frnd);
        $.ajax({
          type:"POST",
          url:'http://localhost/serv/index.php/frd_search/unfrnd',
          data:{sender:uid,reciver:frnd},
          dataType:"json",

          success:function(data)
          {
            console.log(data)
            alert(data);
          }
        });
      });
        
    }

    /*view friends*/
    $("#btn_search").click(function(){
     
      var frnd=$("#rqst_sesion").val();
      $("#frnd_rqsts").hide();
      $("#frnd_users").hide();
      $("#frnd_viw").show();
      alert(frnd);
      $.ajax({
          type:"POST",
          url:'http://localhost/serv/index.php/frd_search/search_frnds',
          data:{name:frnd},
          dataType:"json",

          success:function(data)
          {
            console.log(data);
            alert(data);
             $("#status_updt").hide();
                 
                 l=data.length;
                 var txt="";
    
                 for (var i = 0; i <l; i++) {
                   // console.log(data[i].firstname);
                   uid=data[i].id;
                  
                   txt +="<div class='col-md-12 col-xs-12'><div class='col-md-2 col-xs-3'><img src='http://localhost/facebook/images/"+data[i].file+"' style='height:100px;width:100px;'></div><div class='col-md-3 col-xs-3 mar_frnd mar_unfrnd'>"+data[i].firstname+"   "+data[i].surname+"</div><div class=' col-md-3 col-xs-3 mar_unfrnd'><button id='"+data[i].id+"'>unfriend</button></div></div>"
          }
           console.log(txt);
                $("#frnd_viw").append(txt).removeClass('hidden');
                console.log(uid);
                un_friend(uid);
            
        },
      });
      
    });
    function cnfirm_rqst(uid,email)
    {

     var r=$("#rqst_sesion").val();
     $("#"+uid).click(function(){
      alert(email);
      alert(r);
      alert(uid);
      $.ajax({
        type:"POST",
              url:'http://localhost/serv/index.php/Frd_search/accpt_rqst',
              data:{sender:uid,reciver:r,email:email},
              dataType:"json",

               success:function(data)
              {
                console.log(data);
                alert(data);
               
              }

      });

     });
    }

  

      // aprv rqst
     $("#btn_apr").click(function(){
        // alert("asas");
        $("#frnd_viw").hide();
        $("#frnd_users").hide();
        $("#frnd_rqsts").show();
        var aprv=$("#rqst_sesion").val();
        //alert(aprv);
        $.ajax({
          type:"POST",
          url:'http://localhost/serv/index.php/frd_search/vw_rqst',
          data:{id:aprv},
          dataType:"json",

          success:function(data)
          {
            console.log(data);
            alert(data);
            $("#status_updt").hide();
            console.log(data);
             l=data.length;
                var txt="";

                for (var i=0; i < l; i++) {

                uid=data[i].id;
                email=data[i].mobile_no;
                txt +="<div class='col-md-12 col-xs-12'><div class='col-md-2 col-xs-3'><img src='http://localhost/facebook/images/"+data[i].file+".jpg' style='height:100px;width:100px;'></div><div class='col-md-3 col-xs-3 mar_frnd'>"+data[i].firstname+"   "+data[i].surname+"</div><div class=' col-md-2 col-xs-2'><button id='"+data[i].id+"'>confirm</button></div><div class='col-md-3 col-xs-3'><button>DeleteRequest</button></div></div>"

                }
                console.log(txt);
                $("#frnd_rqsts").append(txt).removeClass('hidden');
                console.log(uid);
                cnfirm_rqst(uid,email);


          },
        });
      });


      

      function send_reqst(uid,email)
      {
          var s=$("#rqst_sesion").val();

          $("#"+uid).click(function(){
            alert(s);
            $.ajax({
              type:"POST",
              url:'http://localhost/serv/index.php/Frd_search/addfrnd',
              data:{sender:s,reciver:uid},
              dataType:"json",

              success:function(data)
              {
                console.log(data);
                alert(data);
               
              }

            });
            

          });
      }

      /*search friends*/


      /*Search user*/
        $("#vsearch").click(function(){
          var vname= $("#vtext").val();
           $("#frnd_viw").hide();
           $("#frnd_rqsts").hide();  
           $("#frnd_users").show();      
              $.ajax({
              type:"POST",
               url: 'http://localhost/serv/index.php/Frd_search/search',
                data: {name:vname},
                dataType:"json",
             
              success: function(data)
              {
                 // alert(data);
                 $("#status_updt").hide();
                 console.log(data);
                 l=data.length;
                 var txt="";
                     
                 for (var i = 0; i <l; i++) {
                   // console.log(data[i].firstname);

                   uid=data[i].id;
                   email=data[i].mobile_no;
                   txt +="<div class='col-md-12 col-xs-12'><div class='col-md-2 col-xs-3'><img src='http://localhost/facebook/images/"+data[i].file+".jpg' style='height:100px;width:100px;'></div><div class='col-md-3 col-xs-3 mar_frnd'>"+data[i].firstname+"   "+data[i].surname+"</div><div class=' col-md-3 col-xs-3'><button id="+data[i].id+">Add Friend</button></div></div>"

                 }
                 console.log(txt);
                 $("#frnd_users").append(txt).removeClass('hidden');
                 console.log(uid);
                 send_reqst(uid,email);
                },
            
             });        
         });
      });

  </script>


</head>
<body>
  <input type="" value="<?php echo $this->session->userdata('id'); ?>" name="" style="display:none" id='rqst_sesion'>
    <div class=" container-fluid">
    <div class="row head">
   	<div class=" col-md-5  col-xs-5 search_pad">
   		   <input type="text" name="" id="vtext" class="form-control " placeholder="Search Facebook" value="rahulk">
    </div>
    <div class="col-md-1 col-xs-2">
            <input type="button" id="vsearch" name="" value="Search" class="btn-primary form-control btn_search">
   	</div>
   	<div class="col-md-offset-1 col-md-3 col-xs-offset-1 col-xs-3 ">
   		   	 <img src="<?php echo base_url().'images/';?><?php echo $file.'.jpg'; ?>" class="search_photo">
   		   	 <label style="color:white"><?php echo $firstname." ".$surname; ?></label>
    </div>
   	</div>    
    <div class="row color">
    <div class="col-md-3 col-xs-3">
    <div class="col-md-12 col-xs-12 pad_5">
            <img src="<?php echo base_url().'images/';?><?php echo $file.'.jpg';?>" class="tags">
            <label><?php echo $firstname." ".$surname; ?></label>
    </div>
    <div class="col-md-12 col-xs-12 pad_5">
                 <img src="<?php echo base_url().'images/edit.png';?>" class="tags">
                 <label>Edit profile</label>   
    </div>
    <div class="col-md-12 col-xs-12 pad_5">
              <img src="<?php echo base_url().'images/edit.png';?>" class=tags>
              <input type="button" name="" id="btn_apr" value="Approve friend"  style="background-color:lightgrey;border:0;" >
              </div>
     <div class="col-md-12 col-xs-12 pad_5">
              <img src="<?php echo base_url().'images/edit.png';?>" class=tags>
              <input type="button" name="" id="btn_search" value="search friend"  style="background-color:lightgrey;border:0;" >
              </div>

    </div>	

        <!-- view users -->
        <div class="col-md-6 col-xs-7 cnt_color pad_5 hidden " id="frnd_users" >
          
        </div>
        <!-- view rqsts -->
        <div class="col-md-6 col-xs-7 cnt_color pad_5 hidden " id="frnd_rqsts" >
          
        </div>
       <!-- view frnds -->
        <div class="col-md-6 col-xs-7 cnt_color pad_5 hidden " id="frnd_viw" >
          
        </div>
        <!-- profile pic & status_update -->
       <div class="col-md-6 col-xs-7 cnt_color pad_5" id="status_updt">
        	<div class="col-md-4 col-xs-4 cnt_color pad_5">
                <img src="<?php echo base_url().'images/edit.png';?>" class="tag1">
                <label>Update status</label>
          </div>	
          <div class="col-md-4 col-xs-4 cnt_color pad_5">
                      <img src="<?php echo base_url().'images/edit.png';?>" class="tag1">
                      <label>Add Photos/Video</label>
          </div>
          <div class="col-md-4 col-xs-4 cnt_color pad_5">
                      <img src="<?php echo base_url().'images/edit.png';?>" class="tag1">
                      <label>Write Note</label>
          </div>
          <div class="col-md-12 col-xs-12 tag3">
              		    <hr>
          <div class=" col-md-6 col xs-7 status_color pad_5 ">
                      <img src="<?php echo base_url().'images/';?><?php echo $file.'.jpg';?>" class="tag2">
   		   	            What's on your mind? 
          </div>
          </div>
         </div>
           <div class="col-md-2 col-xs-2 pad_select">
                       <select class="form-control "><option>Your Ads</option></select>
           </div>
        
         <div class="col-md-12 col-xs-12"></div>
           <div class=" col-md-offset-3 col-md-6 col-xs-offset-3 col-xs-7 cnt_color margin">
           </div>
         </div>
   		    	
   	
   			
   </div>
 
   	
  

</body>
</html>