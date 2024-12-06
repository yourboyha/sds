<?php

$sql = "INSERT INTO `schedule` (`ScheduleID`, `SubjectID`, `TeacherID`, `RoomID`, `TimeSlot`, `DayOfWeek`, `ClassGroup`) VALUES (NULL, '76', '5', '1', 'Mon1-Mon3', 'Monday', '15');";

$sql = "
SELECT 
sc.TimeSlot, 
sc.DayOfWeek, 
s.SubjectCode, 
r.RoomName, 
u.FullName AS TeacherName, 
cg.ClassGroupName 
FROM schedule sc 
JOIN subjects s ON sc.SubjectID = s.SubjectID 
JOIN rooms r ON sc.RoomID = r.RoomID 
JOIN teachers t ON sc.TeacherID = t.TeacherID 
JOIN users u ON t.UserID = u.UserID 
JOIN classgroup cg ON sc.ClassGroupID = cg.ClassGroupID 
WHERE s.SubjectCode = '21910-2009' 
AND r.RoomName = 'LAB1' 
AND u.FullName = 'ครูคอม1' 
AND cg.ClassGroupName = 'ปวช.1/1';
";