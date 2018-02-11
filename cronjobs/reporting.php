<?php
$mysqli = new mysqli("localhost", "webassnp_new", "0dZwgKTb6&Td", "webassnp_webassets_new");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$query = $mysqli->query("SELECT report_id,category FROM reporting");
$data = [];
while ($row = $query->fetch_assoc()) {
  $data[] = $row;
}

$time = time();
if(sizeof($data)==0) {
  print("[REPORT|ERROR@{$time}] Blank response<br>");
}
else if(sizeof($data)) {
  $reports = [];
  $i=0;
  foreach ($data as $key => $value) {
    $time = time();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://whyral.in/"."admin/call_reports");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('report_id' => $value['report_id'], 'category' => $value['category'])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    curl_close($ch);

    if ($server_output == "OK") {
      $query = $mysqli->query("UPDATE reporting SET last_run={$time} WHERE report_id=".$value['report_id']);
      print("[REPORT|SUCCESS@{$time}] Called category {$value['category']} with Report ID {$value['report_id']}<br>");
    }
    else {
      print("[REPORT|ERROR@{$time}] Called category {$value['category']} with Report ID {$value['report_id']}<br>");
      print_r($server_output);
    }
  }
}

?>
