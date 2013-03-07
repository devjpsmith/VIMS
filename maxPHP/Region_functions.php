   <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
 
 <script>
  $(function() {
    var name = $( "#name" ),
      allFields = $( [] ).add( name ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 	<!-- checks min and max lenght for entry -->
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
	

	
 	<!-- start of new region input box -->
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
	  
				
    }); <!-- End of new region input box --> 
 	
	<!-- this code is just on open the new region forum -->
    $( "#create-user" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
      });
	  
	<!-- Delete region button -->
	$( "#delete-user" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
      });
  });
  
  
  </script>
  
  <!-- selectable style and script -->
    <style type="text/css">
		#selectable .ui-selecting {
		background: silver;
		}
		#selectable .ui-selected {
		background: gray;
		}
	</style>
		
	<script>
	  $(document).ready(function() {
		$("#selectable").selectable();
	  });
  	</script>
    
    
    <?php
		
		$MyCon = new Connection();	
		$con = $MyCon->connect();
		
			/* ShowRegion will pull region names from the database and show them on the console */
			function showRegion($column) {		
				$query = "SELECT REG_Name FROM region WHERE REG_ID <> 99 ORDER BY REG_Name";
				$result = mysql_query($query);
				
					while($row = mysql_fetch_array($result))
				  {
				  echo "<tr>";
				  echo "<td >" . $row['REG_Name'] . "</td>";
				  echo "</tr>";     
				  }	
			}
		mysql_close();
	?>