
            
            <section>         
             <div class="panel-group" id="home">
                  <?php
                  
                  $xml=simplexml_load_file("xml/homeCategories.xml");
                  $totalRows = $xml->count();
                  $array = (array) $xml;
                  $array = array_values($array);
                  
                session_start();
                $_SESSION['start'] = ((isset($_SESSION['start'])) ? $_SESSION['start'] : 0);
                $_SESSION['page'] = ((isset($_SESSION['page'])) ? $_SESSION['page'] : 0);
                if(isset($_POST['next']))
                {
                     if(($_SESSION['start']+5)<$totalRows){
                   $_SESSION['start'] = $_SESSION['start'] +5;  
                   $_SESSION['page']++;
                    }
                }
                if(isset($_POST['back']))
                {
                    if($_SESSION['start']>0){
                   $_SESSION['start'] = $_SESSION['start'] - 5;
                   $_SESSION['page']--;
                    }
                }
                
                $limit=$_SESSION['start'] + 5;
 
                  //display max 5 categories from homeCategories.xml
                  for ($x = $_SESSION['start']; $x < $limit; $x++) {
                    if(isset($array[$x])){
                    echo "<div class='panel panel-default'>
                          <div class='panel-heading' id='categoryName'><a href='index.php?phpPage=threads&thread=".$array[$x]->forumThred."'>".$array[$x]->name."</a></div>
                          </div>";
                 
                    }
                    
                }
                
                
                    ?> 
              
          </section> 
          
          <section  class="custom-top-position">
              
              <div class="row">
                  <div class="col-md-7">
                     <p> <a href="index.php?phpPage=addCategory"><span class="glyphicon glyphicon-plus"></span> Add new category</a></p>
                  </div>
                   <div>
                       <form class="navbar-form col-md-6" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                           <div class="input-group">
                            <input type="text" class="form-control" placeholder="Display results: <?php echo ($_SESSION['page']+1).'-'.ceil($totalRows/5);?>". disabled/>
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" id="back" name="back">Back</button>
                                <button class="btn btn-default" type="submit" id="next" name="next">Next</button>
                            </div>

                            </div>
                       </div>
                    </form>
                   </div>

          </section>

          
          
            
       