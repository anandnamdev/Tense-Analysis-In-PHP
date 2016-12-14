<?php 
class PosTagger {
        private $dict; 
        
        public function __construct($lexicon) {
                $fh = fopen($lexicon, 'r');
                while($line = fgets($fh)) {
                        $tags = explode(' ', $line);
                        $this->dict[strtolower(array_shift($tags))] = $tags;
                }
                fclose($fh);
        }
        
        public function tag($text) {
                preg_match_all("/[\w\d\.]+/", $text, $matches);
                $nouns = array('NN', 'NNS');
                
                $return = array();
                $i = 0;
                foreach($matches[0] as $token) {
                        // default to a common noun
                        $return[$i] = array('token' => $token, 'tag' => 'NN');  
                        
                        // remove trailing full stops
                        if(substr($token, -1) == '.') {
                                $token = preg_replace('/\.+$/', '', $token);
                        }
                        
                        // get from dict if set
                        if(isset($this->dict[strtolower($token)])) {
                                $return[$i]['tag'] = $this->dict[strtolower($token)][0];
                        }       
                        
                        // Converts verbs after 'the' to nouns
                        if($i > 0) {
                                if($return[$i - 1]['tag'] == 'DT' && 
                                        in_array($return[$i]['tag'], 
                                                        array('VBD', 'VBP', 'VB'))) {
                                        $return[$i]['tag'] = 'NN';
                                }
                        }
                        
                        // Convert noun to number if . appears
                        if($return[$i]['tag'][0] == 'N' && strpos($token, '.') !== false) {
                                $return[$i]['tag'] = 'CD';
                        }
                        
                        // Convert noun to past particile if ends with 'ed'
                        if($return[$i]['tag'][0] == 'N' && substr($token, -2) == 'ed') {
                                $return[$i]['tag'] = 'VBN';
                        }
                        
                        // Anything that ends 'ly' is an adverb
                        if(substr($token, -2) == 'ly') {
                                $return[$i]['tag'] = 'RB';
                        }
                        
                        // Common noun to adjective if it ends with al
                        if(in_array($return[$i]['tag'], $nouns) 
                                                && substr($token, -2) == 'al') {
                                $return[$i]['tag'] = 'JJ';
                        }
                        
                        // Noun to verb if the word before is 'would'
                        if($i > 0) {
                                if($return[$i]['tag'] == 'NN' 
                                        && strtolower($return[$i-1]['token']) == 'would') {
                                        $return[$i]['tag'] = 'VB';
                                }
                        }
                        
                        // Convert noun to plural if it ends with an s
                        if($return[$i]['tag'] == 'NN' && substr($token, -1) == 's') {
                                $return[$i]['tag'] = 'NNS';
                        }
                        
                        // Convert common noun to gerund
                        if(in_array($return[$i]['tag'], $nouns) 
                                        && substr($token, -3) == 'ing') {
                                $return[$i]['tag'] = 'VBG';
                        }
                        
                        // If we get noun noun, and the second can be a verb, convert to verb
                        if($i > 0) {
                                if(in_array($return[$i]['tag'], $nouns) 
                                                && in_array($return[$i-1]['tag'], $nouns) 
                                                && isset($this->dict[strtolower($token)])) {
                                        if(in_array('VBN', $this->dict[strtolower($token)])) {
                                                $return[$i]['tag'] = 'VBN';
                                        } else if(in_array('VBZ', 
                                                        $this->dict[strtolower($token)])) {
                                                $return[$i]['tag'] = 'VBZ';
                                        }
                                }
                        }
                        
                        $i++;
                }
                
                return $return;
        }
}


function printTag($tags) {
        foreach($tags as $t) {
                echo $t['token'] . "/" . $t['tag'] .  "\n";
        }
        echo "\n";
}

if(isset($_POST['submit']))
{
    $pre = 0 ;
    $pas = 0 ;
    $fut = 0 ;


    if (in_array("present", $_POST['tense'])) { $pre=1;}    
    if (in_array("past", $_POST['tense'])) { $pas=1;}
    if (in_array("future", $_POST['tense'])) { $fut=1;}
}



$tagger = new PosTagger('lexicon.txt');
$myfile = fopen("files/file.txt", 'r');

$present_verb = array("VBZ","VB","VBP","VBG");
$past_verb = array("VBD","VBN");
$all_verb = array("VBP","VBZ","VB","VBD","VBG","VBN");
$modal = array("couldnt","could","couldn't","should","shouldnt","shouldn't","would","will","wont","won't","shall","did","didnt","didn't","do","dont","don't","have","haven't","havent","had","hadnt","hadn't");
$present_model = array("should","shouldn't");
$past_model = array("could","couldn't");
$future_model = array("shall","will","would","won't");


$result='';
while (($line = fgets($myfile)) !== false)
{   
    //$line = strtolower($line);
    $result = $result . ' ' . $line;
}

$result = str_replace("?", ".", $result);
$sentence = explode('.', $result);


$present_str='';
$past_str='';
$future_str='';
foreach ($sentence as $value)
{
        $value = ltrim($value);
        $value = str_replace("'","",$value);
        $tags = $tagger->tag($value);
        
        foreach($tags as $t) {
                if(in_array($t['token'], $modal))
                {
                        
                        if($t['token']=="will" || $t['token']=="shall" || $t['token']=="would" || $t['token']=="wont" || $t['token']=="won't" )
                                 $future_str = $future_str . $value . ".<br> ";
                        elseif($t['token']=='should' || $t['token']=="shouldnt" || $t['token']=="shouldn't" || $t['token']=="do" || $t['token']=="don't" ||$t['token']=="dont" || $t['token']=="havent" || $t['token']=="have")
                                 $present_str = $present_str . $value . ".<br> ";
                        elseif($t['token']=="could" || $t['token']=="couldnt" || $t['token']=="couldn't" || $t['token']=="didn't" || $t['token']=="didnt" || $t['token']=="did" || $t['token']=="had" || $t['token']=="hadnt" || $t['token']=="hadn't")
                                 $past_str = $past_str . $value . ".<br> ";
                        break;
                }
                elseif (in_array($t['tag'], $all_verb)) 
                {
                        //echo in_array($t['tag'], $all_verb);
                        if(in_array($t['tag'],$present_verb))
                        {
                                $present_str = $present_str . $value . ".<br> ";
                                //echo $present_str . "<br>";
                        }
                        elseif(in_array($t['tag'], $past_verb))
                        {
                                $past_str = $past_str . $value . ".<br>";
                        }
                        //echo "Check1";
                        break;
                }
                
        }
}
//echo "Present <br>" . $present_str . "Past <br>" . $past_str . "Future <br> " . $future_str ."<br>";
//echo $pre . "<br>" . $pas . "<br>" . $fut ."<br>";
$final = '';

echo'<html><head><link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/log.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css"></head>
<body>

<header class="header-login-signup">

    <div class="header-limiter">

        <h1><a href="select.php"><span>Tense Analyzer System</span></a></h1>


        <ul>
            
            <li><a href="output.doc">Download</a></li>
        </ul>

    </div>

</header>';



if($pre==1){
        echo "<fieldset>";
        echo "<legend><font size =5 ><b><u>Present Tense Sentences : </b></u></font></legend>" . $present_str . "<br>";
        #echo "All Present Tense Sentences are : <br> <br>" . $present_str . "<br>";
        echo "</fieldset><br>";
        $final = $final . "All Present Tense Sentences are: <br> <br>" . $present_str . "<br> <br>";
}
if($pas==1){
        echo "<fieldset>";
        echo "<legend><font size =5 ><b><u>Past Tense Sentences : </b></u></font></legend>" . $past_str . "<br>";       
        #echo "All Past Tense Sentences are : <br> <br>" . $past_str . "<br>";       
        echo "</fieldset><br>";
        $final = $final . "All Past Tense Sentences are: <br> <br>" . $past_str . "<br> <br>";
}
if($fut==1){
        
        echo "<fieldset>";
        echo "<legend><font size =5 ><b><u>Future Tense Sentences : </b></u></font></legend>" . $future_str . "<br>";
        #echo "All Future Tense Sentences are : <br> <br>" . $future_str . "<br>";
        echo "</fieldset>";
        $final = $final . "All Future Tense Sentences are: <br> <br>" . $future_str . "<br> <br>";
}

$myfile = fopen("output.doc", "w") or die("Unable to open file!") ;
$final = str_replace("<br>","\n",$final);
fwrite($myfile, $final);
echo'</body>

</html>';


?>

