<?php
echo 'Hello Admin';
global $wpdb;
?>

<form method="post" action="">
  Folder Name: <input type="text" name="folder_name" value="<?php echo $_POST['folder_name']; ?>"/>
  <input type="submit" name="submit" value="Submit" />
</form>

<?php
if (isset($_POST['submit'])) :
  $folder_name = $_POST['folder_name'];
  require_once dirname(__FILE__) . '\excel_reader2.php';
  $data_array = array();
  $counter = 0;
  $folder_array = explode('\\', $folder_name);
  if (in_array('Live_services', $folder_array)) :
    $service_name = 'Live';
  else:
    if (in_array('Development', $folder_array)) :
      $service_name = 'Development';
    endif;
  endif;

  if ($service_name == 'Development') {
    foreach (glob("$folder_name/*.xls") as $filename) {
      $xls = new Spreadsheet_Excel_Reader("$filename");
      $row = ($xls->rowcount());
      ?>
      <table border="1">
        <?php
        if ($counter == 0) :
          ?>
          <tr>
          <?php
          for ($col = 1; $col <= $xls->colcount(); $col++) :
            ?>  
              <td> <?php print $xls->val(1, $col); ?></td>
              <?php
            endfor;
            $counter++;
            ?>
          </tr>
            <?php
          endif;
          ?>
        <tr>
        <?php
        $emp_file_name = explode('/', $filename);
        $emp_raw_name = explode('_', $emp_file_name[count($emp_file_name) - 1]);
        $emp_name = $emp_raw_name[0] . " " . $emp_raw_name[1];
        $month = $month = strstr($emp_raw_name[5], '.', true);
        $row_array = array();
        for ($col = 1; $col <= $xls->colcount(); $col++) {
          if ($col == 1) {
            array_push($row_array, $emp_name . ' ' . $xls->val($row, $col));
            ?>
              <td><?php echo $emp_name . ' ' . $xls->val($row, $col); ?>&nbsp;</td>
              <?php
            } else {
              $value = $xls->val($row, $col);
              if (!empty($value)):
                array_push($row_array, $xls->val($row, $col));
              else:
                array_push($row_array, 0);
              endif;
              ?>
              <td><?php echo $xls->val($row, $col); ?>&nbsp;</td>
            <?php
            }
          }
          array_push($row_array, $month)
          ?>
        </tr>
      </table>
          <?php
          array_push($data_array, $row_array);
        }
      }
      else {
        ?>
    <h2>Ticketing Efforts</h2>
    <table border="1">
    <?php
    foreach (glob("$folder_name/*.xls") as $filename) {
      $xls = new Spreadsheet_Excel_Reader("$filename");
      $row = ($xls->rowcount());
      $emp_file_name = explode('/', $filename);
      $emp_raw_name = explode('_', $emp_file_name[count($emp_file_name) - 1]);
      $emp_name = $emp_raw_name[0] . " " . $emp_raw_name[1];
      $month = $month = strstr($emp_raw_name[5], '.', true);
      $row_array = array();
      ?>
        <?php if ($counter == 0) : ?>
          <tr>
          <?php
          for ($col = 1; $col <= 5; $col++) :
            if ($col == 1) :
              ?>  
                <td><?php print $xls->val(1, $col); ?></td>
              <?php else : ?>
                <td> <?php print $xls->val(2, $col); ?></td>
              <?php
              endif;
            endfor;
            $counter++;
            ?>
          </tr>
          <?php endif; ?>  
        <tr>
          <?php
          for ($col = 1; $col <= 5; $col++) {
            if ($col == 1) {
              array_push($row_array, $emp_name . ' ' . $xls->val($row, $col));
              ?>
              <td><?php echo $emp_name . ' ' . $xls->val($row, $col); ?>&nbsp;</td>
              <?php
            } else {
              $value = $xls->val($row, $col);
              if (!empty($value)):
                array_push($row_array, $xls->val($row, $col));
              else:
                array_push($row_array, 0);
              endif;
              ?>
              <td><?php echo $xls->val($row, $col); ?>&nbsp;</td>
            <?php
            }
          }
          ?>
        </tr>
          <?php
        }
        ?>
    </table>
    <h2>Non Ticketing Efforts</h2>
    <table border="1">
      <?php
      $counter = 0;
      foreach (glob("$folder_name/*.xls") as $filename) {
        $xls = new Spreadsheet_Excel_Reader("$filename");
        $row = ($xls->rowcount());
        $emp_file_name = explode('/', $filename);
        $emp_raw_name = explode('_', $emp_file_name[count($emp_file_name) - 1]);
        $emp_name = $emp_raw_name[0] . " " . $emp_raw_name[1];
        $month = $month = strstr($emp_raw_name[5], '.', true);
        $row_array = array();
        ?>
        <?php if ($counter == 0) : ?>
          <tr>
            <td>Profile</td>
          <?php for ($col = 6; $col <= $xls->colcount(); $col++) : ?>
              <td> <?php print $xls->val(2, $col); ?></td>
            <?php
          endfor;
          $counter++;
          ?>
          </tr>
        <?php endif; ?>  
        <tr>
          <?php
          $non_ticketing_total = 0;
          for ($col = 6; $col <= $xls->colcount(); $col++) {
            if ($col == 6) {
              array_push($row_array, $emp_name . ' ' . $xls->val($row, $col));
              ?>
              <td><?php echo $emp_name . ' ' . $xls->val($row, 1); ?>&nbsp;</td>
              <?php
            }
            elseif ($col == $xls->colcount()) {
              
            }
              $value = $xls->val($row, $col);
              if (!empty($value)):
                $value  = $xls->val($row, $col);
              else:
                $value = 0;
              endif;
              array_push($row_array, $value);
              ?>
              <td><?php echo $value; ?>&nbsp;</td>
            <?php
            
          }
          ?>
        </tr>
          <?php
        } //End of Files For loop.
      } //End of If condition.
      ?>
  </table>
    
    
  <?php

  // Inserting Data into table.
  if ($service_name == 'Development') :
    foreach ($data_array as $value => $key) :
      $profile = $key[0];
      $ticket_number = $key[1];
      $code_create = $key[2];
      $code_review = $key[3];
      $code_rework = $key[4];
      $deployment = $key[5];
      $defect_fixing = $key[6];
      $unit_testing = $key[7];
      $requirement_review = $key[8];
      $test_case_create = $key[9];
      $test_case_review = $key[10];
      $test_Case_rework = $key[11];
      $test_case_defect_fixing = $key[12];
      $test_execution = $key[13];
      $system_test_case_create = $key[14];
      $system_test_case_review = $key[15];
      $system_test_case_rework = $key[16];
      $system_test_case_defect_fixing = $key[17];
      $system_test_execution = $key[18];
      $non_project_activities = $key[20];
      $idle_time = $key[21];
      $leaves = $key[22];
      $uat_execution = $key[19];
      $project_training = $key[23];
      $pm_effort = $key[24];
      $qa_effort = $key[25];
      $config_effort = $key[26];
      $project_effort = $key[27];
      $env_setup_effort = $key[28];
      $total = $key[29];
      $month = $key[30];

      //Checking Duplication of record
      $query = 'select id, `profile` from ' . $wpdb->prefix . 'effort_tracker where `profile` = "' . $profile . '" And month = "' . $month . '" And year = ' . date("Y");
      $myrows = $wpdb->get_results($query);
      if (empty($myrows)) :
        $query = 'insert into ' . $wpdb->prefix . 'effort_tracker (`profile`, ticket_number, code_create, code_review, code_rework, deployment,
         defect_fixing, unit_testing, requirement_review, test_case_create, test_case_review, test_Case_rework, 
         test_case_defect_fixing, test_execution, system_test_case_create, 
         system_test_case_review, system_test_case_rework, system_test_case_defect_fixing, uat_execution,non_project_activities, idle_time, leaves, project_training,
      pm_effort, qa_effort, config_effort, project_effort, env_setup_effort, total, `month`, year, `services`) values ("' .
                $profile . '",' .
                $ticket_number . ', ' .
                $code_create . ', ' .
                $code_review . ', ' .
                $code_rework . ', ' .
                $deployment . ', ' .
                $defect_fixing . ', ' .
                $unit_testing . ', ' .
                $requirement_review . ', ' .
                $test_case_create . ', ' .
                $test_case_review . ', ' .
                $test_Case_rework . ', ' .
                $test_case_defect_fixing . ', ' .
                $test_execution . ', ' .
                $system_test_case_create . ', ' .
                $system_test_case_review . ', ' .
                $system_test_case_rework . ', ' .
                $system_test_case_defect_fixing . ', ' .
                $uat_execution . ', ' .
                $non_project_activities . ', ' .
                $idle_time . ', ' .
                $leaves . ', ' .
                $project_training . ', ' .
                $pm_effort . ', ' .
                $qa_effort . ', ' .
                $config_effort . ', ' .
                $project_effort . ', ' .
                $env_setup_effort . ', ' .
                $total . ', "' .
                $month . '", ' .
                date("Y") . ', "' .
                $service_name . '"    
            )';
        echo '<br />Database record inserted successfully.<br />';
      else:

        $query = 'update ' . $wpdb->prefix . 'effort_tracker  set 
            `profile` = "' . $profile . '",' .
                '`ticket_number` = "' . $ticket_number . '",' .
                'code_create = ' . $code_create . ', ' .
                'code_review = ' . $code_review . ', ' .
                'code_rework = ' . $code_rework . ', ' .
                'deployment = ' . $deployment . ', ' .
                'defect_fixing = ' . $defect_fixing . ', ' .
                'unit_testing = ' . $unit_testing . ', ' .
                'requirement_review = ' . $requirement_review . ', ' .
                'test_case_create = ' . $test_case_create . ', ' .
                'test_case_review = ' . $test_case_review . ', ' .
                'test_Case_rework = ' . $test_Case_rework . ', ' .
                'test_case_defect_fixing = ' . $test_case_defect_fixing . ', ' .
                'test_execution = ' . $test_execution . ', ' .
                'system_test_case_create = ' . $system_test_case_create . ', ' .
                'system_test_case_review = ' . $system_test_case_review . ', ' .
                'system_test_case_rework = ' . $system_test_case_rework . ', ' .
                'system_test_case_defect_fixing = ' . $system_test_case_defect_fixing . ', ' .
                'uat_execution = ' . $uat_execution . ', ' .
                'total = ' . $total . ', ' .
                '`month` = "' . $month . '", ' .
                'year = ' . date("Y") . ' where `profile` = "' . $profile . '" And month = "' . $month . '" And year = ' . date("Y");
        echo 'Database Record updated successfully <br />';
      endif;
      $wpdb->query("$query");
      $wpdb->show_errors();

    endforeach;

  else :




  endif;
  ?>

  <?php

    
    endif;
