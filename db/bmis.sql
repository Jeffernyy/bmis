

CREATE TABLE `tblannouncement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement` varchar(100) NOT NULL,
  `announcement_date` varchar(50) NOT NULL,
  `announcement_description` varchar(255) NOT NULL,
  `announcement_date_added` varchar(50) NOT NULL,
  `announcement_date_edited` varchar(50) NOT NULL,
  `announcement_added_by` varchar(100) NOT NULL,
  `announcement_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblannouncementphoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_id` varchar(10) NOT NULL,
  `announcement_filename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblbldgpermit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bldgpermit_num` varchar(50) NOT NULL,
  `bldgpermit_res_id` varchar(10) NOT NULL,
  `bldgpermit_purpose` varchar(100) NOT NULL,
  `bldgpermit_findings` varchar(100) NOT NULL,
  `bldgpermit_or_num` varchar(50) NOT NULL,
  `bldgpermit_amount` varchar(10) NOT NULL,
  `bldgpermit_status` varchar(50) NOT NULL,
  `bldgpermit_date_added` varchar(50) NOT NULL,
  `bldgpermit_date_edited` varchar(50) NOT NULL,
  `bldgpermit_date_requested` varchar(50) NOT NULL,
  `bldgpermit_date_approved` varchar(50) NOT NULL,
  `bldgpermit_date_disapproved` varchar(50) NOT NULL,
  `bldgpermit_added_by` varchar(100) NOT NULL,
  `bldgpermit_edited_by` varchar(100) NOT NULL,
  `bldgpermit_requested_by` varchar(100) NOT NULL,
  `bldgpermit_approved_by` varchar(100) NOT NULL,
  `bldgpermit_disapproved_by` varchar(100) NOT NULL,
  `bldgpermit_extra` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blotter_complainant` varchar(100) NOT NULL,
  `blotter_complainant_age` varchar(5) NOT NULL,
  `blotter_complainant_contact_num` varchar(15) NOT NULL,
  `blotter_complainant_address` varchar(200) NOT NULL,
  `blotter_respondent` varchar(100) NOT NULL,
  `blotter_respondent_age` varchar(5) NOT NULL,
  `blotter_respondent_contact_num` varchar(15) NOT NULL,
  `blotter_respondent_address` varchar(255) NOT NULL,
  `blotter_first_complaint` varchar(255) NOT NULL,
  `blotter_second_complaint` varchar(255) NOT NULL,
  `blotter_action_taken` varchar(50) NOT NULL,
  `blotter_status` varchar(50) NOT NULL,
  `blotter_location_of_incident` varchar(100) NOT NULL,
  `blotter_case_num` varchar(25) NOT NULL,
  `blotter_for` varchar(100) NOT NULL,
  `blotter_date_added` varchar(50) NOT NULL,
  `blotter_date_edited` varchar(50) NOT NULL,
  `blotter_added_by` varchar(100) NOT NULL,
  `blotter_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblcaptain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `captain_fname` varchar(50) NOT NULL,
  `captain_mname` varchar(50) NOT NULL,
  `captain_lname` varchar(50) NOT NULL,
  `captain_uname` varchar(50) NOT NULL,
  `captain_upass` varchar(100) NOT NULL,
  `captain_image` varchar(100) NOT NULL,
  `captain_date_added` varchar(50) NOT NULL,
  `captain_date_edited` varchar(50) NOT NULL,
  `captain_added_by` varchar(100) NOT NULL,
  `captain_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblclearance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clearance_num` varchar(50) NOT NULL,
  `clearance_res_id` varchar(10) NOT NULL,
  `clearance_purpose` varchar(100) NOT NULL,
  `clearance_findings` varchar(100) NOT NULL,
  `clearance_or_num` varchar(50) NOT NULL,
  `clearance_amount` varchar(10) NOT NULL,
  `clearance_status` varchar(50) NOT NULL,
  `clearance_date_added` varchar(50) NOT NULL,
  `clearance_date_edited` varchar(50) NOT NULL,
  `clearance_date_requested` varchar(50) NOT NULL,
  `clearance_date_approved` varchar(50) NOT NULL,
  `clearance_date_disapproved` varchar(50) NOT NULL,
  `clearance_added_by` varchar(100) NOT NULL,
  `clearance_edited_by` varchar(100) NOT NULL,
  `clearance_requested_by` varchar(100) NOT NULL,
  `clearance_approved_by` varchar(100) NOT NULL,
  `clearance_disapproved_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblgovoffice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gov_office` varchar(255) NOT NULL,
  `gov_office_date_added` varchar(50) NOT NULL,
  `gov_office_date_edited` varchar(50) NOT NULL,
  `gov_office_added_by` varchar(100) NOT NULL,
  `gov_office_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblhousehold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `household_num` varchar(25) NOT NULL,
  `household_purok` varchar(50) NOT NULL,
  `household_total_mem` varchar(10) NOT NULL,
  `household_head_of_family` varchar(100) NOT NULL,
  `household_date_added` varchar(50) NOT NULL,
  `household_date_edited` varchar(50) NOT NULL,
  `household_added_by` varchar(100) NOT NULL,
  `household_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblindigent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indigent_num` varchar(50) NOT NULL,
  `indigent_res_id` varchar(10) NOT NULL,
  `indigent_requester_res_id` varchar(100) NOT NULL,
  `indigent_purpose` varchar(100) NOT NULL,
  `indigent_gov_office` varchar(255) NOT NULL,
  `indigent_findings` varchar(100) NOT NULL,
  `indigent_or_num` varchar(50) NOT NULL,
  `indigent_payment` varchar(10) NOT NULL,
  `indigent_status` varchar(50) NOT NULL,
  `indigent_officer_res_id` varchar(5) NOT NULL,
  `indigent_officer_position_id` varchar(5) NOT NULL,
  `indigent_date_added` varchar(50) NOT NULL,
  `indigent_date_edited` varchar(50) NOT NULL,
  `indigent_date_requested` varchar(50) NOT NULL,
  `indigent_date_approved` varchar(50) NOT NULL,
  `indigent_date_disapproved` varchar(50) NOT NULL,
  `indigent_added_by` varchar(100) NOT NULL,
  `indigent_edited_by` varchar(100) NOT NULL,
  `indigent_requested_by` varchar(100) NOT NULL,
  `indigent_approved_by` varchar(100) NOT NULL,
  `indigent_disapproved_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblloginattempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_attempts_ip_address` varchar(255) NOT NULL,
  `login_attempts_time_banned` varchar(100) DEFAULT NULL,
  `login_attempts_count` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `login_attempts_ip_address` (`login_attempts_ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblloginattempts VALUES("1","::1","0","0");



CREATE TABLE `tbllogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logs_user_type` varchar(100) NOT NULL,
  `logs_fname` varchar(50) NOT NULL,
  `logs_lname` varchar(50) NOT NULL,
  `logs_logdate` varchar(50) NOT NULL,
  `logs_action` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbllogs VALUES("1","administrator","system","administrator","05/05/2024 09:16 PM","added resident details...\n\nid: 1\nresident_fname: jeffern\nresident_mname: dulla\nresident_lname: malinao\nresident_birth_date: 04/02/1997\nresident_age: 27\nresident_gender: male\nresident_household_num: 1760\nresident_total_household_mem: 3\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: nido\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 183\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: jeffern@gmail.com\nresident_uname: jeffern\nresident_date_added: 05/05/2024 09:16 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 1 for resident jeffern dulla malinao\ndate and time added 05/05/2024 09:16 PM\n");
INSERT INTO tbllogs VALUES("2","administrator","system","administrator","05/05/2024 09:21 PM","added resident details...\n\nid: 2\nresident_fname: flor\nresident_mname: n/a\nresident_lname: cabillar\nresident_birth_date: 08/03/1997\nresident_age: 26\nresident_gender: female\nresident_household_num: 1631\nresident_total_household_mem: 9\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: christianity\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: carmen, panabo city, davao del norte\nresident_purok: liberty\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 5\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: flor@gmail.com\nresident_uname: flor\nresident_date_added: 05/05/2024 09:21 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 2 for resident flor cabillar\ndate and time added 05/05/2024 09:21 PM\n");
INSERT INTO tbllogs VALUES("3","administrator","system","administrator","05/05/2024 09:23 PM","added resident details...\n\nid: 3\nresident_fname: abdul\nresident_mname: mokit\nresident_lname: madid\nresident_birth_date: 07/13/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1983\nresident_total_household_mem: 3\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: muslim\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: lasang, panabo city, davao del norte\nresident_purok: liberty\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 71\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: abdul@gmail.com\nresident_uname: abdul\nresident_date_added: 05/05/2024 09:23 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 3 for resident abdul mokit madid\ndate and time added 05/05/2024 09:23 PM\n");
INSERT INTO tbllogs VALUES("4","administrator","system","administrator","05/05/2024 09:25 PM","added resident details...\n\nid: 4\nresident_fname: acmali\nresident_mname: n/a\nresident_lname: ampuan\nresident_birth_date: 05/11/2000\nresident_age: 23\nresident_gender: male\nresident_household_num: 1371\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: muslim\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: jeffern malinao\nresident_birth_place: cogon, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 48\nresident_relationship_to_head: child\nresident_occupation: student\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: acmali@gmail.com\nresident_uname: acmali\nresident_date_added: 05/05/2024 09:25 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 4 for resident acmali ampuan\ndate and time added 05/05/2024 09:25 PM\n");
INSERT INTO tbllogs VALUES("5","administrator","system","administrator","05/05/2024 10:21 PM","added resident details...\n\nid: 5\nresident_fname: clarish\nresident_mname: solania\nresident_lname: sargado\nresident_birth_date: 07/19/2000\nresident_age: 23\nresident_gender: female\nresident_household_num: 3179\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: jeffern malinao\nresident_birth_place: lasang, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 81\nresident_relationship_to_head: child\nresident_occupation: student\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: clarish@gmail.com\nresident_uname: clarish\nresident_date_added: 05/05/2024 10:21 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 5 for resident clarish solania sargado\ndate and time added 05/05/2024 10:21 PM\n");
INSERT INTO tbllogs VALUES("6","administrator","system","administrator","05/05/2024 10:23 PM","added resident details...\n\nid: 6\nresident_fname: katrina\nresident_mname: n/a\nresident_lname: de ramos\nresident_birth_date: 11/24/1997\nresident_age: 26\nresident_gender: female\nresident_household_num: 2177\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: carmen, panabo city, davao del norte\nresident_purok: alaska\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 61\nresident_relationship_to_head: child\nresident_occupation: student\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: katrina@gmail.com\nresident_uname: katrina\nresident_date_added: 05/05/2024 10:23 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 6 for resident katrina de ramos\ndate and time added 05/05/2024 10:23 PM\n");
INSERT INTO tbllogs VALUES("7","administrator","system","administrator","05/05/2024 10:26 PM","added resident details...\n\nid: 7\nresident_fname: christopher\nresident_mname: arieta\nresident_lname: estrera\nresident_birth_date: 03/18/1999\nresident_age: 25\nresident_gender: male\nresident_household_num: 1039\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: jeffern malinao\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: bearbrand\nresident_tribe: bisaya\nresident_ips: yes\nresident_health_status: normal\nresident_length_of_stay: 83\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: tooper@gmail.com\nresident_uname: tooper\nresident_date_added: 05/05/2024 10:26 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 7 for resident christopher arieta estrera\ndate and time added 05/05/2024 10:26 PM\n");
INSERT INTO tbllogs VALUES("8","administrator","system","administrator","05/05/2024 10:28 PM","added resident details...\n\nid: 8\nresident_fname: jasper\nresident_mname: n/a\nresident_lname: tesoro\nresident_birth_date: 01/13/1999\nresident_age: 25\nresident_gender: male\nresident_household_num: 1036\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: jeffern malinao\nresident_birth_place: southern, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: yes\nresident_health_status: normal\nresident_length_of_stay: 29\nresident_relationship_to_head: child\nresident_occupation: private employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: 639123456789\nresident_email_add: jasper@gmail.com\nresident_uname: jasper\nresident_date_added: 05/05/2024 10:28 PM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 8 for resident jasper tesoro\ndate and time added 05/05/2024 10:28 PM\n");
INSERT INTO tbllogs VALUES("9","administrator","system","administrator","05/05/2024 10:31 PM","added purpose details...\n\nid: 1\npurpose: financial assistance\npurpose_date_added: 05/05/2024 10:31 PM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 1 for purpose financial assistance\ndate and time added 05/05/2024 10:31 PM\n");
INSERT INTO tbllogs VALUES("10","administrator","system","administrator","05/05/2024 10:31 PM","added purpose details...\n\nid: 2\npurpose: scholarship\npurpose_date_added: 05/05/2024 10:31 PM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 2 for purpose scholarship\ndate and time added 05/05/2024 10:31 PM\n");
INSERT INTO tbllogs VALUES("11","administrator","system","administrator","05/05/2024 10:31 PM","added purpose details...\n\nid: 3\npurpose: registry of deeds\npurpose_date_added: 05/05/2024 10:31 PM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 3 for purpose registry of deeds\ndate and time added 05/05/2024 10:31 PM\n");
INSERT INTO tbllogs VALUES("12","administrator","system","administrator","05/05/2024 10:31 PM","added purpose details...\n\nid: 4\npurpose: requirements\npurpose_date_added: 05/05/2024 10:31 PM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 4 for purpose requirements\ndate and time added 05/05/2024 10:31 PM\n");
INSERT INTO tbllogs VALUES("13","administrator","system","administrator","05/05/2024 10:31 PM","added purpose details...\n\nid: 5\npurpose: employment\npurpose_date_added: 05/05/2024 10:31 PM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 5 for purpose employment\ndate and time added 05/05/2024 10:31 PM\n");



CREATE TABLE `tbllowincome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lowincome_num` varchar(50) NOT NULL,
  `lowincome_res_id` varchar(10) NOT NULL,
  `lowincome_requester_res_id` varchar(100) NOT NULL,
  `lowincome_children_res_id` varchar(100) NOT NULL,
  `lowincome_children_age` varchar(5) NOT NULL,
  `lowincome_num_of_children` varchar(20) NOT NULL,
  `lowincome_annual_income` varchar(20) NOT NULL,
  `lowincome_gov_office` varchar(255) NOT NULL,
  `lowincome_findings` varchar(100) NOT NULL,
  `lowincome_or_num` varchar(50) NOT NULL,
  `lowincome_payment` varchar(10) NOT NULL,
  `lowincome_status` varchar(50) NOT NULL,
  `lowincome_officer_res_id` varchar(5) NOT NULL,
  `lowincome_officer_position_id` varchar(5) NOT NULL,
  `lowincome_date_added` varchar(50) NOT NULL,
  `lowincome_date_edited` varchar(50) NOT NULL,
  `lowincome_date_requested` varchar(50) NOT NULL,
  `lowincome_date_approved` varchar(50) NOT NULL,
  `lowincome_date_disapproved` varchar(50) NOT NULL,
  `lowincome_added_by` varchar(100) NOT NULL,
  `lowincome_edited_by` varchar(100) NOT NULL,
  `lowincome_requested_by` varchar(100) NOT NULL,
  `lowincome_approved_by` varchar(100) NOT NULL,
  `lowincome_disapproved_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblofficer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `officer_fname` varchar(50) NOT NULL,
  `officer_mname` varchar(50) NOT NULL,
  `officer_lname` varchar(50) NOT NULL,
  `officer_position` varchar(50) NOT NULL,
  `officer_date_added` varchar(50) NOT NULL,
  `officer_date_edited` varchar(50) NOT NULL,
  `officer_added_by` varchar(100) NOT NULL,
  `officer_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblofficial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `official_position` varchar(50) NOT NULL,
  `official_res_id` varchar(100) NOT NULL,
  `official_contact_num` varchar(20) NOT NULL,
  `official_address` varchar(255) NOT NULL,
  `official_term_start` varchar(25) NOT NULL,
  `official_term_end` varchar(25) NOT NULL,
  `official_status` varchar(25) NOT NULL,
  `official_date_added` varchar(50) NOT NULL,
  `official_date_edited` varchar(50) NOT NULL,
  `official_added_by` varchar(100) NOT NULL,
  `official_edited_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblpurpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purpose` varchar(255) NOT NULL,
  `purpose_date_added` varchar(50) NOT NULL,
  `purpose_date_edited` varchar(50) NOT NULL,
  `purpose_added_by` varchar(100) NOT NULL,
  `purpose_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpurpose VALUES("1","financial assistance","05/05/2024 10:31 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("2","scholarship","05/05/2024 10:31 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("3","registry of deeds","05/05/2024 10:31 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("4","requirements","05/05/2024 10:31 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("5","employment","05/05/2024 10:31 PM","n/a","system administrator as administrator","n/a");



CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resident_fname` varchar(50) NOT NULL,
  `resident_mname` varchar(50) NOT NULL,
  `resident_lname` varchar(50) NOT NULL,
  `resident_birth_date` varchar(10) NOT NULL,
  `resident_age` varchar(5) NOT NULL,
  `resident_gender` varchar(25) NOT NULL,
  `resident_household_num` varchar(25) NOT NULL,
  `resident_total_household_mem` varchar(5) NOT NULL,
  `resident_civil_status` varchar(25) NOT NULL,
  `resident_blood_type` varchar(25) NOT NULL,
  `resident_renter` varchar(5) NOT NULL,
  `resident_religion` varchar(25) NOT NULL,
  `resident_nationality` varchar(50) NOT NULL,
  `resident_wra` varchar(50) NOT NULL,
  `resident_educational_attainment` varchar(50) NOT NULL,
  `resident_type_of_garbage_disposal` varchar(50) NOT NULL,
  `resident_interview_by` varchar(100) NOT NULL,
  `resident_birth_place` varchar(255) NOT NULL,
  `resident_purok` varchar(50) NOT NULL,
  `resident_tribe` varchar(50) NOT NULL,
  `resident_ips` varchar(5) NOT NULL,
  `resident_health_status` varchar(50) NOT NULL,
  `resident_length_of_stay` varchar(10) NOT NULL,
  `resident_relationship_to_head` varchar(50) NOT NULL,
  `resident_occupation` varchar(50) NOT NULL,
  `resident_types_of_toilet` varchar(50) NOT NULL,
  `resident_sources_of_water_supply` varchar(255) NOT NULL,
  `resident_blind_drainage` varchar(5) NOT NULL,
  `resident_email_add` varchar(100) NOT NULL,
  `resident_uname` varchar(100) NOT NULL,
  `resident_mobile_num` varchar(12) NOT NULL,
  `resident_upass` varchar(100) NOT NULL,
  `resident_secret_key` varchar(100) NOT NULL,
  `resident_image` varchar(100) NOT NULL,
  `resident_date_added` varchar(50) NOT NULL,
  `resident_date_edited` varchar(50) NOT NULL,
  `resident_added_by` varchar(100) NOT NULL,
  `resident_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblresident VALUES("1","jeffern","dulla","malinao","04/02/1997","27","male","1760","3","single","o+","no","roman catholic","filipino","standard days method","college level","collection system","aiza romano","new pandan, panabo city, davao del norte","nido","bisaya","no","normal","183","child","freelancing","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","jeffern@gmail.com","jeffern","639123456789","$2y$10$FteR3FnK03EXpICWuCNwkOFeFq8Y1gLakaMg9aJZV0ejeMh4MZ3Vq","a39ae5588f19d6edff032e91b5b43523","1714915017992_320100311_1405815266617048_55131045237012181_n.jpg","05/05/2024 09:16 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("2","flor","n/a","cabillar","08/03/1997","26","female","1631","9","single","o+","no","christianity","filipino","standard days method","college graduate","collection system","aiza romano","carmen, panabo city, davao del norte","liberty","bisaya","no","normal","5","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","flor@gmail.com","flor","639123456789","$2y$10$uaHWkDPrwLYlZVxiwGaZkOeV.x5k9i/XHuO4u7EH.nFlXxjr3N8kq","7d15ddeb93cbd02b3801634ae2496587","1714915264330_415258647_3651147671871955_914763302564823368_n.jpg","05/05/2024 09:21 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("3","abdul","mokit","madid","07/13/1999","24","male","1983","3","single","o+","no","muslim","filipino","condom","college level","collection system","aiza romano","lasang, panabo city, davao del norte","liberty","bisaya","no","normal","71","child","freelancing","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","abdul@gmail.com","abdul","639123456789","$2y$10$B3srroLzjjyGdbJeF7.lnuHKR750IrztZgjMUzwtPwxqObLqX55k.","50f09a8af6985f9cc4a85234d48a84ac","1714915387770_412591795_3446908852238500_4019734500755742446_n.jpg","05/05/2024 09:23 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("4","acmali","n/a","ampuan","05/11/2000","23","male","1371","7","single","o+","no","muslim","filipino","condom","college level","collection system","jeffern malinao","cogon, panabo city, davao del norte","sustagen","bisaya","no","normal","48","child","student","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","acmali@gmail.com","acmali","639123456789","$2y$10$Ejs6LxDQTYR/ainE1MGT8.qEr6amYBE.OoBgs7wQ.RyqAl7VXEhd6","6891dcd52437388301ece0c7c08ceb01","1714915500361_122432400_2665171743734615_3916165459951035233_n.jpg","05/05/2024 09:25 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("5","clarish","solania","sargado","07/19/2000","23","female","3179","7","single","o+","no","roman catholic","filipino","standard days method","college level","collection system","jeffern malinao","lasang, panabo city, davao del norte","sustagen","bisaya","no","normal","81","child","student","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","clarish@gmail.com","clarish","639123456789","$2y$10$Z3hL.yjcsErjaGxBlbVTiuKKB0OWZbWeo5FNko9IO3rCMI92hEcNu","5059561bd6bd135c1b11155aa5a34d0e","1714918865639_418500371_345381331753603_7294103899009814734_n.jpg","05/05/2024 10:21 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("6","katrina","n/a","de ramos","11/24/1997","26","female","2177","5","single","o+","no","roman catholic","filipino","condom","college level","collection system","aiza romano","carmen, panabo city, davao del norte","alaska","bisaya","no","normal","61","child","student","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","katrina@gmail.com","katrina","639123456789","$2y$10$mjiqDzTnqC7xA2lUldjJf.UD0I.Q2fv1Qrmh.sUjIaP1OHnG6aHR2","47d495ff7547ea3885ef584c47560985","1714919037360_361850788_1721581494970777_8117208781172735281_n.jpg","05/05/2024 10:23 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("7","christopher","arieta","estrera","03/18/1999","25","male","1039","7","single","o+","no","roman catholic","filipino","condom","college level","collection system","jeffern malinao","new pandan, panabo city, davao del norte","bearbrand","bisaya","yes","normal","83","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","tooper@gmail.com","tooper","639123456789","$2y$10$p57l8xe.5UVKYepL7IW8V.dvFF3CUqikh7cgRoOb3rccco1eGDev6","f5e80c91f4645120083a1a9f86c6a18a","1714919167427_372683410_3523925534586719_1491809861384612562_n.jpg","05/05/2024 10:26 PM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("8","jasper","n/a","tesoro","01/13/1999","25","male","1036","5","single","o+","no","roman catholic","filipino","condom","college level","collection system","jeffern malinao","southern, panabo city, davao del norte","sustagen","bisaya","yes","normal","29","child","private employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","jasper@gmail.com","jasper","639123456789","$2y$10$6HRr2iM08uSdHOYHPWmcNegUTqRiY4F6/GyonPUOb/8DIrC8LJZjm","6dca95e662c6fead0cffea8829e70ef9","1714919293005_66260721_177339276619149_409765542467993600_n.jpg","05/05/2024 10:28 PM","n/a","system administrator as administrator","n/a");



CREATE TABLE `tblstaff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_fname` varchar(50) NOT NULL,
  `staff_mname` varchar(50) NOT NULL,
  `staff_lname` varchar(50) NOT NULL,
  `staff_uname` varchar(100) NOT NULL,
  `staff_upass` varchar(100) NOT NULL,
  `staff_image` varchar(100) NOT NULL,
  `staff_date_added` varchar(50) NOT NULL,
  `staff_date_edited` varchar(50) NOT NULL,
  `staff_added_by` varchar(100) NOT NULL,
  `staff_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_fname` varchar(50) NOT NULL,
  `admin_mname` varchar(50) NOT NULL,
  `admin_lname` varchar(50) NOT NULL,
  `admin_uname` varchar(100) NOT NULL,
  `admin_upass` varchar(100) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_user_type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbluser VALUES("1","system","","administrator","admin","$2y$10$tp5q3t7cV5MGqgtHkl1whOq7lHqr8LD3IYagILEe61c9SP8xIafcW","boy.svg","administrator");
INSERT INTO tbluser VALUES("2","jeffern","dulla","malinao","jeffern","$2y$10$wzdYGmUwzp2R59QAmDuaxOS4SCDgD2Zy5s3Gp6ng9XqA2N/gfKSYC","boy.svg","administrator");
INSERT INTO tbluser VALUES("3","flor","","cabillar","flor","$2y$10$4kZg8ZEU9c4KD3ViMjMFh.ilveB7wnr5QWGKBSx3mMRG5LejuEzwi","girl.svg","administrator");

