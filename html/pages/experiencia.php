
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
     var availableTags1 = [
"ActionScript",
"AppleScript",
"Asp"
];

var availableTags2 = [
"Python",
"Ruby",
"Scala",
"Scheme"
];
    $( "#tags" ).autocomplete({
      source: availableTags
    });


    $("#prod_selector").on('change',function(){
       if($(this).val()!="ALL"){
        if($(this).val() == "1"){
            $( "#tags" ).autocomplete('option', 'source', availableTags1)
        } 
        
        if($(this).val() == "2"){
            $( "#tags" ).autocomplete('option', 'source', availableTags2)
        }
    }
    });
  } );
  </script>
</head>
<body>
    <div class="container">
  <h4>Please enter following options in input box</h4>  
  <h3>For ALL=> ActionScript, AppleScript, Asp, BASIC, C, C++, Clojure, COBOL, ColdFusion, Erlang, Fortran, Groovy, Haskell, Java, JavaScript, Lisp, Perl, PHP, Python, Ruby, Scala, Scheme</h3>
  <h3>For Value1=> ActionScript, AppleScript, Asp</h3>
  <h3>For Value2=> Python, Ruby, Scala, Scheme</h3>
  
  
   </h3>
    <div class="col-md-4 col-md-offset-3">

<div class="form-group">
<select id="prod_selector" class="form-control">
<option value="ALL" selected>ALL</option>
<option value="1">value 1</option>
<option value="2">value 2</option>
</select>
 </div>
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags" class="form-control">
</div>
 </div>
 </div>
</body>
</html>
