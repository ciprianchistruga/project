    <?php

        $xml = simplexml_load_file("xml/SearchKeywords.xml");
        $value= /*$_GET['phpPage'] ; //*/$_POST['subject']; 
        $location=null;
        $url=null;
        
        //search by keywords
        foreach($xml->children() as $key){
            echo $key;
            $string = "//search/".$key->getName()."/keywords[contains(text(), '".$value."')]/following-sibling::url";
            $string2 = "//search/".$key->getName()."/keywords[contains(text(), '".$value."')]/following-sibling::url2";
            $var = "//search/".$key->getName()."/keywords[contains(text(), '".$value."')]/following-sibling::variable";
            $result = $xml->xpath($string);
            $secondResult = $xml->xpath($var);
            $thirdResult = $xml->xpath($string2);
            
            if(count($result)>0) { // if found
        
             $url = (string) $result[0];
             $variable = (string) $secondResult[0];
             if($variable==single){
             $location='index.php?phpPage='.$url;
             } else {
                $url2 = (string) $thirdResult[0];
                $location='index.php?phpPage='.$url."&thread=".$url2;
             }
            }
        }
        if($location!=null){
            echo  "<h2 class='col-md-offset-5'>Result for: <a href='".$location."' >".$_POST['subject']."</a></h2>";
        } else {
            echo "<h2 class='col-md-offset-5 text-danger'>No restul found!!!<h2>";
        }

        
        
        ?>