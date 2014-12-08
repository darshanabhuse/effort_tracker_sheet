<?php

function effort_tracker_table_create() {

    global $wpdb;

//Creating table for this twitter block
    $effort_tracker = $wpdb->prefix . "effort_tracker";
    $query = "CREATE TABLE IF NOT EXISTS " . $effort_tracker . " (
      id int(2) NOT NULL AUTO_INCREMENT,
      profile varchar(100),
      ticket_number varchar(100),
      code_create int(20),
      code_review int(4),
      code_rework int(4),
      deployment int(4),
      defect_fixing int(4),
      unit_testing int(4),
      requirement_review int(4),
      test_case_create int(4),
      test_case_review int(4),
      test_Case_rework int(4),
      test_case_defect_fixing int(4),
      test_execution int(4),
      system_test_case_create int(4),
      system_test_case_review int(4),
      system_test_case_rework int(4),
      system_test_case_defect_fixing int(4),
      system_test_execution int(4),
      uat_execution int(4),
      non_project_activities int(10),
      idle_time int(4),
      leaves int(4),
      project_training int(4),
      pm_effort int(4),
      qa_effort int(4),
      config_effort int(4),
      project_effort int(4),
      env_setup_effort int (4),
      total int(4),
      services varchar(20) DEFAULT 'Live',
      month varchar(20),
      year varchar(7),
      PRIMARY KEY (  `id` ) ,
        UNIQUE (
        `id`
        )
    );";
    $wpdb->query("$query");
    $wpdb->show_errors();
    
    $effort_tracker_live = $wpdb->prefix . "effort_tracker_live";
    
    $query_live = "CREATE TABLE IF NOT EXISTS " . $effort_tracker_live . " (
      id int(2) NOT NULL AUTO_INCREMENT,
      profile varchar(100),
      ticket_number varchar(100),
      complexity int(20),
      location int(4),
      investigation int(4),
      classroom_training int(4),
      first_time_kt_effort int(4),
      on_job_training int(4),
      idle_time int(4),
      non_project_work int(4),
      leaves int(4),
      project_mngt_mer int(4),
      project_mngt_projects int(4),
      recruitment int(4),
      release_mgnt_mer int(4),
      release_mgnt_projects int(4),
      self_study int(4),
      service_improvemt_effort int(4),
      service_management int(4),
      service_support int(4),
      technical_monitoring int(10),
      ticket_queue_monitoring int(4),
      total int(4),
      services varchar(20) DEFAULT 'Live',
      month varchar(20),
      year varchar(7),
      PRIMARY KEY (  `id` ) ,
      UNIQUE (`id`)
    );";
    $wpdb->query("$query_live");
    $wpdb->show_errors();
}
