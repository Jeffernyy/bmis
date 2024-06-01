

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblcaptain VALUES("1","jeffern","dulla","malinao","jeffernzxc","$2y$10$mFacXPnHonb/52B6UIerte/uQ8Al.qf2uMm2PMxIRZ9vGIBaPWWhK","1717265901948_320100311_1405815266617048_55131045237012181_n.jpg","06/02/2024 02:18 AM","n/a","system administrator as administrator","n/a");



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblgovoffice VALUES("1","City Government of Panabo - City Legal Office","06/02/2024 02:21 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblgovoffice VALUES("2","General Services Office - City Government of Panabo","06/02/2024 02:21 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblgovoffice VALUES("3","City Government of Panabo - City Human Resource Management Office","06/02/2024 02:21 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblgovoffice VALUES("4","City Government of Panabo - City Planning and Development Office","06/02/2024 02:21 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblgovoffice VALUES("5","City Administrator’s Office - City Government of Panabo","06/02/2024 02:22 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblgovoffice VALUES("6","City Government of Panabo - City Accountant’s Office","06/02/2024 02:22 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblgovoffice VALUES("7","City Government of Panabo - CMO - Community Affairs","06/02/2024 02:22 AM","n/a","system administrator as administrator","n/a");



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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbllogs VALUES("1","administrator","system","administrator","06/02/2024 01:50 AM","added resident details...\n\nid: 1\nresident_fname: jeffern\nresident_mname: dulla\nresident_lname: malinao\nresident_birth_date: 04/02/1997\nresident_age: 27\nresident_gender: male\nresident_household_num: 1760\nresident_total_household_mem: 3\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: nido\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 53\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639317348750\nresident_email_add: jeffern@gmail.com\nresident_uname: jeffern\nresident_date_added: 06/02/2024 01:50 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 1 for resident jeffern dulla malinao\ndate and time added 06/02/2024 01:50 AM\n");
INSERT INTO tbllogs VALUES("2","administrator","system","administrator","06/02/2024 01:52 AM","added resident details...\n\nid: 2\nresident_fname: flor\nresident_mname: n/a\nresident_lname: cabillar\nresident_birth_date: 08/03/1999\nresident_age: 24\nresident_gender: female\nresident_household_num: 1631\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: carmen, panabo city, davao del norte\nresident_purok: liberty\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 3\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: flor@gmail.com\nresident_uname: flor\nresident_date_added: 06/02/2024 01:52 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 2 for resident flor cabillar\ndate and time added 06/02/2024 01:52 AM\n");
INSERT INTO tbllogs VALUES("3","administrator","system","administrator","06/02/2024 01:55 AM","added resident details...\n\nid: 3\nresident_fname: clarish\nresident_mname: solania\nresident_lname: sargado\nresident_birth_date: 09/15/1999\nresident_age: 24\nresident_gender: female\nresident_household_num: 1389\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: standard days method\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: lasang, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 35\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: clarish@gmail.com\nresident_uname: clarish\nresident_date_added: 06/02/2024 01:55 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 3 for resident clarish solania sargado\ndate and time added 06/02/2024 01:55 AM\n");
INSERT INTO tbllogs VALUES("4","administrator","system","administrator","06/02/2024 01:58 AM","added resident details...\n\nid: 4\nresident_fname: acmali\nresident_mname: n/a\nresident_lname: ampuan\nresident_birth_date: 05/12/1999\nresident_age: 25\nresident_gender: male\nresident_household_num: 1835\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: muslim\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: cogon, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 51\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: acmali@gmail.com\nresident_uname: acmali\nresident_date_added: 06/02/2024 01:58 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 4 for resident acmali ampuan\ndate and time added 06/02/2024 01:58 AM\n");
INSERT INTO tbllogs VALUES("5","administrator","system","administrator","06/02/2024 02:09 AM","added resident details...\n\nid: 5\nresident_fname: abdul\nresident_mname: mokit\nresident_lname: madid\nresident_birth_date: 07/21/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1335\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: muslim\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college level\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: lasang, panabo city, davao del norte\nresident_purok: liberty\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 57\nresident_relationship_to_head: child\nresident_occupation: freelancing\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: abdul@gmail.com\nresident_uname: abdul\nresident_date_added: 06/02/2024 02:09 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 5 for resident abdul mokit madid\ndate and time added 06/02/2024 02:09 AM\n");
INSERT INTO tbllogs VALUES("6","administrator","system","administrator","06/02/2024 02:13 AM","added resident details...\n\nid: 6\nresident_fname: jasper\nresident_mname: n/a\nresident_lname: tesoro\nresident_birth_date: 11/27/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1664\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: northern, panabo city, davao del norte\nresident_purok: sustagen\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 73\nresident_relationship_to_head: child\nresident_occupation: private employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: jasper@gmail.com\nresident_uname: jasper\nresident_date_added: 06/02/2024 02:13 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 6 for resident jasper tesoro\ndate and time added 06/02/2024 02:13 AM\n");
INSERT INTO tbllogs VALUES("7","administrator","system","administrator","06/02/2024 02:15 AM","added resident details...\n\nid: 7\nresident_fname: christopher\nresident_mname: arieta\nresident_lname: estrera\nresident_birth_date: 09/22/1999\nresident_age: 24\nresident_gender: male\nresident_household_num: 1228\nresident_total_household_mem: 7\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: new pandan, panabo city, davao del norte\nresident_purok: alaska\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 103\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: tooper@gmail.com\nresident_uname: tooper\nresident_date_added: 06/02/2024 02:15 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 7 for resident christopher arieta estrera\ndate and time added 06/02/2024 02:15 AM\n");
INSERT INTO tbllogs VALUES("8","administrator","system","administrator","06/02/2024 02:17 AM","added resident details...\n\nid: 8\nresident_fname: katrina\nresident_mname: n/a\nresident_lname: de ramos\nresident_birth_date: 06/13/1999\nresident_age: 24\nresident_gender: female\nresident_household_num: 1173\nresident_total_household_mem: 5\nresident_civil_status: single\nresident_blood_type: o+\nresident_renter: no\nresident_religion: roman catholic\nresident_nationality: filipino\nresident_wra: condom\nresident_educational_attainment: college graduate\nresident_type_of_garbage_disposal: collection system\nresident_interview_by: aiza romano\nresident_birth_place: carmen, panabo city, davao del norte\nresident_purok: bearbrand\nresident_tribe: bisaya\nresident_ips: no\nresident_health_status: normal\nresident_length_of_stay: 93\nresident_relationship_to_head: child\nresident_occupation: government employee\nresident_types_of_toilet: water sealed/flush toilet\nresident_sources_of_water_supply: truck/tanker peddler, bottled water\nresident_blind_drainage: yes\nresident_mobile_num: +639123456789\nresident_email_add: katrina@gmail.com\nresident_uname: katrina\nresident_date_added: 06/02/2024 02:17 AM\nresident_date_edited: n/a\nresident_added_by: system administrator as administrator\nresident_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd resident id number 8 for resident katrina de ramos\ndate and time added 06/02/2024 02:17 AM\n");
INSERT INTO tbllogs VALUES("9","administrator","system","administrator","06/02/2024 02:18 AM","added barangay captain details...\n\nid: 1\ncaptain_fname: jeffern\ncaptain_mname: dulla\ncaptain_lname: malinao\ncaptain_uname: jeffernzxc\ncaptain_date_added: 06/02/2024 02:18 AM\ncaptain_date_edited: n/a\ncaptain_added_by: system administrator as administrator\ncaptain_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay captain id number 1 for barangay captain jeffern dulla malinao\ndate and time added 06/02/2024 02:18 AM\n");
INSERT INTO tbllogs VALUES("10","administrator","system","administrator","06/02/2024 02:18 AM","added barangay staff details...\n\nid: 1\nstaff_fname: flor\nstaff_mname: n/a\nstaff_lname: cabillar\nstaff_uname: florzxc\nstaff_date_added: 06/02/2024 02:18 AM\nstaff_date_edited: n/a\nstaff_added_by: system administrator as administrator\nstaff_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay staff id number 1 for barangay staff flor cabillar\ndate and time added 06/02/2024 02:18 AM\n");
INSERT INTO tbllogs VALUES("11","administrator","system","administrator","06/02/2024 02:19 AM","added barangay official details...\n\nid: 1\nofficial_position: punong barangay\nofficial_res_name: jeffern dulla malinao\nofficial_contact_num: 639317348750\nofficial_address: 1760 molave street, purok nido, new pandan, panabo city, davao del norte\nofficial_term_start: 03-19-2025\nofficial_term_end: 07-13-2025\nofficial_status: ongoing term\nofficial_date_added: 06/02/2024 02:19 AM\nofficial_date_edited: n/a\nofficial_added_by: system administrator as administrator\nofficial_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay official id number 1 for barangay official jeffern dulla malinao\ndate and time added 06/02/2024 02:19 AM\n");
INSERT INTO tbllogs VALUES("12","administrator","system","administrator","06/02/2024 02:20 AM","added barangay official details...\n\nid: 2\nofficial_position: barangay kagawad (ordinance)\nofficial_res_name: flor cabillar\nofficial_contact_num: 639518272634\nofficial_address: carmen, panabo city, davao del norte\nofficial_term_start: 09-17-2025\nofficial_term_end: 11-23-2025\nofficial_status: ongoing term\nofficial_date_added: 06/02/2024 02:20 AM\nofficial_date_edited: n/a\nofficial_added_by: system administrator as administrator\nofficial_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd barangay official id number 2 for barangay official flor cabillar\ndate and time added 06/02/2024 02:20 AM\n");
INSERT INTO tbllogs VALUES("13","administrator","system","administrator","06/02/2024 02:20 AM","added officer of the day details...\n\nid: 1\nofficer_fname: joy\nofficer_mname: malinao\nofficer_lname: hallegado\nofficer_position: Barangay kagawad\nofficer_date_added: 06/02/2024 02:20 AM\nofficer_date_edited: n/a\nofficer_added_by: system administrator as administrator\nofficer_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd officer of the day id number 1 for officer of the day joy malinao hallegado\ndate and time added 06/02/2024 02:20 AM\n");
INSERT INTO tbllogs VALUES("14","administrator","system","administrator","06/02/2024 02:20 AM","added officer of the day details...\n\nid: 2\nofficer_fname: delfin\nofficer_mname: salvador\nofficer_lname: hallegado\nofficer_position: Barangay kagawad\nofficer_date_added: 06/02/2024 02:20 AM\nofficer_date_edited: n/a\nofficer_added_by: system administrator as administrator\nofficer_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd officer of the day id number 2 for officer of the day delfin salvador hallegado\ndate and time added 06/02/2024 02:20 AM\n");
INSERT INTO tbllogs VALUES("15","administrator","system","administrator","06/02/2024 02:21 AM","added government office details...\n\nid: 1\ngov_office: City Government of Panabo - City Legal Office\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 1 for government office City Government of Panabo - City Legal Office\ndate and time added 06/02/2024 02:21 AM\n");
INSERT INTO tbllogs VALUES("16","administrator","system","administrator","06/02/2024 02:21 AM","added government office details...\n\nid: 2\ngov_office: General Services Office - City Government of Panabo\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 2 for government office General Services Office - City Government of Panabo\ndate and time added 06/02/2024 02:21 AM\n");
INSERT INTO tbllogs VALUES("17","administrator","system","administrator","06/02/2024 02:21 AM","added government office details...\n\nid: 3\ngov_office: City Government of Panabo - City Human Resource Management Office\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 3 for government office City Government of Panabo - City Human Resource Management Office\ndate and time added 06/02/2024 02:21 AM\n");
INSERT INTO tbllogs VALUES("18","administrator","system","administrator","06/02/2024 02:21 AM","added government office details...\n\nid: 4\ngov_office: City Government of Panabo - City Planning and Development Office\ngov_office_date_added: 06/02/2024 02:21 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 4 for government office City Government of Panabo - City Planning and Development Office\ndate and time added 06/02/2024 02:21 AM\n");
INSERT INTO tbllogs VALUES("19","administrator","system","administrator","06/02/2024 02:22 AM","added government office details...\n\nid: 5\ngov_office: City Administrator’s Office - City Government of Panabo\ngov_office_date_added: 06/02/2024 02:22 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 5 for government office City Administrator’s Office - City Government of Panabo\ndate and time added 06/02/2024 02:22 AM\n");
INSERT INTO tbllogs VALUES("20","administrator","system","administrator","06/02/2024 02:22 AM","added government office details...\n\nid: 6\ngov_office: City Government of Panabo - City Accountant’s Office\ngov_office_date_added: 06/02/2024 02:22 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 6 for government office City Government of Panabo - City Accountant’s Office\ndate and time added 06/02/2024 02:22 AM\n");
INSERT INTO tbllogs VALUES("21","administrator","system","administrator","06/02/2024 02:22 AM","added government office details...\n\nid: 7\ngov_office: City Government of Panabo - CMO - Community Affairs\ngov_office_date_added: 06/02/2024 02:22 AM\ngov_office_date_edited: n/a\ngov_office_added_by: system administrator as administrator\ngov_office_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd government office id number 7 for government office City Government of Panabo - CMO - Community Affairs\ndate and time added 06/02/2024 02:22 AM\n");
INSERT INTO tbllogs VALUES("22","administrator","system","administrator","06/02/2024 02:22 AM","added purpose details...\n\nid: 1\npurpose: employment\npurpose_date_added: 06/02/2024 02:22 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 1 for purpose employment\ndate and time added 06/02/2024 02:22 AM\n");
INSERT INTO tbllogs VALUES("23","administrator","system","administrator","06/02/2024 02:22 AM","added purpose details...\n\nid: 2\npurpose: registry of deeds\npurpose_date_added: 06/02/2024 02:22 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 2 for purpose registry of deeds\ndate and time added 06/02/2024 02:22 AM\n");
INSERT INTO tbllogs VALUES("24","administrator","system","administrator","06/02/2024 02:22 AM","added purpose details...\n\nid: 3\npurpose: financial assistance\npurpose_date_added: 06/02/2024 02:22 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 3 for purpose financial assistance\ndate and time added 06/02/2024 02:22 AM\n");
INSERT INTO tbllogs VALUES("25","administrator","system","administrator","06/02/2024 02:23 AM","added purpose details...\n\nid: 4\npurpose: scholarship\npurpose_date_added: 06/02/2024 02:23 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 4 for purpose scholarship\ndate and time added 06/02/2024 02:23 AM\n");
INSERT INTO tbllogs VALUES("26","administrator","system","administrator","06/02/2024 02:23 AM","added purpose details...\n\nid: 5\npurpose: registrar\npurpose_date_added: 06/02/2024 02:23 AM\npurpose_date_edited: n/a\npurpose_added_by: system administrator as administrator\npurpose_edited_by: n/a\n\nthis add is done by system administrator as administrator\nadd purpose id number 5 for purpose registrar\ndate and time added 06/02/2024 02:23 AM\n");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficer VALUES("1","joy","malinao","hallegado","Barangay kagawad","06/02/2024 02:20 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblofficer VALUES("2","delfin","salvador","hallegado","Barangay kagawad","06/02/2024 02:20 AM","n/a","system administrator as administrator","n/a");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficial VALUES("1","punong barangay","1","639317348750","1760 molave street, purok nido, new pandan, panabo city, davao del norte","03-19-2025","07-13-2025","ongoing term","06/02/2024 02:19 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblofficial VALUES("2","barangay kagawad (ordinance)","2","639518272634","carmen, panabo city, davao del norte","09-17-2025","11-23-2025","ongoing term","06/02/2024 02:20 AM","n/a","system administrator as administrator","n/a");



CREATE TABLE `tblpurpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purpose` varchar(255) NOT NULL,
  `purpose_date_added` varchar(50) NOT NULL,
  `purpose_date_edited` varchar(50) NOT NULL,
  `purpose_added_by` varchar(100) NOT NULL,
  `purpose_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpurpose VALUES("1","employment","06/02/2024 02:22 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("2","registry of deeds","06/02/2024 02:22 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("3","financial assistance","06/02/2024 02:22 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("4","scholarship","06/02/2024 02:23 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblpurpose VALUES("5","registrar","06/02/2024 02:23 AM","n/a","system administrator as administrator","n/a");



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
  `resident_mobile_num` varchar(13) NOT NULL,
  `resident_upass` varchar(100) NOT NULL,
  `resident_secret_key` varchar(100) NOT NULL,
  `resident_image` varchar(100) NOT NULL,
  `resident_date_added` varchar(50) NOT NULL,
  `resident_date_edited` varchar(50) NOT NULL,
  `resident_added_by` varchar(100) NOT NULL,
  `resident_edited_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblresident VALUES("1","jeffern","dulla","malinao","04/02/1997","27","male","1760","3","single","o+","no","roman catholic","filipino","standard days method","college graduate","collection system","aiza romano","new pandan, panabo city, davao del norte","nido","bisaya","no","normal","53","child","freelancing","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","jeffern@gmail.com","jeffern","+639317348750","$2y$10$2oG97gGvwqhR4.pgP5i1U.suF5lgqmY5cddvZD3Tlx8jODfW3YKHm","6c622374a054cef67cd83d8e410b0393","1717264244420_320100311_1405815266617048_55131045237012181_n.jpg","06/02/2024 01:50 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("2","flor","n/a","cabillar","08/03/1999","24","female","1631","5","single","o+","no","christianity","filipino","standard days method","college graduate","collection system","aiza romano","carmen, panabo city, davao del norte","liberty","bisaya","no","normal","3","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","flor@gmail.com","flor","+639123456789","$2y$10$hMG.cKAoYQK2K5TAhb5lheWzFvGuNph8LTPLEolOsa9RVCTEgK0qa","5d3a010e20747f680724f755740b2476","1717264352170_415258647_3651147671871955_914763302564823368_n.jpg","06/02/2024 01:52 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("3","clarish","solania","sargado","09/15/1999","24","female","1389","5","single","o+","no","roman catholic","filipino","standard days method","college graduate","collection system","aiza romano","lasang, panabo city, davao del norte","sustagen","bisaya","no","normal","35","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","clarish@gmail.com","clarish","+639123456789","$2y$10$WaX4n1cMaFJAYZuxAOnwmuKUOEm8Jx.dVf90htLn1EWiFX2aylUke","1fb477b55758311e6ff4c056cb7ac09e","1717264556720_418500371_345381331753603_7294103899009814734_n.jpg","06/02/2024 01:55 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("4","acmali","n/a","ampuan","05/12/1999","25","male","1835","7","single","o+","no","muslim","filipino","condom","college graduate","collection system","aiza romano","cogon, panabo city, davao del norte","sustagen","bisaya","no","normal","51","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","acmali@gmail.com","acmali","+639123456789","$2y$10$bc5Ag5z3HyEBEyPT2iL1ye2eb/yS2oWzyTwddGu4IQswaY.4opmGS","1268c94fc4e564f90739bb5f836987f8","1717264706096_122432400_2665171743734615_3916165459951035233_n.jpg","06/02/2024 01:58 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("5","abdul","mokit","madid","07/21/1999","24","male","1335","5","single","o+","no","muslim","filipino","condom","college level","collection system","aiza romano","lasang, panabo city, davao del norte","liberty","bisaya","no","normal","57","child","freelancing","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","abdul@gmail.com","abdul","+639123456789","$2y$10$qxnVhvRTKCc/MM1q07xKEO0uz6.TXswrPQls7GdxKdjda9gom53ZK","2a4d61029affe16c5117e75802fc43a5","1717265363156_412591795_3446908852238500_4019734500755742446_n.jpg","06/02/2024 02:09 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("6","jasper","n/a","tesoro","11/27/1999","24","male","1664","7","single","o+","no","roman catholic","filipino","condom","college graduate","collection system","aiza romano","northern, panabo city, davao del norte","sustagen","bisaya","no","normal","73","child","private employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","jasper@gmail.com","jasper","+639123456789","$2y$10$2PqhvhSTSVFcVy2/xOXaJeBGZCF3AN2mQ.hkvpaXvd3nWk2LvKnGe","79e7e063fb877450f5674d1dd7b8d88c","1717265581093_66260721_177339276619149_409765542467993600_n.jpg","06/02/2024 02:13 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("7","christopher","arieta","estrera","09/22/1999","24","male","1228","7","single","o+","no","roman catholic","filipino","condom","college graduate","collection system","aiza romano","new pandan, panabo city, davao del norte","alaska","bisaya","no","normal","103","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","tooper@gmail.com","tooper","+639123456789","$2y$10$XrPkueMWzV83eswZ.s2XKO0c6.WjA7Ilow6d6/eSeZQgyx8pvPaxa","6ddee4ecaed8a31d8b1fccac00b74834","1717265723291_372683410_3523925534586719_1491809861384612562_n.jpg","06/02/2024 02:15 AM","n/a","system administrator as administrator","n/a");
INSERT INTO tblresident VALUES("8","katrina","n/a","de ramos","06/13/1999","24","female","1173","5","single","o+","no","roman catholic","filipino","condom","college graduate","collection system","aiza romano","carmen, panabo city, davao del norte","bearbrand","bisaya","no","normal","93","child","government employee","water sealed/flush toilet","truck/tanker peddler, bottled water","yes","katrina@gmail.com","katrina","+639123456789","$2y$10$9XAxpj.UIiuGHKArSBGEs.sNSsa0uOt6zzhHZBqHvUDLvQsnpCNAK","d44117ad6df649ea513a2f00730a141b","1717265845087_361850788_1721581494970777_8117208781172735281_n.jpg","06/02/2024 02:17 AM","n/a","system administrator as administrator","n/a");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblstaff VALUES("1","flor","n/a","cabillar","florzxc","$2y$10$yFQ7l98psdF1qinwKZapt.0ytfPiprzOggGNYcsOGcOWD5yW.VY0O","1717265920478_415258647_3651147671871955_914763302564823368_n.jpg","06/02/2024 02:18 AM","n/a","system administrator as administrator","n/a");



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

