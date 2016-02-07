<?php

include_once('semsol/ARC2.php');  
$dbpconfig = array(
  "remote_store_endpoint" => "http://dbpedia.org/sparql",
   );
$store = ARC2::getRemoteStore($dbpconfig); 
if ($errs = $store->getErrors()) {
  echo "<h1>getRemoteSotre error<h1>" ;
    }

require_once('sparqllib.php');
$db = sparql_connect('http://dbpedia.org/sparql');
if( !$db ) { echo $db->errno() . ": " . $db->error(). "\n"; exit; }
$db->ns( "foaf","http://xmlns.com/foaf/0.1/" ); 

if ($country=='England') {
	$query = 'PREFIX s: <http://schema.org/>
      	PREFIX dbp: <http://dbpedia.org/property/>
      	PREFIX dbo: <http://dbpedia.org/ontology/>
      	PREFIX dbr: <http://dbpedia.org/resource/>
      	SELECT * WHERE {
          ?hotels a s:Hotel .
        ?hotels dbo:location dbr:England .
        }'; 
}
elseif ($country=='Germany') {
	$query = 'PREFIX s: <http://schema.org/>
      	PREFIX dbp: <http://dbpedia.org/property/>
      	PREFIX dbo: <http://dbpedia.org/ontology/>
      	PREFIX dbr: <http://dbpedia.org/resource/>
      	SELECT * WHERE {
      		?hotels a s:Hotel .
  			?hotels dbo:location dbr:Germany .
      	}'; 
}
elseif ($country=='Italy') {
	$query = 'PREFIX s: <http://schema.org/>
      	PREFIX dbp: <http://dbpedia.org/property/>
      	PREFIX dbo: <http://dbpedia.org/ontology/>
      	PREFIX dbr: <http://dbpedia.org/resource/>
      	SELECT * WHERE {
      		?hotels a s:Hotel .
  			?hotels dbo:location dbr:Italy .
      	}'; 
}
elseif ($country=='USA') {
	$query = 'PREFIX s: <http://schema.org/>
      	PREFIX dbp: <http://dbpedia.org/property/>
      	PREFIX dbo: <http://dbpedia.org/ontology/>
      	PREFIX dbr: <http://dbpedia.org/resource/>
      	SELECT * WHERE {
      		?hotels a s:Hotel .
  			?hotels dbo:location dbr:United_States .
      	}'; 
}
elseif ($country=='India') {
	$query = 'PREFIX s: <http://schema.org/>
      	PREFIX dbp: <http://dbpedia.org/property/>
      	PREFIX dbo: <http://dbpedia.org/ontology/>
      	PREFIX dbr: <http://dbpedia.org/resource/>
      	SELECT * WHERE {
      		?hotels a s:Hotel .
  			?hotels dbo:location dbr:India .
      	}'; 
}

 $rows = $store->query($query, 'rows'); 
 
    if ($errs = $store->getErrors()) {
       echo "Query errors" ;
       print_r($errs);
    }


$result = sparql_query($query);
$fields = $result->field_array($result);
echo "<p style='color:#0000FF'> ".$country."  has ".$result->num_rows( $result )." Hotels listed in dbpedia.</p>";

echo "<table>";
	
  echo "<tr>";
    echo "<td class='l20'>"; 
      echo " <b> Dbpedia Link </b>";
    echo "</td>";
     echo "<td class='l20'>"; 
      echo " <b> wikipedia Link </b>";
    echo "</td>";
   echo "</tr>";

	/* $i=0;
	while( $row = $result->fetch_array() )
	{
		if ($i%2==0) {
			echo '<tr bgcolor="#99ff66">';
		}
		else{
			echo '<tr bgcolor="#3bb300">';
		}
			$i++;

			//echo "<td class='l20'> <a href='http://www.wikipedia.org/wiki/$row[$field]'> $row[$field] </a> </td>";

			foreach($fields as $field)
			{
				echo "<td class='l20'> <a href='http://www.wikipedia.org/wiki/$row[$field]'> $row[$field] </a> </td>";
			} 
		echo "</tr>"; 
	} */

  $i=0;
  foreach ($rows as $row) 
  {
      if ($i%2==0) {
        echo '<tr bgcolor="#99ff66">';
      }
      else{
        echo '<tr bgcolor="#3bb300">';
      }
      $i++;
      echo "<td class='l20'> <a href='$row[hotels]'> $row[hotels] </a> </td>";

      $str1 = "http://www.wikipedia.org/wiki/". $row['hotels'];
      $str2 = "http://www.wikipedia.org/wiki/http://dbpedia.org/resource/";
      $str3 = substr($str1, strlen($str2) ,strlen($str1));
      
      echo "<td class='l20'> <a href='http://www.wikipedia.org/wiki/$str3'> $str3 </a> </td>";
    echo '</tr>'; 
  }

echo "</table>";
?>