<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


$names=["John doe", "james someone","Joe Biden"];
$path = 'data.json';
if(!file_exists($path)) {
    $votes = array(
        $names[0] => 0,
        $names[1] => 0,
        $names[2] => 0,
    );
}
else{
    $jsonString = file_get_contents($path);
    $votes = json_decode($jsonString, true);
}

echo "
    <p>Please vote for your candidate!</p>    
    <form method='post' action='vote.php'>  
        <label>$names[0]<input type='radio' name='c' value='0'></label>
        <label>$names[1]<input type='radio' name='c' checked value='1'></label>
        <label>$names[2]<input type='radio' name='c' value='2'></label>
        <br><input type='submit' value='Submit your vote'>
    </form>
     
    ";
//handle POST
if(array_key_exists("c",$_POST)){
    debug_to_console($_POST["c"]);
    $votes[$names[$_POST["c"]]]=$votes[$names[$_POST["c"]]]+1;
    $jsonString = json_encode($votes, JSON_PRETTY_PRINT);
    $fp = fopen($path, 'w');
    fwrite($fp, $jsonString);
    fclose($fp);
}
//write info to user
if(file_exists($path)){
    if($votes[$names[0]] != "0" ||  $votes[$names[1]] != "0" || $votes[$names[2]] != "0"){
        $maxvotes="0";
        if($votes[$names[0]]>$votes[$names[1]]){
            $maxvotes=$votes[$names[0]];
        }
        if($votes[$names[1]]>$votes[$names[0]]){
            $maxvotes=$names[1];
        }

        if($votes[$names[0]]>$votes[$names[2]]){
            $maxvotes=$names[0];
        }
        if($votes[$names[2]]>$votes[$names[0]]){
            $maxvotes=$names[2];
        }

        if($votes[$names[1]]>$votes[$names[2]]){
            $maxvotes=$names[1];
        }
        if($votes[$names[2]]>$votes[$names[1]]){
            $maxvotes=$names[2];
        }

        $allvotes=$votes[$names[0]]+$votes[$names[1]]+$votes[$names[2]];
        echo "
                <br><label for='file'>Votes for $names[0]: ".$votes[$names[0]]."</label>
                <progress id='file' value='".$votes[$names[0]]."' max='$allvotes'>".$votes[$names[0]]." </progress>
        ";
        echo "
                <br><label for='file'>Votes for $names[1]: ".$votes[$names[1]]."</label>
                <progress id='file' value='".$votes[$names[1]]."' max='$allvotes'>".$votes[$names[1]]." </progress>
        ";
        echo "
                <br><label for='file'>Votes for $names[2]: ".$votes[$names[2]]."</label>
                <progress id='file' value='".$votes[$names[2]]."' max='$allvotes'>".$votes[$names[2]]." </progress>
        ";
        if($votes[$names[2]]==$votes[$names[1]] && $votes[$names[1]]==$votes[$names[0]]){
            echo "
                    <p>Maximum votes for $names[1],$names[2],$names[0] the count is ".$votes[$names[0]]."</p>  
                ";
        }
        else{
            if(($votes[$names[2]]==$votes[$names[0]] && $votes[$maxvotes]==$votes[$names[0]]) || ($votes[$names[1]]==$votes[$names[0]] && $votes[$maxvotes]==$votes[$names[0]]) || ($votes[$names[1]]==$votes[$names[2]]&& $votes[$maxvotes])==$votes[$names[2]]){
                if($votes[$names[2]]==$votes[$names[0]]){
                    echo "
                    <p>Maximum votes for $names[0],$names[2], the count is $votes[$maxvotes]</p>  
                ";
                }
                if($votes[$names[1]]==$votes[$names[0]]){
                    echo "
                    <p>Maximum votes for $names[1],$names[0], the count is $votes[$maxvotes]</p>  
                ";
                }
                if($votes[$names[1]]==$votes[$names[2]]){
                    echo "
                    <p>Maximum votes for $names[1],$names[2], the count is $votes[$maxvotes]</p>  
                ";
                }
            }
            else{
                echo "
            <p>Maximum votes for $maxvotes, the count is $votes[$maxvotes]</p>  
        ";
            }
        }


    }
}
?>
