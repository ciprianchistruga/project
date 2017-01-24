<!DOCTYPE html>

<html>
    <head>
        
        <title>Home page</title>
         <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
         <link href="css/custom.css" rel="stylesheet">
    </head>
    
    <body>
        
        <div class="container">
             <div class="page-header">
                 <img src="img/img-palat-faded-intro.png" class="img-responsive" alt="Palatul Culturii"/>
             </div>
              
             <nav class="navbar navbar-light col-md-9 custom-top-position">
              <div class="container-fluid">
                <ul class="nav navbar-nav custom-nav-text-color">
                  <li class="active nav-item"><a href="index.php?phpPage=home" class="nav-link well">Home</a></li>
                  <li class="nav-item"><a href="index.php?phpPage=signup" class="nav-link well">Sign Up</a></li>
                  <li class="nav-item"><a href="index.php?phpPage=login" class="nav-link well">Log In</a></li>
                  <li class="nav-item"><a href="index.php?phpPage=contact" class="nav-link well">Contact</a></li>
                  <li class="nav-item"><a href="index.php?phpPage=statistics" class="nav-link well">Statistics</a></li>
                </ul>
                <div class="navbar-right custom-header-search">
                    <form class="navbar-form"  action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="subject" ><!--name="phpPage"-->
                                <div class="input-group-btn">
                                    <a href="index.php?phpPage=search"><input type="button" class="btn btn-default" value="search" name="search"></a>
                                </div>

                       </div>
                    </form>
                </div>
              </div>
            </nav>
             <div class="col-md-3">
                    <a class="navbar-brand" href="index.php"><img src="img/cityzen.jpeg" class="img-responsive to-disappear" alt="CityZen logo"/></a>
            </div>
        </div>
        
        
         <div class="container">
        <?php
        
        $page = $_GET['phpPage'];
        
        //display dynamic page
        switch($page) {
            case "home":
                include('php/Home.php');
                break;
            case "signup":
                include('php/SignUp.php');
                break;
            case "login":
                include('php/LogIn.php');
                break;
            case "contact":
                include('php/Contact.php');
                break;
            case "statistics":
                include('php/Statistics.php');
                break;
            case "addCategory":
                include('php/AddCategory.php');
                break;
            case "search":
                include('php/Search.php');
                break;
            case "confirmEmail":
                include('php/SignUpConfirmation.html');
                break;
            case "loginSuccess":
                include('php/LoginSuccess.html');
                break;
            case "threads":
                include('php/Categories/ThreadsList.php');
            break;
            case "addThread":
                include('php/Categories/AddThreads.php');
            break;
            case "threadView":
                include('php/Categories/ViewThread.php');
            break;
            default:
                include('php/Home.php');
                break;
        }
        
        ?>
        </div>
        
        <div class="container custom-footer">
            
            
                <footer>
                    
                    <p class="navbar-form col-md-9">Copyrigt &copy; 2016-2017 Iasi</p>
                     <p class="navbar-form col-md-1 navbar-right">Contact</p>
                      <p class="navbar-form col-md-1 navbar-right">Policy</p>
                       <p class="navbar-form col-md-1 navbar-right">Data Privacy</p>
                    
                </footer>
            
        </div>
        
        

    </body>
    
</html>