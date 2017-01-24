 <section  class="custom-top-position">
              
              <div class="row">
                   <h1 class="text-primary  text-center"> Forum><?php 
                   session_start();
                   echo $_GET['title'];?> </h1>
                   
                  <?php
                  
                $selected_title = $_GET['title'];
                
                session_start();            
                $xml=simplexml_load_file("xml/categoryThreads/".$_SESSION['selected_thread'].".xml");
                $totalRows = $xml->count();

                $array = (array) $xml;
                $array = array_values($array);
                
                $totalComments = 0;
                
                
                  for ($x = 0; $x < $totalRows; $x++) {
                      
                      //see if the thread title match
                    if($array[$x]->title==$_GET['title']){
                    
                     //change color based on status
                     if($array[0]->status=="open") {echo "<p class='text-success'>";} 
                     else {echo "<p class='text-danger'>";}
                     echo "Status: ".$array[0]->status."</p>";
                     
                     //show main comment and author details
                    echo "<div class='col-md-12'> <div class='col-md-2'> <img src='img/profilePic.jpeg' class='img-responsive' style='width:50px, height: 50px' alt='profile pic'/> </div>";
                     echo "<div class='col-md-4'><p>".$array[$x]->author."</p>";
                     echo "<p>".$array[$x]->dateThread."</p></div>";
                    echo "<div class='col-md-10'><h3>".$array[$x]->mainComment."</h3></div>";
                    if(isset($array[$x]->imagePath)){
                            echo  '<div class="col-md-4">
                                     <img src="'.$array[$x]->imagePath.'" alt="comment picture" class="img-responsive">
                                     <div id="map"></div></div>';   
                            }
                    echo "<div class='col-md-12'><br/><hr style='width: 100%; color: black; height: 1px; background-color:black;' /><br/></div>";
                    
                    
                        $array2 = (array) $array[$x]->comments;
                        $array2 = array_values($array2);
                        $totalComments = count($array2);
                        
                        //show other comments
                        for($y = 0; $y < $totalComments; $y++){
                            echo "<div class='col-md-12'> <div class='col-md-2'> <img src='img/profilePic.jpeg' class='img-responsive' style='width:50px, height: 50px' alt='profile pic'/> </div>";
                            echo "<div class='col-md-4'><p>".$array2[$y]->name." ".$array2[$y]->lastName."</p>";
                            echo "<p>".$array2[$y]->currentDate."</p></div>";
                            echo "<div class='col-md-10'><h3>".$array2[$y]->comment."</h3></div>";
                            //show image if exsists
                            if(isset($array2[$y]->imagePath)){
                            echo  '<div class="col-md-4">
                                     <img src="'.$array2[$y]->imagePath.'" alt="comment picture" class="img-responsive">
                                     <div id="map"></div></div> ';   
                            }
                            echo "<div class='col-md-12'><br/><hr style='width: 100%; color: black; height: 1px; background-color:black;' /><br/></div>";
                            
                        }
                        
                        //user press submit
                        if( isset( $_POST['submit'] ) )
                         {
                            $file ="xml/categoryThreads/".$_SESSION['selected_thread'].".xml";
                            $name=$_POST['name'];
                            $lastName=$_POST['lastName'];
                            $email=$_POST['email'];
                            $birthday=$_POST['birthday'];
                            $comment = $_POST['comment'];
                
                            $xml= simplexml_load_file($file);
                            $totalComments = $totalComments+1;
                            $newComment = "comment".$totalComments;
                            
                            $currentThread = "Thread".($x+1);
                            
                            $comments = $xml->$currentThread->comments;

                            $xmlComment = $comments->addChild($newComment);
                            $xmlComment->addChild('name', $name);
                            $xmlComment->addChild('lastName', $lastName);
                            $xmlComment->addChild('email', $email);
                            $xmlComment->addChild('currentDate', $birthday);
                            $xmlComment->addChild('comment', $comment);
                            
                            //image upload
                            if($_FILES['image']['name']==''){

                            } else {
                            $target_dir = "img/uploaded/";
                            $target_file = $target_dir . basename($_FILES["image"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            // Check if image file is a actual image or fake image
                            if(isset($_POST["submit"])) {
                                $check = getimagesize($_FILES["image"]["tmp_name"]);
                                if($check !== false) {
                                    $uploadOk = 1;
                                } else {
                                    echo "File is not an image.";
                                    $uploadOk = 0;
                                }
                            }
                            // Check if file already exists
                            if (file_exists($target_file)) {
                                echo "Sorry, file already exists.";
                                $uploadOk = 0;
                            }
                            // Check file size
                            if ($_FILES["image"]["size"] > 500000) {
                                echo "Sorry, your file is too large.";
                                $uploadOk = 0;
                            }
                            // Allow certain file formats
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                $uploadOk = 0;
                            }
                            // Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {
                                echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                            } else {
                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                                     $xmlComment->addChild('imagePath', $target_file);
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }
                            }
                                                            
                            }
                            
                            file_put_contents($file, $xml->asXML());
                            
                            header('Location: index.php?phpPage=threadView&title='.$_GET['title']);
                            
                            } 
                        
                        
                        //show comment fields if it is allowed
                         if($array[$x]->allowComments=="true"){ ?>
                         
                 </div>
          </section> 
                         
          <section>  
             <div class="row">
                    <form style="width: 900px" method="post" action="<?php $_SERVER["PHP_SELF"]?>" enctype="multipart/form-data">
                        <div class="form-group">
                            
                            <div class="col-md-12">
                            <div class="col-md-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
                            </div>
                           
                           
                            <div class="col-md-3">
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" required>
                            </div>
                         

                            <div class="col-md-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                            </div>
                            
                            
                            <div class="col-md-3">
                            <input type="text" class="form-control" name="birthday" id="birthday" placeholder="birthday" required>
                            </div>
                            </div>
                            <br/>
                             <br/>
                            
                            <div class="col-md-12">
                            <textarea class="form-control" name="comment" id="comment" required>
                            </textarea>
                            </div>
                            
                            <br/>
                             <br/>
                            <br/>
                            <br/>
                            <div class="col-md-3">
                             <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">Submit</button>
                            </div>
                            </div>
                            <div class="col-md-3">
                             <div class="input-group-btn">
                                 <span class="btn btn-default btn-file">Upload image
                                <input type="file" name="image" > </span>
                            </div>
                            </div>

                       </div>
                    </form>
                    <div class="col-md-12">
                        <br/>
                        <!-- facebook share -->    
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v2.8";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                            
                    <?php 
                    echo '<div class="fb-share-button" data-href ="'.$_SERVER['REQUEST_URI'].'" data-layout="button_count" data-mobile-iframe="true" id="frame"><a class="fb-xfbml-parse-ignore"
                            target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fcitzen-ciprianc.c9users.io%2F&amp;src=sdkpreparse">
                            <img src="img/fb.PNG" alt="facebook button"/></a></div>';
                    ?>
                    <br/>
                    
                    <a href="https://twitter.com/intent/tweet?screen_name=TwitterDev" class="twitter-mention-button" data-show-count="false">
                        <img src="img/tw.PNG" alt="tweeter button"/></a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <br/>
                        <br/>
                    </div>        
                    <br/>
                    <br/>
                </div>
            </section>
               <?php }
                                
                    }
                }

                    ?> 
                    
