        <section>         
             <div class="panel-group" id="home">
                  <?php
                  
                session_start();
                $_SESSION['selected_thread'] = $_GET['thread'];
            
                $xml=simplexml_load_file("xml/categoryThreads/".$_SESSION['selected_thread'].".xml");
                
                $totalRows = $xml->count();
                $array = (array) $xml;
                $array = array_values($array);
                  
        
                $_SESSION['startThread'] = ((isset($_SESSION['startThread'])) ? $_SESSION['startThread'] : 0);
                $_SESSION['pageThread'] = ((isset($_SESSION['pageThread'])) ? $_SESSION['pageThread'] : 0);
                if(isset($_POST['next']))
                {
                     if(($_SESSION['startThread']+5)<$totalRows){
                   $_SESSION['startThread'] = $_SESSION['startThread'] +5;  
                   $_SESSION['pageThread']++;
                    }
                }
                if(isset($_POST['back']))
                {
                    if($_SESSION['startThread']>0){
                   $_SESSION['startThread'] = $_SESSION['startThread'] - 5;
                   $_SESSION['pageThread']--;
                    }
                }
                
                $limit=$_SESSION['startThread'] + 5;
 
                    //thead
                  echo " <div class='table-responsive'>          
                              <table class='table'>
                                <thead>
                                  <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>";
                //tbody                
                  for ($x = $_SESSION['startThread']; $x < $limit; $x++) {
                    if(isset($array[$x])){
            
                    
                                echo "<tbody>
                                  <tr>
                                    <td><a href='index.php?phpPage=threadView&title=".$array[$x]->title."'>".$array[$x]->title."</a></td>
                                    <td>".$array[$x]->author."</td>
                                    <td>".$array[$x]->dateThread."</td>
                                    <td>".$array[$x]->status."</td>
                                  </tr>";
                                
                    }
                } 
                //close table
                echo "</tbody>
                              </table>
                                 </div>";
                    ?> 
              
          </section> 
          
           <section  class="custom-top-position">
              
              <div class="row">
                  <div class="col-md-7">
                     <p> <a href="index.php?phpPage=addThread"><span class="glyphicon glyphicon-plus"></span> Add new thread</a></p>
                  </div>
                   <div>
                       <form class="navbar-form col-md-6" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                           <div class="input-group">
                            <input type="text" class="form-control" placeholder="Display results: <?php echo ($_SESSION['pageThread']+1).'-'.ceil($totalRows/5);?>". disabled/>
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" id="back" name="back">Back</button>
                                <button class="btn btn-default" type="submit" id="next" name="next">Next</button>
                            </div>

                            </div>
                       </div>
                    </form>
                   </div>

          </section>