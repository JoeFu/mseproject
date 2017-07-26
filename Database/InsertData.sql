use studentdata;

CREATE TRIGGER BEFORE_INSERT_USERTABLE
BEFORE INSERT ON `studentdata`.`user`
for each row
SET new.Id = uuid();
/* Insert Use Type*/
INSERT INTO `studentdata`.`usertype`
(`Id`,
`Type`,
`Description`)
VALUES
(1,
'student',
'student');

INSERT INTO `studentdata`.`usertype`
(`Id`,
`Type`,
`Description`)
VALUES
(2,
'teacher',
'teacher');

/*Insert User*/
INSERT INTO `studentdata`.`user`
(`Id`,
`FKUserTypeId`,
`FKParentId`)
VALUES
('1',
1,
null);

INSERT INTO `studentdata`.`user`
(`Id`,
`FKUserTypeId`,
`FKParentId`)
VALUES
('2',
2,
null);

/*Insert Course*/
INSERT INTO `studentdata`.`course`
(`Id`,
`Name`)
VALUES
(1,
'Research Methods');

INSERT INTO `studentdata`.`course`
(`Id`,
`Name`)
VALUES
(2,
'Specialized Programming');

/*Insert Semester*/
INSERT INTO `studentdata`.`semester`
(`Id`,
`Name`,
`SchoolYear`)
VALUES
(1,
'Semester 1',
2016);

INSERT INTO `studentdata`.`semester`
(`Id`,
`Name`,
`SchoolYear`)
VALUES
(2,
'Semester 2',
2016);

INSERT INTO `studentdata`.`semester`
(`Id`,
`Name`,
`SchoolYear`)
VALUES
(3,
'Semester 1',
2017);

/*Insert Course Semester*/
INSERT INTO `studentdata`.`coursesemester`
(`Id`,
`FKCourseId`,
`FKSemesterId`)
VALUES
(1,
1,
1);

INSERT INTO `studentdata`.`coursesemester`
(`Id`,
`FKCourseId`,
`FKSemesterId`)
VALUES
(2,
2,
1);

INSERT INTO `studentdata`.`coursesemester`
(`Id`,
`FKCourseId`,
`FKSemesterId`)
VALUES
(3,
2,
2);

/*Insert User Course*/
INSERT INTO `studentdata`.`usercourse`
(`Id`,
`FKUserId`,
`FKCourseId`,
`IsDropped`,
`Date`,
`Grade`)
VALUES
(1,
'0ddd7f51-160e-11e7-aeac-705a0f1aec02',
1,
0,
STR_TO_DATE('12-03-2016 00:00:00','%m-%d-%Y %H:%i:%s'),
70);

INSERT INTO `studentdata`.`usercourse`
(`Id`,
`FKUserId`,
`FKCourseId`,
`IsDropped`,
`Date`,
`Grade`)
VALUES
(2,
'0ddd7f51-160e-11e7-aeac-705a0f1aec02',
2,
0,
STR_TO_DATE('12-03-2016 00:00:00','%m-%d-%Y %H:%i:%s'),
70);

INSERT INTO `studentdata`.`usercourse`
(`Id`,
`FKUserId`,
`FKCourseId`,
`IsDropped`,
`Date`,
`Grade`)
VALUES
(3,
'0e1750b9-160e-11e7-aeac-705a0f1aec02',
2,
0,
STR_TO_DATE('12-03-2016 00:00:00','%m-%d-%Y %H:%i:%s'),
-1);

/*Assignment*/
INSERT INTO `studentdata`.`assignment`
(`Id`,
`Name`,
`StartDate`,
`DueDate`,
`FKCourseId`)
VALUES
(1,
'Proposal',
STR_TO_DATE('10-04-2016 00:00:00','%m-%d-%Y %H:%i:%s'),
now(),
1);

INSERT INTO `studentdata`.`assignment`
(`Id`,
`Name`,
`StartDate`,
`DueDate`,
`FKCourseId`)
VALUES
(2,
'Assignment 2',
STR_TO_DATE('05-05-2016 00:00:00','%m-%d-%Y %H:%i:%s'),
now(),
2);

/*User Assignment*/
INSERT INTO `studentdata`.`userassignment`
(`Id`,
`FKUserId`,
`FKAssignmentId`,
`Grade`,
`SubmittedDate`)
VALUES
(1,
'0ddd7f51-160e-11e7-aeac-705a0f1aec02',
1,
60,
now());

INSERT INTO `studentdata`.`userassignment`
(`Id`,
`FKUserId`,
`FKAssignmentId`,
`Grade`,
`SubmittedDate`)
VALUES
(2,
'0ddd7f51-160e-11e7-aeac-705a0f1aec02',
2,
50,
now());

/*Component*/
INSERT INTO `studentdata`.`component`
(`Id`,
`Name`)
VALUES
(1,
'System');

INSERT INTO `studentdata`.`component`
(`Id`,
`Name`)
VALUES
(2,
'File');

INSERT INTO `studentdata`.`component`
(`Id`,
`Name`)
VALUES
(3,
'Forum');


/*Event*/
CREATE TRIGGER BEFORE_INSERT_EVENTTABLE
BEFORE INSERT ON `studentdata`.`event`
for each row
SET new.Id = uuid();

INSERT INTO `studentdata`.`event`
(`Id`,
`Name`,
`Description`,
`FKComponentId`)
VALUES
('1',
'course_move',
'Course: Distributed Systems, Semester 2, 2012',
1);

INSERT INTO `studentdata`.`event`
(`Id`,
`Name`,
`Description`,
`FKComponentId`)
VALUES
('2',
'course_view',
'Course: Distributed Systems, Semester 2, 2012',
1);

/*UserEvent*/
CREATE TRIGGER BEFORE_INSERT_USEREVENTTABLE
BEFORE INSERT ON `studentdata`.`userevent`
for each row
SET new.Id = uuid();

INSERT INTO `studentdata`.`userevent`
(`Id`,
`FKUserId`,
`FKEventId`,
`Context`,
`Time`)
VALUES
('1',
'0ddd7f51-160e-11e7-aeac-705a0f1aec02',
'1949cafa-1614-11e7-aeac-705a0f1aec02',
'Course: Distributed Systems, Semester 2, 2012',
STR_TO_DATE('05-05-2016 00:00:00','%m-%d-%Y %H:%i:%s'));

INSERT INTO `studentdata`.`userevent`
(`Id`,
`FKUserId`,
`FKEventId`,
`Context`,
`Time`)
VALUES
('2',
'0ddd7f51-160e-11e7-aeac-705a0f1aec02',
'19555c57-1614-11e7-aeac-705a0f1aec02',
'Course: Distributed Systems, Semester 2, 2012',
STR_TO_DATE('05-04-2016 00:00:00','%m-%d-%Y %H:%i:%s'));





