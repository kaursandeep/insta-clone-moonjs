<?php
// Start the session
session_start();
if($_SESSION["user"]) {
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Instagram</title>
    	<!--Favicon image-->
    	<link rel="shortcut icon" type="img/png" href="images/favicon.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!--Boostrap css file-->
        <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    	<!--Boostrap responsive css file-->
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    	<!--Custom css file-->
        <link rel="stylesheet" href="css/style.css">
        
        <!--Jquery scripts-->
        <script src="js/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
            /*global $*/
            //handle a click on the LIKE button we've included with each post
            //we receive the ID of the post as a parameter
            function likeClick(id){
                
                $.ajax({
                            url: '/incrlike.php',
                            type: 'GET',
                            //dataType: 'json',
                            data:'id='+id, //get request
                            //we want to send it untouched, so this needs to be false
                            processData: false,
                            contentType: false,
                            //add a message 
                            success: function(result){
                                //var obj=JSON.parse(result);   
                                console.log('like page '+result);
                                
                                var obj=JSON.parse(result);
                                console.log(obj.files[0]['likeCount']);
                                //$('.likeCount'+post[i].id+'">'+post[i].likeCount).append('<p id="ilikethis">' + likeString + '</p><button onclick="likeClick(\'' + post[i].id + '\')">Like</button><span class="likeCount'+post[i].id+'">'+post[i].likeCount+'"</span> likes');
                                $('.likeCount'+obj.files[0]['postid']).html(obj.files[0]['likeCount']);
                                
                            },
                                
                        error: function(er){console.log(er);}
            });
            }
            
            //display posts
            function onload(){
                    $.ajax({
                            url: '/getposts.php',
                            method: "POST",
                            //dataType: 'json',
                            data: true,
                            //we want to send it untouched, so this needs to be false
                            processData: false,
                            contentType: false,
                            //add a message 
                            success: function(result){ 
                                //console.log('deep'+posts);
                                
                            $('#posts').html('');
                            var post=JSON.parse(result);   
					        console.log(post); 
					         
                            //loop over each post item in the posts array
                           // obj.each(function(post) {
                           //  posts.each(function(post){
                            for (var i = 0; i<= post.length; i++) {
                                var likeString = '';
                                if (post.isLiked)
                                    likeString = 'I liked this';
                                
                                var likeString = '';
                                if (post.isLiked)
                                likeString = '';
                                
                                $(".centercontent").append('<div class="postcover '+post[i].id+'"><div class="postheader"><div class="profilediv"></div><div class="profilename"><span class="textname"></span></div><div class="posttime">6h</div></div>');
        
                                $(".postcover."+post[i].id).append('<div class ="imagediv"><img src="images/posts/'+post[i].image+'"></div>');
                                $(".postcover."+post[i].id).append(' <div class="postcontent"><div class="likes"></div><ul class="comments"><li class="content">'+post[i].comment+'</li><li><strong>Aman</strong> Where are you all? </li><li><strong>Brahmpreet</strong> At Niagra. </li><li><strong>Mansavvvy</strong> Best Click!</li></ul><hr><div id="like"></div><div class="reaction"><span class="glyphicon glyphicon-heart-empty likeicon"></span><input type="text" class="addcomment" placeholder="Add a comment..." value=""></div></div>');
        						  
                                console.log('post id is ...'+post[i].id);
                                $(".postcover."+post[i].id+" .likes").append('<p id="ilikethis">' + likeString + '</p><button onclick="likeClick(\'' + post[i].id + '\')">Like</button><span class="likeCount'+post[i].id+'">'+post[i].likeCount+'</span> likes');
                                
                                //console.log(post.likeCount);
                               
                                $(".postcover."+post[i].id+" .textname").append(post[i].firstname+' '+post[i].lastname);
                                $(".postcover."+post[i].id+" .profilediv").append('<img src="images/man.png" class="profilephoto"></img>');
                                
                            } //for loop
                                
                            },
                            error: function(er){console.log(er);}
                    }); 
                 
            }
 
            //upload picture handler
            function uploadClick(){
                //go get the data from the form
                var form = new FormData($("#uploadForm")[0]);
    
                //we can post this way as well as $.post
                $.ajax({
                        url: '/posts.php',
                        method: "POST",
                        //dataType: 'json',
                        //the form object is the data
                        data: form,
                        //we want to send it untouched, so this needs to be false
                        processData: false,
                        contentType: false,
                        //add a message 
                        success: function(result){ console.log('deep'+result);},
                        error: function(er){console.log(er);}
                }); 
                
            }
        
                
            
        </script>
    </head>
    <!-- add the onload event handler to the body tag -->
    <body onload="onload();">
        
          <!--Header div starts-->
	 <div class="header">
          <div class="tnavbar">
			<div class="nav1">
				<a href="#"><img src="images/header/instagram-logo.png" class="logo"/>  |  <img src="images/header/instagram_PNG5.png" class="tagline"/></a>
			</div>
			
			<!--<div class="nav2">
				<form class="navbar-form navbar-left mainsearch" role="search">
				  <div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				  </div>
				</form>
			</div>-->
			
			<div class="nav3">
				<a href="#"><img src="images/header/a.png"/>  
				<a href="#"><img src="images/header/Heart-SG2001-transparent.png"/>  
				<a href="#"><img src="images/header/-SG2001-p.png"/> 
			</div>
		   <a href="/logout.php" class="text-center logout">Logout</a>
		   </div>
     </div>
     <!--Header div ends-->
     
     
     <!--Maincontent div starts-->
    <div class="container-fluid maincontent">
       
       
      <div class="row">
          <button type="button" class="btn btn-info btn-lg addpicture" data-toggle="modal" data-target="#myModal">Add a Picture</button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add a Picture</h4>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" enctype="multipart/form-data" name="uploadForm" novalidate>
                        <input type="text" name="comment" id="comment" />
                        <input type="file" name="userPhoto" id="userPhoto" />
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="uploadClick();">Send</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">

            <div class="col-lg-6 col-lg-offset-3 text-center mainc">
             
              <div class="centercontent">
                       
              </div>
              
              
            </div> 
        
      </div>
    
    </div>
    <!--Maincontent div ends-->
	
	<!--footerdiv starts-->
	<footer>
		<div>2017 INSTAGRAM</div>
	</footer>
    <!--footerdiv ends-->
	
    </div>
	</div>
	
    </body>
</html>
<?php
}
else{
 header('Location:https://insta-2-sandeepkaur452.c9users.io/signin.html');
}
?>