<?PHP

  
  function getFileList($dir)
  {
    // array to hold return value
    $retval = array();

    // add trailing / if missing
    if(substr($dir, -1) != "/") $dir .= "/";

    // open pointer to directory and read list of files
    $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read())) {
      // skip hidden files
      if($entry[0] == ".") continue;
      if(is_dir("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry/",
          "type" => filetype("$dir$entry"),
          "size" => 0,
          "lastmod" => filemtime("$dir$entry")
        );
      } elseif(is_readable("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry",
          "type" => mime_content_type("$dir$entry"),
          "size" => filesize("$dir$entry"),
          "lastmod" => filemtime("$dir$entry")
        );
      }
    }
    $d->close();

    return $retval;
  }
?>



<h1>Download Web App and Android App</h1>

<table class="collapse" border="1">
<thead>
<tr><th></th><th>Folder/Name</th><th>Type</th><th>Size</th><th>Last Modified</th><th>Download</th></tr>
</thead>
<tbody>

<?PHP
	
 
  $download = 'download';
  
  $dirlist = getFileList("download/");
  foreach($dirlist as $file) {
    if(!preg_match("/\.zip$/", $file['name'])) continue;
    echo "<tr>\n";
    echo "<td><img src=\"{$file['name']}\" width=\"64\" alt=\"\"></td>\n";
    echo "<td>{$file['name']}</td>\n";
    echo "<td>{$file['type']}</td>\n";
    echo "<td>{$file['size']}</td>\n";
    echo "<td>",date('r', $file['lastmod']),"</td>\n";
	echo '<td><a href = "download.php/?id='.$file['name'].'">'.$download.'</a></td>';	
    echo "</tr>\n";
	
  }
?>






</tbody>
</table>