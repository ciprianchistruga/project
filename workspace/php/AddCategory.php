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
                        $file ="xml/homeCategories.xml";
                        $newName=$_POST['title'];
                        $username=$_POST['Username'];
                        $email=$_POST['email'];
                        $birthday=$_POST['birthday'];
            
                        $xml= simplexml_load_file($file);
                        
                        $total = $xml->count();
                        $category = "Category".$total;
                  
                        $xml->$category->name = $newName;
                        $xml->$category->user = $username;
                        $xml->$category->email = $email;
                        $xml->$category->birthday = $birthday;
                        
                        $xmlFileName = $category."Threads";
                        $newXmlValue = '<?xml version="1.0" encoding="ISO-8859-1"?>
                        <'.$category.'> </'.$category.'>';
                        $dom=new DOMDocument;
                        $dom->loadXML($newXmlValue);
                        $dom->save("xml/categoryThreads/".$xmlFileName.".xml");
                        
                        $xml->$category->forumThred = $xmlFileName;
                        
                        file_put_contents($file, $xml->asXML());
                        
                        header('Location: index.php');
                     }        
            }
                    else{   }              
                
            }

        ?>
       
       <section>  
             <div class="row">
                <h3 class="text-primary text-center"> Add a new category</h3>
                
                     <form style="width: 900px" method="post" action="<?php $_SERVER['PHP_SELF']?>">
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
                            
                            
                            <script src='https://www.google.com/recaptcha/api.js'></script>
                            <div class="col-xs-10">         
                                <div class="g-recaptcha" data-sitekey="6Lf0KxAUAAAAANY7u2ujE-G14-gr36H0Y2rHpmQL"></div><br/>
                            </div>
                            
                            <div class="col-xs-10">
                            <p>Note: If a similar category exists already on our website, your category will be removed and your
                            thread/threads will be moved to an exsiting category. Please review the categories already
                            existing on our website and avoid the flood!</p>
                            </div>
                            
                            <br/>
                            <div class="col-xs-3">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="submit">Submit</button>
                                </div>
                            </div>
                       </div>
                    </form>
              </div>
        </section>  
        <br/>
        <br/>
