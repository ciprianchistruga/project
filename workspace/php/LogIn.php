<?php 


            if( isset( $_POST['submit'] ) )
            {
            $file ="xml/users.xml";
    
            $email=$_POST['email'];
            $password=$_POST['password'];

            $xml= simplexml_load_file($file);
            $totalRows = $xml->count();
            $array = (array) $xml;
            $array = array_values($array);
            
            $exists = false;
      
             for ($x = 0; $x < $totalRows; $x++) {
                    if($array[$x]->email==$email && $array[$x]->password==$password){
                    $exists=true;
                    }
            } 
            if($exists){
                header('Location: index.php?phpPage=loginSuccess');
            } else {
                echo '<p class="text-danger">Please enter a valid email or password!!!</p>';
            }
            }

        ?>
        
                     
      
       <section>         
             <div class="row">
                <h1 class="text-primary text-center"> Log in</h1>
                
                     <form class="navbar-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                        <div class="form-group  col-md-2 col-md-offset-5">

                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" name="email" id="email">
                            
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group  col-md-3 col-md-offset-5">    
                            <p style="font-size:10px"><input type="checkbox" class="form-control" name="keepLogged" id="keepLogged">Keep me logged in on this computer</p>
                            
                            <br/>
                                 <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="submit">Submit</button>
                                </div>
                                <div>
                                    <p class="text-info">Forgot password?</p>
                                </div>
                       </div>
                    </form>
              </div>
          </section> 
          <br/>
          <br/>

                            