<?php 


            if( isset( $_POST['submit'] ) )
            {
            $file ="xml/users.xml";
            $lastName=$_POST['lastName'];
            $firstName=$_POST['firstName'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $password=$_POST['password'];//md5($row[$_POST['password']])
            $confirmPassword=$_POST['confirmPassword'];

            $xml= simplexml_load_file($file);
      
            if($password==$confirmPassword){
            $xml->$lastName->firstName = $firstName;
            $xml->$lastName->lastName = $lastName;
            $xml->$lastName->address = $address;
            $xml->$lastName->email = $email;
            //$xml->$lastName->birthday =
            $xml->$lastName->password = $password;
            
            
            file_put_contents($file, $xml->asXML());
            
            header('Location: index.php?phpPage=confirmEmail');
            }   else {
                echo '<p class="text-danger">PLEASE ASSURE THAT BOTH PASSWORDS MATCH</p>';
                }
            } 

        ?>
        
                     
      
       <section>         
             <div class="row">
                <h1 class="text-primary text-center"> Create a new account</h1>
                
                     <form class="navbar-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                        <div class="form-group  col-md-2 col-md-offset-5">
                            
                            <label for="lastName">Last name:</label>
                            <input type="text" class="form-control" name="lastName" id="lastName">
                            
                            <label for="firstName">First name:</label>
                            <input type="text" class="form-control" name="firstName" id="firstName">
                            
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" id="address">
                            
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" name="email" id="email">
                            
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password">
                            
                            <label for="confirmPassword">Confirm password:</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                            <br/>
                            <br/>
                                 <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="submit">Submit</button>
                                </div>
                       </div>
                    </form>
              </div>
          </section> 
          <br/>
          <br/>

                            