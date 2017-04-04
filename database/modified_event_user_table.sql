ALTER TABLE  `sramcms_event_users` ADD  `appointment_date` DATE NOT NULL AFTER  `booked_date` ,
ADD  `appointment_start_time` TIME NOT NULL AFTER  `appointment_date` ,
ADD  `appointment_end_time` TIME NOT NULL AFTER  `appointment_start_time` ;