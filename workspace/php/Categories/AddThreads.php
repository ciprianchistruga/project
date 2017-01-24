       <?php
            
            //captcha
            if(isset($_POST['g-recaptcha-response'])&& $_POST['g-recaptcha-response']){        
                var_dump($_POST);        
                $secret = "REPLACE_IT_WITH_YOUR_KEY";    
                $ip = $_SERVER['REMOTE_ADDR'];       
                $captcha = $_POST['g-recaptcha-response'];     
                $rsp  = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip$ip");  
                var_dump($rsp);         
                $arr = json_decode($rsp,TRUE);  
                if($arr['success']){      
                    
                    //post info
                    if( isset( $_POST['submit'] ) )
                        {
                        session_start();
                        $file ="xml/categoryThreads/".$_SESSION['selected_thread'].".xml";
                        $title=$_POST['title'];
                        $username=$_POST['Username'];
                        $email=$_POST['email'];
                        $birthday=$_POST['birthday'];
                        $mainComment=$_POST['mainComment'];
            
                        $xml= simplexml_load_file($file);
                        $total = count($xml);
                        $plusOne=$total+1;
                        $newName="Thread".$plusOne;
                        echo $newName;
                  
                        $xml->$newName->title = $title;
                        $xml->$newName->author = $username;
                        $xml->$newName->email = $email;
                        $xml->$newName->status="open";
                        $xml->$newName->dateThread=date("d.m.Y");
                        $xml->$newName->mainComment = $mainComment;
                        $xml->$newName->comments = "comments";
                        if(isset($_POST['allowSocial'])){
                            $xml->$newName->allowSocial ="true";
                        } else { 
                            $xml->$newName->allowSocial ="false";
                            
                        }
                        if(isset($_POST['allowComments'])){
                            $xml->$newName->allowComments ="true";
                        } else {
                            $xml->$newName->allowComments ="false";
                        }
                        
                         //image upload
                            if($_FILES['image']['name']==''){
$xml->$newName->imagePath = "none";
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
                                     $xml->$newName->imagePath = $target_file;
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }
                            }
                                                            
                            }
                        
                        file_put_contents($file, $xml->asXML());
                        
                        header('Location: index.php');
                     }        
            }
                    else{   }              
                
            }

        ?>
       
       <section>  
             <div class="row">
                <h3 class="text-primary text-center"> Add a new thread</h3>
                
                     <form style="width: 900px" method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                        <div class="form-group  col-xs-offset-3">
                            
                            <div class="col-xs-3">
                            <label for="Username">Username:</label>
                            <input type="text" class="form-control test" name="Username" id="Username">
                            </div>
                            
                            <div class="col-xs-4">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control test" name="email" id="email">
                            </div>
                            
                            <div class="col-xs-3">
                            <label for="birthday">Birthday:</label>
                            <input type="text" class="form-control test" name="birthday" id="birthday">
                            </div>
                            <br/>
                            
                            <div class="col-xs-10">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title"><br/>
                            </div>
                            <br/>
                            
                            <div class="col-xs-10">
                            <label for="title">Message:</label>
                            <textarea class="form-control" name="mainComment" id="mainComment">
                                
                            </textarea>
                            <br/>
                            </div>
                            
                            
                            <script src='https://www.google.com/recaptcha/api.js'></script>
                            <div class="col-xs-10">         
                                <div class="g-recaptcha" data-sitekey="6Lf0KxAUAAAAANY7u2ujE-G14-gr36H0Y2rHpmQL"></div><br/>
                            </div>
                            <br/>
                            <div class="checkbox col-xs-10">
                             <label style="font-size:10px" class="checkbox-inline"><input type="checkbox" name="allowSocial" id="allowSocial">Allow share on social networks</label>
                             <label style="font-size:10px" class="checkbox-inline"><input type="checkbox" name="allowComments" id="allowComments">Allow comments</label>
                            </div>
                            
                            <br/>
                            <div class="col-xs-3">
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
              </div>
        </section>  
        <br/>
        <br/>
