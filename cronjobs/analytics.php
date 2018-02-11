<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
  print_r("Unauthorized");
}
else if($_SERVER['PHP_AUTH_USER'] == 'webassets_cronjobs' && $_SERVER['PHP_AUTH_PW'] == 'xxd#e@+E?.K?') {
  $mysqli = new mysqli("localhost", "webassnp_new", "0dZwgKTb6&Td", "webassnp_webassets_new");
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

  $handle = fopen('cronindex.json', 'r');
  $contents = fread($handle, filesize('cronindex.json'));
  fclose($handle);
  $contents = json_decode($contents, true);
  $index = $contents['index'];

  $handle = fopen('cronindex.json', 'w');
  fwrite($handle, json_encode(array('index' => ($index+1)%60)));
  fclose($handle);

  $query = $mysqli->query("SELECT analytics_id,camp_id,inf_id,token_id FROM analytics WHERE is_active=1 AND analytics_id%60=".$index);
  $data = [];
  while ($row = $query->fetch_assoc()) {
    $data[] = $row;
  }

  $time = time();
  if(sizeof($data)==0) {
    print("[ANALYTICS|ERROR@{$time}] Blank response<br>");
  }
  else if(sizeof($data)) {
    $analytics = [];
    $i=0;
    foreach ($data as $key => $value) {
      $time = time();

      $ch = curl_init();
      //curl_setopt($ch, CURLOPT_URL,"http://localhost/"."api/call_analytics");
      curl_setopt($ch, CURLOPT_URL,"http://whyral.in/"."api/call_analytics");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('analytics_id' => $value['analytics_id'], 'camp_id' => $value['camp_id'], 'inf_id' => $value['inf_id'], 'token_id' => $value['token_id'])));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $server_output = curl_exec($ch);
      curl_close($ch);

      if ($server_output == "OK") {
        $query = $mysqli->query("UPDATE analytics SET last_run={$time} WHERE analytics_id=".$value['analytics_id']);
        print("[ANALYTICS|SUCCESS@{$time}] Called campaign {$value['camp_id']} using Influencer {$value['inf_id']} with Analytics ID {$value['analytics_id']}<br>");

        $handle = fopen('crondump-'.date("Y-m-d").'.dat', 'a+');
        fwrite($handle, "[ANALYTICS|SUCCESS@{$time}] Called campaign {$value['camp_id']} using Influencer {$value['inf_id']} with Analytics ID {$value['analytics_id']}\n");
        fclose($handle);
      }
      else {
        print("[ANALYTICS|ERROR@{$time}] Called campaign {$value['camp_id']} using Influencer {$value['inf_id']} with Analytics ID {$value['analytics_id']}<br>");
        print_r($server_output);

        $handle = fopen('crondump-'.date("Y-m-d").'.dat', 'a+');
        fwrite($handle, "[ANALYTICS|ERROR@{$time}] Called campaign {$value['camp_id']} using Influencer {$value['inf_id']} with Analytics ID {$value['analytics_id']}\n");
        fwrite($handle, $server_output."\n");
        fclose($handle);
      }
    }
  }
}
else {
  print("Wrong credentials.");
}
?>
