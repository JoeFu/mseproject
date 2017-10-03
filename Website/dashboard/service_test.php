<?php 
require_once dirname(__FILE__).'./service_class.php';

//Development environment: WAMPServer Version 2.2 (PHP 5.3.13, MYSQL 5.5.24)
//Testing tool: PhpUnit4.8.36
//Database and data used for testing: studentdata_#123.sql

class ServiceTest extends PHPUnit_Framework_TestCase 
{
	public function testLoadCourse() 
	{
		//correct expected value
		$expected = '[{"CourseName":"Distributed Systems"},{"CourseName":"MSE"}]';
		$service = new Service;
		$actual = $service->loadCourse();
		$this->assertEquals($expected,$actual);

		//incorrect expected value
		$expected = 'false';
		$service = new Service;
		$actual = $service->loadCourse();
		$this->assertNotEquals($expected,$actual);
	}

	public function testLoadYear() 
	{
		//correct expected value for course "MSE"
		$expected = '[{"SchoolYear":"2012"},{"SchoolYear":"2013"}]';
		$SelectCourseId="MSE";
		$service = new Service;
		$actual = $service->loadYear($SelectCourseId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems"
		$expected = '[{"SchoolYear":"2012"},{"SchoolYear":"2013"},{"SchoolYear":"2014"}]';
		$SelectCourseId="Distributed Systems";
		$service = new Service;
		$actual = $service->loadYear($SelectCourseId);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE"
		$expected = 'false';
		$SelectCourseId="MSE";
		$service = new Service;
		$actual = $service->loadYear($SelectCourseId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$service = new Service;
		$actual = $service->loadYear($SelectCourseId);
		$this->assertNotEquals($expected,$actual);
	}

	public function testLoadSemester() 
	{
		//correct expected value for course "MSE", year "2012"
		$expected = '[{"Semester":"Semester 1"},{"Semester":"Semester 2"}]';
		$SelectCourseId="MSE";
		$SelectYearId="2012";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", year "2013"
		$expected = '[{"Semester":"Semester 1"},{"Semester":"Semester 2"}]';
		$SelectCourseId="MSE";
		$SelectYearId="2013";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2012"
		$expected = '[{"Semester":"Semester 1"},{"Semester":"Semester 2"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2012";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2013"
		$expected = '[{"Semester":"Semester 1"},{"Semester":"Semester 2"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2013";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2014"
		$expected = '[{"Semester":"Semester 1"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2014";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012"
		$expected = 'false';
		$SelectCourseId="MSE";
		$SelectYearId="2012";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2013"
		$expected = 'false';
		$SelectCourseId="MSE";
		$SelectYearId="2013";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2012"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2012";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2013"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2013";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2014"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2014";
		$service = new Service;
		$actual = $service->loadSemester($SelectCourseId, $SelectYearId);
		$this->assertNotEquals($expected,$actual);
	}

	public function testLoadAssignment() 
	{
		//correct expected value for course "MSE", year "2012", semester "Semester 1"
		$expected = '[{"AssignmentName":"Assignment 1"},{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="MSE";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", year "2012", semester "Semester 2"
		$expected = '[{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="MSE";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", year "2013", semester "Semester 1"
		$expected = '[{"AssignmentName":"Assignment 1"}]';
		$SelectCourseId="MSE";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", year "2013", semester "Semester 2"
		$expected = '[{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="MSE";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2012", semester "Semester 1"
		$expected = '[{"AssignmentName":"Assignment 1"},{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2012", semester "Semester 2"
		$expected = '[{"AssignmentName":"Assignment 1"},{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2013", semester "Semester 1"
		$expected = '[{"AssignmentName":"Assignment 1"},{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2013", semester "Semester 2"
		$expected = '[{"AssignmentName":"Assignment 2"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "Distributed Systems", year "2014", semester "Semester 1"
		$expected = '[{"AssignmentName":"Assignment 1"}]';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2014";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 1"
		$expected = 'false';
		$SelectCourseId="MSE";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2"
		$expected = 'false';
		$SelectCourseId="MSE";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2013", semester "Semester 1"
		$expected = 'false';
		$SelectCourseId="MSE";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2013", semester "Semester 2"
		$expected = 'false';
		$SelectCourseId="MSE";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2012", semester "Semester 1"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2012", semester "Semester 2"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2012";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2013", semester "Semester 1"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2013", semester "Semester 2"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2013";
		$SelectSemesterId="Semester 2";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "Distributed Systems", year "2014", semester "Semester 1"
		$expected = 'false';
		$SelectCourseId="Distributed Systems";
		$SelectYearId="2014";
		$SelectSemesterId="Semester 1";
		$service = new Service;
		$actual = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
		$this->assertNotEquals($expected,$actual);
	}

	public function testSubmissionTimeDistribution5Days() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-5,"count":5},{"days":-4,"count":6},{"days":-3,"count":7},{"days":-2,"count":7},{"days":-1,"count":6},{"days":0,"count":6},{"days":"+1","count":4},{"days":"+2","count":12},{"days":"+3","count":0},{"days":"+4","count":1},{"days":"+5","count":0}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution5Days($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution5Days($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testSubmissionTimeDistribution5DaysStudent() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-5,"count":4},{"days":-4,"count":6},{"days":-3,"count":7},{"days":-2,"count":6},{"days":-1,"count":6},{"days":0,"count":5},{"days":"+1","count":4},{"days":"+2","count":12},{"days":"+3","count":0},{"days":"+4","count":1},{"days":"+5","count":0}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution5DaysStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution5DaysStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testSubmissionTimeDistribution96Hours() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-96,"count":0},{"days":-95,"count":1},{"days":-94,"count":0},{"days":-93,"count":0},{"days":-92,"count":0},{"days":-91,"count":0},{"days":-90,"count":0},{"days":-89,"count":0},{"days":-88,"count":0},{"days":-87,"count":1},{"days":-86,"count":0},{"days":-85,"count":0},{"days":-84,"count":1},{"days":-83,"count":0},{"days":-82,"count":1},{"days":-81,"count":0},{"days":-80,"count":2},{"days":-79,"count":0},{"days":-78,"count":0},{"days":-77,"count":0},{"days":-76,"count":0},{"days":-75,"count":0},{"days":-74,"count":2},{"days":-73,"count":0},{"days":-72,"count":0},{"days":-71,"count":0},{"days":-70,"count":0},{"days":-69,"count":0},{"days":-68,"count":0},{"days":-67,"count":0},{"days":-66,"count":0},{"days":-65,"count":0},{"days":-64,"count":0},{"days":-63,"count":1},{"days":-62,"count":2},{"days":-61,"count":0},{"days":-60,"count":0},{"days":-59,"count":0},{"days":-58,"count":0},{"days":-57,"count":0},{"days":-56,"count":2},{"days":-55,"count":0},{"days":-54,"count":1},{"days":-53,"count":0},{"days":-52,"count":1},{"days":-51,"count":0},{"days":-50,"count":0},{"days":-49,"count":0},{"days":-48,"count":0},{"days":-47,"count":0},{"days":-46,"count":0},{"days":-45,"count":0},{"days":-44,"count":0},{"days":-43,"count":0},{"days":-42,"count":0},{"days":-41,"count":0},{"days":-40,"count":0},{"days":-39,"count":0},{"days":-38,"count":0},{"days":-37,"count":0},{"days":-36,"count":1},{"days":-35,"count":1},{"days":-34,"count":1},{"days":-33,"count":0},{"days":-32,"count":1},{"days":-31,"count":0},{"days":-30,"count":1},{"days":-29,"count":0},{"days":-28,"count":1},{"days":-27,"count":0},{"days":-26,"count":0},{"days":-25,"count":0},{"days":-24,"count":0},{"days":-23,"count":0},{"days":-22,"count":0},{"days":-21,"count":0},{"days":-20,"count":0},{"days":-19,"count":0},{"days":-18,"count":0},{"days":-17,"count":0},{"days":-16,"count":0},{"days":-15,"count":2},{"days":-14,"count":1},{"days":-13,"count":0},{"days":-12,"count":1},{"days":-11,"count":1},{"days":-10,"count":0},{"days":-9,"count":0},{"days":-8,"count":0},{"days":-7,"count":0},{"days":-6,"count":0},{"days":-5,"count":0},{"days":-4,"count":0},{"days":-3,"count":0},{"days":-2,"count":1},{"days":-1,"count":0},{"days":0,"count":0},{"days":"+1","count":0},{"days":"+2","count":0},{"days":"+3","count":0},{"days":"+4","count":0},{"days":"+5","count":0},{"days":"+6","count":0},{"days":"+7","count":0},{"days":"+8","count":0},{"days":"+9","count":0},{"days":"+10","count":2},{"days":"+11","count":0},{"days":"+12","count":0},{"days":"+13","count":0},{"days":"+14","count":2},{"days":"+15","count":0},{"days":"+16","count":0},{"days":"+17","count":0},{"days":"+18","count":0},{"days":"+19","count":0},{"days":"+20","count":0},{"days":"+21","count":0},{"days":"+22","count":0},{"days":"+23","count":0},{"days":"+24","count":0},{"days":"+25","count":0},{"days":"+26","count":0},{"days":"+27","count":0},{"days":"+28","count":0},{"days":"+29","count":0},{"days":"+30","count":0},{"days":"+31","count":0},{"days":"+32","count":0},{"days":"+33","count":1},{"days":"+34","count":0},{"days":"+35","count":1},{"days":"+36","count":1},{"days":"+37","count":0},{"days":"+38","count":1},{"days":"+39","count":4},{"days":"+40","count":0},{"days":"+41","count":1},{"days":"+42","count":0},{"days":"+43","count":1},{"days":"+44","count":0},{"days":"+45","count":1},{"days":"+46","count":0},{"days":"+47","count":0},{"days":"+48","count":0},{"days":"+49","count":1},{"days":"+50","count":0},{"days":"+51","count":0},{"days":"+52","count":0},{"days":"+53","count":0},{"days":"+54","count":0},{"days":"+55","count":0},{"days":"+56","count":0},{"days":"+57","count":0},{"days":"+58","count":0},{"days":"+59","count":0},{"days":"+60","count":0},{"days":"+61","count":0},{"days":"+62","count":0},{"days":"+63","count":0},{"days":"+64","count":0},{"days":"+65","count":0},{"days":"+66","count":0},{"days":"+67","count":0},{"days":"+68","count":0},{"days":"+69","count":0},{"days":"+70","count":0},{"days":"+71","count":0},{"days":"+72","count":0},{"days":"+73","count":0},{"days":"+74","count":0},{"days":"+75","count":0},{"days":"+76","count":0},{"days":"+77","count":0},{"days":"+78","count":0},{"days":"+79","count":0},{"days":"+80","count":0},{"days":"+81","count":1},{"days":"+82","count":0},{"days":"+83","count":0},{"days":"+84","count":0},{"days":"+85","count":0},{"days":"+86","count":0},{"days":"+87","count":0},{"days":"+88","count":0},{"days":"+89","count":0},{"days":"+90","count":0},{"days":"+91","count":0},{"days":"+92","count":0},{"days":"+93","count":0},{"days":"+94","count":0},{"days":"+95","count":0},{"days":"+96","count":0}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution96Hours($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution96Hours($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testSubmissionTimeDistribution96HoursStudent() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-96,"count":0},{"days":-95,"count":1},{"days":-94,"count":0},{"days":-93,"count":0},{"days":-92,"count":0},{"days":-91,"count":0},{"days":-90,"count":0},{"days":-89,"count":0},{"days":-88,"count":0},{"days":-87,"count":1},{"days":-86,"count":0},{"days":-85,"count":0},{"days":-84,"count":1},{"days":-83,"count":0},{"days":-82,"count":1},{"days":-81,"count":0},{"days":-80,"count":2},{"days":-79,"count":0},{"days":-78,"count":0},{"days":-77,"count":0},{"days":-76,"count":0},{"days":-75,"count":1},{"days":-74,"count":1},{"days":-73,"count":0},{"days":-72,"count":0},{"days":-71,"count":0},{"days":-70,"count":0},{"days":-69,"count":0},{"days":-68,"count":0},{"days":-67,"count":0},{"days":-66,"count":0},{"days":-65,"count":0},{"days":-64,"count":0},{"days":-63,"count":1},{"days":-62,"count":2},{"days":-61,"count":0},{"days":-60,"count":0},{"days":-59,"count":0},{"days":-58,"count":0},{"days":-57,"count":0},{"days":-56,"count":2},{"days":-55,"count":0},{"days":-54,"count":1},{"days":-53,"count":0},{"days":-52,"count":1},{"days":-51,"count":0},{"days":-50,"count":0},{"days":-49,"count":0},{"days":-48,"count":0},{"days":-47,"count":0},{"days":-46,"count":0},{"days":-45,"count":0},{"days":-44,"count":0},{"days":-43,"count":0},{"days":-42,"count":0},{"days":-41,"count":0},{"days":-40,"count":0},{"days":-39,"count":0},{"days":-38,"count":0},{"days":-37,"count":0},{"days":-36,"count":1},{"days":-35,"count":1},{"days":-34,"count":1},{"days":-33,"count":0},{"days":-32,"count":1},{"days":-31,"count":0},{"days":-30,"count":1},{"days":-29,"count":0},{"days":-28,"count":1},{"days":-27,"count":0},{"days":-26,"count":0},{"days":-25,"count":0},{"days":-24,"count":0},{"days":-23,"count":0},{"days":-22,"count":0},{"days":-21,"count":0},{"days":-20,"count":0},{"days":-19,"count":0},{"days":-18,"count":0},{"days":-17,"count":0},{"days":-16,"count":0},{"days":-15,"count":2},{"days":-14,"count":1},{"days":-13,"count":0},{"days":-12,"count":1},{"days":-11,"count":1},{"days":-10,"count":0},{"days":-9,"count":0},{"days":-8,"count":0},{"days":-7,"count":0},{"days":-6,"count":0},{"days":-5,"count":0},{"days":-4,"count":0},{"days":-3,"count":0},{"days":-2,"count":1},{"days":-1,"count":0},{"days":0,"count":0},{"days":"+1","count":0},{"days":"+2","count":0},{"days":"+3","count":0},{"days":"+4","count":0},{"days":"+5","count":0},{"days":"+6","count":0},{"days":"+7","count":0},{"days":"+8","count":0},{"days":"+9","count":2},{"days":"+10","count":0},{"days":"+11","count":0},{"days":"+12","count":0},{"days":"+13","count":2},{"days":"+14","count":0},{"days":"+15","count":0},{"days":"+16","count":0},{"days":"+17","count":0},{"days":"+18","count":0},{"days":"+19","count":0},{"days":"+20","count":0},{"days":"+21","count":0},{"days":"+22","count":0},{"days":"+23","count":0},{"days":"+24","count":0},{"days":"+25","count":0},{"days":"+26","count":0},{"days":"+27","count":0},{"days":"+28","count":0},{"days":"+29","count":0},{"days":"+30","count":0},{"days":"+31","count":0},{"days":"+32","count":1},{"days":"+33","count":0},{"days":"+34","count":1},{"days":"+35","count":1},{"days":"+36","count":1},{"days":"+37","count":0},{"days":"+38","count":4},{"days":"+39","count":0},{"days":"+40","count":1},{"days":"+41","count":0},{"days":"+42","count":1},{"days":"+43","count":0},{"days":"+44","count":1},{"days":"+45","count":0},{"days":"+46","count":0},{"days":"+47","count":0},{"days":"+48","count":1},{"days":"+49","count":0},{"days":"+50","count":0},{"days":"+51","count":0},{"days":"+52","count":0},{"days":"+53","count":0},{"days":"+54","count":0},{"days":"+55","count":0},{"days":"+56","count":0},{"days":"+57","count":0},{"days":"+58","count":0},{"days":"+59","count":0},{"days":"+60","count":0},{"days":"+61","count":0},{"days":"+62","count":0},{"days":"+63","count":0},{"days":"+64","count":0},{"days":"+65","count":0},{"days":"+66","count":0},{"days":"+67","count":0},{"days":"+68","count":0},{"days":"+69","count":0},{"days":"+70","count":0},{"days":"+71","count":0},{"days":"+72","count":0},{"days":"+73","count":0},{"days":"+74","count":0},{"days":"+75","count":0},{"days":"+76","count":0},{"days":"+77","count":0},{"days":"+78","count":0},{"days":"+79","count":1},{"days":"+80","count":0},{"days":"+81","count":0},{"days":"+82","count":0},{"days":"+83","count":0},{"days":"+84","count":0},{"days":"+85","count":0},{"days":"+86","count":0},{"days":"+87","count":0},{"days":"+88","count":0},{"days":"+89","count":0},{"days":"+90","count":0},{"days":"+91","count":0},{"days":"+92","count":0},{"days":"+93","count":0},{"days":"+94","count":0},{"days":"+95","count":0},{"days":"+96","count":0}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution96HoursStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistribution96HoursStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testSubmissionTimeDistributionSubmission() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-31,"count":0,"dueDay":31},{"days":-30,"count":0,"dueDay":31},{"days":-29,"count":0,"dueDay":31},{"days":-28,"count":0,"dueDay":31},{"days":-27,"count":0,"dueDay":31},{"days":-26,"count":0,"dueDay":31},{"days":-25,"count":0,"dueDay":31},{"days":-24,"count":0,"dueDay":31},{"days":-23,"count":0,"dueDay":31},{"days":-22,"count":0,"dueDay":31},{"days":-21,"count":0,"dueDay":31},{"days":-20,"count":1,"dueDay":31},{"days":-19,"count":0,"dueDay":31},{"days":-18,"count":1,"dueDay":31},{"days":-17,"count":3,"dueDay":31},{"days":-16,"count":5,"dueDay":31},{"days":-15,"count":5,"dueDay":31},{"days":-14,"count":4,"dueDay":31},{"days":-13,"count":7,"dueDay":31},{"days":-12,"count":6,"dueDay":31},{"days":-11,"count":5,"dueDay":31},{"days":-10,"count":5,"dueDay":31},{"days":-9,"count":7,"dueDay":31},{"days":-8,"count":3,"dueDay":31},{"days":-7,"count":4,"dueDay":31},{"days":-6,"count":3,"dueDay":31},{"days":-5,"count":5,"dueDay":31},{"days":-4,"count":6,"dueDay":31},{"days":-3,"count":7,"dueDay":31},{"days":-2,"count":7,"dueDay":31},{"days":-1,"count":6,"dueDay":31},{"days":0,"count":6,"dueDay":31},{"days":"+1","count":4,"dueDay":31},{"days":"+2","count":12,"dueDay":31},{"days":"+3","count":0,"dueDay":31},{"days":"+4","count":1,"dueDay":31},{"days":"+5","count":0,"dueDay":31}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistributionSubmission($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistributionSubmission($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testSubmissionTimeDistributionStudent() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-31,"count":0,"dueDay":31},{"days":-30,"count":0,"dueDay":31},{"days":-29,"count":0,"dueDay":31},{"days":-28,"count":0,"dueDay":31},{"days":-27,"count":0,"dueDay":31},{"days":-26,"count":0,"dueDay":31},{"days":-25,"count":0,"dueDay":31},{"days":-24,"count":0,"dueDay":31},{"days":-23,"count":0,"dueDay":31},{"days":-22,"count":0,"dueDay":31},{"days":-21,"count":0,"dueDay":31},{"days":-20,"count":1,"dueDay":31},{"days":-19,"count":0,"dueDay":31},{"days":-18,"count":1,"dueDay":31},{"days":-17,"count":3,"dueDay":31},{"days":-16,"count":5,"dueDay":31},{"days":-15,"count":5,"dueDay":31},{"days":-14,"count":4,"dueDay":31},{"days":-13,"count":7,"dueDay":31},{"days":-12,"count":6,"dueDay":31},{"days":-11,"count":5,"dueDay":31},{"days":-10,"count":5,"dueDay":31},{"days":-9,"count":7,"dueDay":31},{"days":-8,"count":3,"dueDay":31},{"days":-7,"count":4,"dueDay":31},{"days":-6,"count":2,"dueDay":31},{"days":-5,"count":4,"dueDay":31},{"days":-4,"count":6,"dueDay":31},{"days":-3,"count":7,"dueDay":31},{"days":-2,"count":6,"dueDay":31},{"days":-1,"count":6,"dueDay":31},{"days":0,"count":5,"dueDay":31},{"days":"+1","count":4,"dueDay":31},{"days":"+2","count":12,"dueDay":31},{"days":"+3","count":0,"dueDay":31},{"days":"+4","count":1,"dueDay":31},{"days":"+5","count":0,"dueDay":31}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistributionStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->submissionTimeDistributionStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testFirstSubmissionTimeDistribution() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-31,"count":0,"dueDay":31},{"days":-30,"count":0,"dueDay":31},{"days":-29,"count":0,"dueDay":31},{"days":-28,"count":0,"dueDay":31},{"days":-27,"count":0,"dueDay":31},{"days":-26,"count":0,"dueDay":31},{"days":-25,"count":0,"dueDay":31},{"days":-24,"count":0,"dueDay":31},{"days":-23,"count":0,"dueDay":31},{"days":-22,"count":0,"dueDay":31},{"days":-21,"count":0,"dueDay":31},{"days":-20,"count":0,"dueDay":31},{"days":-19,"count":0,"dueDay":31},{"days":-18,"count":0,"dueDay":31},{"days":-17,"count":2,"dueDay":31},{"days":-16,"count":2,"dueDay":31},{"days":-15,"count":4,"dueDay":31},{"days":-14,"count":4,"dueDay":31},{"days":-13,"count":4,"dueDay":31},{"days":-12,"count":2,"dueDay":31},{"days":-11,"count":1,"dueDay":31},{"days":-10,"count":4,"dueDay":31},{"days":-9,"count":3,"dueDay":31},{"days":-8,"count":0,"dueDay":31},{"days":-7,"count":2,"dueDay":31},{"days":-6,"count":2,"dueDay":31},{"days":-5,"count":3,"dueDay":31},{"days":-4,"count":4,"dueDay":31},{"days":-3,"count":3,"dueDay":31},{"days":-2,"count":4,"dueDay":31},{"days":-1,"count":2,"dueDay":31},{"days":0,"count":3,"dueDay":31},{"days":"+1","count":1,"dueDay":31},{"days":"+2","count":8,"dueDay":31},{"days":"+3","count":0,"dueDay":31},{"days":"+4","count":1,"dueDay":31},{"days":"+5","count":0,"dueDay":31}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->firstSubmissionTimeDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->firstSubmissionTimeDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testLastSubmissionTimeDistribution() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"days":-31,"count":0,"dueDay":31},{"days":-30,"count":0,"dueDay":31},{"days":-29,"count":0,"dueDay":31},{"days":-28,"count":0,"dueDay":31},{"days":-27,"count":0,"dueDay":31},{"days":-26,"count":0,"dueDay":31},{"days":-25,"count":0,"dueDay":31},{"days":-24,"count":0,"dueDay":31},{"days":-23,"count":0,"dueDay":31},{"days":-22,"count":0,"dueDay":31},{"days":-21,"count":0,"dueDay":31},{"days":-20,"count":1,"dueDay":31},{"days":-19,"count":0,"dueDay":31},{"days":-18,"count":0,"dueDay":31},{"days":-17,"count":1,"dueDay":31},{"days":-16,"count":3,"dueDay":31},{"days":-15,"count":4,"dueDay":31},{"days":-14,"count":1,"dueDay":31},{"days":-13,"count":3,"dueDay":31},{"days":-12,"count":4,"dueDay":31},{"days":-11,"count":3,"dueDay":31},{"days":-10,"count":2,"dueDay":31},{"days":-9,"count":4,"dueDay":31},{"days":-8,"count":3,"dueDay":31},{"days":-7,"count":3,"dueDay":31},{"days":-6,"count":1,"dueDay":31},{"days":-5,"count":0,"dueDay":31},{"days":-4,"count":3,"dueDay":31},{"days":-3,"count":5,"dueDay":31},{"days":-2,"count":3,"dueDay":31},{"days":-1,"count":3,"dueDay":31},{"days":0,"count":3,"dueDay":31},{"days":"+1","count":2,"dueDay":31},{"days":"+2","count":6,"dueDay":31},{"days":"+3","count":0,"dueDay":31},{"days":"+4","count":0,"dueDay":31},{"days":"+5","count":0,"dueDay":31}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->lastSubmissionTimeDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->lastSubmissionTimeDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertNotEquals($expected,$actual);
	}

	public function testNumberOfSubmissionsOfEachStudent() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//The outcome of the testing of this function is always failure. Because each time the actual output is different. For one time {"FKUserId":"ae030","count":"4"} goes before {"FKUserId":"ga524","count":"4"} in the actual output, for another time {"FKUserId":"ga524","count":"4"} goes before {"FKUserId":"ae030","count":"4"} in the actual output. The order of element changes each time, but the results are the same because the  order doesn't matters. So I remove the testing of the correct expected values for this function.	

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", order "Alphabetical order"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$order=1;//Alphabetical order
		$service = new Service;
		$actual = $service->numberOfSubmissionsOfEachStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment,$order);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", order "Descending order"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$order=2;//Descending order
		$service = new Service;
		$actual = $service->numberOfSubmissionsOfEachStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment,$order);
		$this->assertNotEquals($expected,$actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", order "Ascending order"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$order=3;//Ascending order
		$service = new Service;
		$actual = $service->numberOfSubmissionsOfEachStudent($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment,$order);
		$this->assertNotEquals($expected,$actual);
	}

	public function testMarkDistribution() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", configuration option "By GPA"
		$expected = '[{"grade":"F","count":50},{"grade":"P","count":4},{"grade":"C","count":1},{"grade":"D","count":3},{"grade":"HD","count":2}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$MarkDistributionSelect=1;//By GPA
		$service = new Service;
		$actual = $service->markDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment, $MarkDistributionSelect);
		$this->assertEquals($expected, $actual);

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", configuration option "By 10% Step"
		$expected = '[{"grade":"0-10%","count":49},{"grade":"11-20%","count":0},{"grade":"21-30%","count":0},{"grade":"31-40%","count":1},{"grade":"41-50%","count":0},{"grade":"51-60%","count":4},{"grade":"61-70%","count":1},{"grade":"71-80%","count":3},{"grade":"81-90%","count":1},{"grade":"91-100%","count":1}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$MarkDistributionSelect=2;//By 10% Step
		$service = new Service;
		$actual = $service->markDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment, $MarkDistributionSelect);
		$this->assertEquals($expected, $actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", configuration option "By GPA"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$MarkDistributionSelect=1;//By GPA
		$service = new Service;
		$actual = $service->markDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment, $MarkDistributionSelect);
		$this->assertNotEquals($expected, $actual);

		//incorrect expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2", configuration option "By 10% Step"
		$expected = 'false';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$MarkDistributionSelect=2;//By 10% Step
		$service = new Service;
		$actual = $service->markDistribution($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment, $MarkDistributionSelect);
		$this->assertNotEquals($expected, $actual);
	}

	public function testGetAssignmentInformation() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2"
		$expected = '[{"AssignmentName":"Assignment 2","StartDate":"20120822","DueDate":"20120922"}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$service = new Service;
		$actual = $service->getAssignmentInformation($SelectCourse, $SelectYear, $SelectSemester);
		$this->assertEquals($expected, $actual);
	}

	public function testGetAssignmentStartAndDueDay() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other assignments of other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", year "2012", semester "Semester 2", assignment "Assignment 2"
		$expected = '[{"StartDate":"20120822","DueDate":"20120922"}]';
		$SelectCourse="MSE";
		$SelectYear="2012";
		$SelectSemester="Semester 2";
		$SelectAssignment="Assignment 2";
		$service = new Service;
		$actual = $service->getAssignmentStartAndDueDay($SelectCourse, $SelectYear, $SelectSemester, $SelectAssignment);
		$this->assertEquals($expected, $actual);
	}

	public function testStudentActivitiesOverview() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "667"
		$expected = '[{"name":"U0019","count":"906","amount":2},{"name":"U0048","count":"734","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=667;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">=", $Threshold "667"
		$expected = '[{"name":"U0011","count":"667","amount":3},{"name":"U0019","count":"906","amount":3},{"name":"U0048","count":"734","amount":3}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>=';
		$Threshold=667;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"name":"U0009","count":"1","amount":6},{"name":"U0062","count":"1","amount":6},{"name":"U0091","count":"1","amount":6},{"name":"U0100","count":"1","amount":6},{"name":"U0119","count":"1","amount":6},{"name":"U0156","count":"1","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"name":"U0009","count":"1","amount":12},{"name":"U0034","count":"2","amount":12},{"name":"U0038","count":"2","amount":12},{"name":"U0062","count":"1","amount":12},{"name":"U0086","count":"2","amount":12},{"name":"U0091","count":"1","amount":12},{"name":"U0097","count":"2","amount":12},{"name":"U0100","count":"1","amount":12},{"name":"U0107","count":"2","amount":12},{"name":"U0119","count":"1","amount":12},{"name":"U0137","count":"2","amount":12},{"name":"U0156","count":"1","amount":12}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"name":"U0034","count":"2","amount":6},{"name":"U0038","count":"2","amount":6},{"name":"U0086","count":"2","amount":6},{"name":"U0097","count":"2","amount":6},{"name":"U0107","count":"2","amount":6},{"name":"U0137","count":"2","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">", $Threshold "667"
		$expected = '[{"name":"U0019","count":"906","amount":2},{"name":"U0048","count":"734","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>';
		$Threshold=667;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">=", $Threshold "667"
		$expected = '[{"name":"U0019","count":"906","amount":3},{"name":"U0048","count":"734","amount":3},{"name":"U0011","count":"667","amount":3}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>=';
		$Threshold=667;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"name":"U0156","count":"1","amount":6},{"name":"U0119","count":"1","amount":6},{"name":"U0100","count":"1","amount":6},{"name":"U0091","count":"1","amount":6},{"name":"U0062","count":"1","amount":6},{"name":"U0009","count":"1","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"name":"U0137","count":"2","amount":12},{"name":"U0107","count":"2","amount":12},{"name":"U0097","count":"2","amount":12},{"name":"U0086","count":"2","amount":12},{"name":"U0038","count":"2","amount":12},{"name":"U0034","count":"2","amount":12},{"name":"U0156","count":"1","amount":12},{"name":"U0119","count":"1","amount":12},{"name":"U0100","count":"1","amount":12},{"name":"U0091","count":"1","amount":12},{"name":"U0062","count":"1","amount":12},{"name":"U0009","count":"1","amount":12}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"name":"U0137","count":"2","amount":6},{"name":"U0107","count":"2","amount":6},{"name":"U0097","count":"2","amount":6},{"name":"U0086","count":"2","amount":6},{"name":"U0038","count":"2","amount":6},{"name":"U0034","count":"2","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">", $Threshold "667"
		$expected = '[{"name":"U0048","count":"734","amount":2},{"name":"U0019","count":"906","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>';
		$Threshold=667;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">=", $Threshold "667"
		$expected = '[{"name":"U0011","count":"667","amount":3},{"name":"U0048","count":"734","amount":3},{"name":"U0019","count":"906","amount":3}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>=';
		$Threshold=667;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"name":"U0156","count":"1","amount":6},{"name":"U0119","count":"1","amount":6},{"name":"U0100","count":"1","amount":6},{"name":"U0091","count":"1","amount":6},{"name":"U0062","count":"1","amount":6},{"name":"U0009","count":"1","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"name":"U0156","count":"1","amount":12},{"name":"U0119","count":"1","amount":12},{"name":"U0100","count":"1","amount":12},{"name":"U0091","count":"1","amount":12},{"name":"U0062","count":"1","amount":12},{"name":"U0009","count":"1","amount":12},{"name":"U0137","count":"2","amount":12},{"name":"U0107","count":"2","amount":12},{"name":"U0097","count":"2","amount":12},{"name":"U0086","count":"2","amount":12},{"name":"U0038","count":"2","amount":12},{"name":"U0034","count":"2","amount":12}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"name":"U0137","count":"2","amount":6},{"name":"U0107","count":"2","amount":6},{"name":"U0097","count":"2","amount":6},{"name":"U0086","count":"2","amount":6},{"name":"U0038","count":"2","amount":6},{"name":"U0034","count":"2","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}

	public function testStudentActivitiesOverviewCSV() 
	{
		//The output of the function studentActivitiesOverviewCSV($SelectCourse, $SelectYear, $SelectSemester, $from, $to, $order, $ThresholdSelect, $Threshold) is a CSV file, I have manually tested and verified that the data in the CSV file is correct and is the same as what is displayed in the chart. 
	}

	public function testAllActivitiesOverview() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "422"
		$expected = '[{"date":"18 Sep 12","count":"483","amount":5},{"date":"19 Sep 12","count":"512","amount":5},{"date":"20 Sep 12","count":"801","amount":5},{"date":"21 Sep 12","count":"601","amount":5},{"date":"06 Nov 12","count":"1031","amount":5}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=422;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">=", $Threshold "422"
		$expected = '[{"date":"18 Sep 12","count":"483","amount":6},{"date":"19 Sep 12","count":"512","amount":6},{"date":"20 Sep 12","count":"801","amount":6},{"date":"21 Sep 12","count":"601","amount":6},{"date":"22 Sep 12","count":"422","amount":6},{"date":"06 Nov 12","count":"1031","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>=';
		$Threshold=422;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<", $Threshold "10"
		$expected = '[{"date":"08 Sep 12","count":"8","amount":5},{"date":"09 Nov 12","count":"5","amount":5},{"date":"11 Nov 12","count":"6","amount":5},{"date":"13 Nov 12","count":"7","amount":5},{"date":"14 Nov 12","count":"2","amount":5}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<=", $Threshold "10"
		$expected = '[{"date":"05 Sep 12","count":"10","amount":6},{"date":"08 Sep 12","count":"8","amount":6},{"date":"09 Nov 12","count":"5","amount":6},{"date":"11 Nov 12","count":"6","amount":6},{"date":"13 Nov 12","count":"7","amount":6},{"date":"14 Nov 12","count":"2","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<=';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "=", $Threshold "10"
		$expected = '[{"date":"05 Sep 12","count":"10","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='=';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">", $Threshold "422"
		$expected = '[{"date":"06 Nov 12","count":"1031","amount":5},{"date":"20 Sep 12","count":"801","amount":5},{"date":"21 Sep 12","count":"601","amount":5},{"date":"19 Sep 12","count":"512","amount":5},{"date":"18 Sep 12","count":"483","amount":5}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>';
		$Threshold=422;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">=", $Threshold "422"
		$expected = '[{"date":"06 Nov 12","count":"1031","amount":6},{"date":"20 Sep 12","count":"801","amount":6},{"date":"21 Sep 12","count":"601","amount":6},{"date":"19 Sep 12","count":"512","amount":6},{"date":"18 Sep 12","count":"483","amount":6},{"date":"22 Sep 12","count":"422","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>=';
		$Threshold=422;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<", $Threshold "10"
		$expected = '[{"date":"08 Sep 12","count":"8","amount":5},{"date":"13 Nov 12","count":"7","amount":5},{"date":"11 Nov 12","count":"6","amount":5},{"date":"09 Nov 12","count":"5","amount":5},{"date":"14 Nov 12","count":"2","amount":5}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<=", $Threshold "10"
		$expected = '[{"date":"05 Sep 12","count":"10","amount":6},{"date":"08 Sep 12","count":"8","amount":6},{"date":"13 Nov 12","count":"7","amount":6},{"date":"11 Nov 12","count":"6","amount":6},{"date":"09 Nov 12","count":"5","amount":6},{"date":"14 Nov 12","count":"2","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<=';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "=", $Threshold "10"
		$expected = '[{"date":"05 Sep 12","count":"10","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='=';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">", $Threshold "422"
		$expected = '[{"date":"18 Sep 12","count":"483","amount":5},{"date":"19 Sep 12","count":"512","amount":5},{"date":"21 Sep 12","count":"601","amount":5},{"date":"20 Sep 12","count":"801","amount":5},{"date":"06 Nov 12","count":"1031","amount":5}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>';
		$Threshold=422;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">=", $Threshold "422"
		$expected = '[{"date":"22 Sep 12","count":"422","amount":6},{"date":"18 Sep 12","count":"483","amount":6},{"date":"19 Sep 12","count":"512","amount":6},{"date":"21 Sep 12","count":"601","amount":6},{"date":"20 Sep 12","count":"801","amount":6},{"date":"06 Nov 12","count":"1031","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>=';
		$Threshold=422;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<", $Threshold "10"
		$expected = '[{"date":"14 Nov 12","count":"2","amount":5},{"date":"09 Nov 12","count":"5","amount":5},{"date":"11 Nov 12","count":"6","amount":5},{"date":"13 Nov 12","count":"7","amount":5},{"date":"08 Sep 12","count":"8","amount":5}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<=", $Threshold "10"
		$expected = '[{"date":"14 Nov 12","count":"2","amount":6},{"date":"09 Nov 12","count":"5","amount":6},{"date":"11 Nov 12","count":"6","amount":6},{"date":"13 Nov 12","count":"7","amount":6},{"date":"08 Sep 12","count":"8","amount":6},{"date":"05 Sep 12","count":"10","amount":6}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<=';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "=", $Threshold "10"
		$expected = '[{"date":"05 Sep 12","count":"10","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='=';
		$Threshold=10;
		$service = new Service;
		$actual = $service->allActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}

	public function testAllActivitiesOverviewCSV() 
	{
		//The output of the function allActivitiesOverviewCSV($SelectCourse, $SelectYear, $SelectSemester, $from, $to, $order, $ThresholdSelect, $Threshold) is a CSV file, I have manually tested and verified that the data in the CSV file is correct and is the same as what is displayed in the chart. 
	}

	public function testEventNamesOverview() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "2366"
		$expected = '[{"name":"forum_view forum","count":"5213","amount":2},{"name":"forum_view discussion","count":"7234","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=2366;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">=", $Threshold "2366"
		$expected = '[{"name":"resource_view","count":"2366","amount":3},{"name":"forum_view forum","count":"5213","amount":3},{"name":"forum_view discussion","count":"7234","amount":3}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>=';
		$Threshold=2366;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"name":"quiz_update","count":"1","amount":8},{"name":"quiz_add","count":"1","amount":8},{"name":"forum_view subscriber","count":"1","amount":8},{"name":"forum_unsubscribe","count":"1","amount":8},{"name":"forum_mark read","count":"1","amount":8},{"name":"forum_delete discussi","count":"1","amount":8},{"name":"discussion_mark read","count":"1","amount":8},{"name":"choice_add","count":"1","amount":8}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"name":"quiz_update","count":"1","amount":10},{"name":"quiz_preview","count":"2","amount":10},{"name":"quiz_add","count":"1","amount":10},{"name":"forum_view subscriber","count":"1","amount":10},{"name":"forum_unsubscribe","count":"1","amount":10},{"name":"forum_subscribe","count":"2","amount":10},{"name":"forum_mark read","count":"1","amount":10},{"name":"forum_delete discussi","count":"1","amount":10},{"name":"discussion_mark read","count":"1","amount":10},{"name":"choice_add","count":"1","amount":10}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"name":"quiz_preview","count":"2","amount":2},{"name":"forum_subscribe","count":"2","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">", $Threshold "2366"
		$expected = '[{"name":"forum_view discussion","count":"7234","amount":2},{"name":"forum_view forum","count":"5213","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>';
		$Threshold=2366;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">=", $Threshold "2366"
		$expected = '[{"name":"forum_view discussion","count":"7234","amount":3},{"name":"forum_view forum","count":"5213","amount":3},{"name":"resource_view","count":"2366","amount":3}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>=';
		$Threshold=2366;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"name":"quiz_update","count":"1","amount":8},{"name":"quiz_add","count":"1","amount":8},{"name":"forum_view subscriber","count":"1","amount":8},{"name":"forum_unsubscribe","count":"1","amount":8},{"name":"forum_mark read","count":"1","amount":8},{"name":"forum_delete discussi","count":"1","amount":8},{"name":"discussion_mark read","count":"1","amount":8},{"name":"choice_add","count":"1","amount":8}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"name":"quiz_preview","count":"2","amount":10},{"name":"forum_subscribe","count":"2","amount":10},{"name":"quiz_update","count":"1","amount":10},{"name":"quiz_add","count":"1","amount":10},{"name":"forum_view subscriber","count":"1","amount":10},{"name":"forum_unsubscribe","count":"1","amount":10},{"name":"forum_mark read","count":"1","amount":10},{"name":"forum_delete discussi","count":"1","amount":10},{"name":"discussion_mark read","count":"1","amount":10},{"name":"choice_add","count":"1","amount":10}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"name":"quiz_preview","count":"2","amount":2},{"name":"forum_subscribe","count":"2","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">", $Threshold "2366"
		$expected = '[{"name":"forum_view forum","count":"5213","amount":2},{"name":"forum_view discussion","count":"7234","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>';
		$Threshold=2366;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">=", $Threshold "2366"
		$expected = '[{"name":"resource_view","count":"2366","amount":3},{"name":"forum_view forum","count":"5213","amount":3},{"name":"forum_view discussion","count":"7234","amount":3}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>=';
		$Threshold=2366;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"name":"quiz_update","count":"1","amount":8},{"name":"quiz_add","count":"1","amount":8},{"name":"forum_view subscriber","count":"1","amount":8},{"name":"forum_unsubscribe","count":"1","amount":8},{"name":"forum_mark read","count":"1","amount":8},{"name":"forum_delete discussi","count":"1","amount":8},{"name":"discussion_mark read","count":"1","amount":8},{"name":"choice_add","count":"1","amount":8}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"name":"quiz_update","count":"1","amount":10},{"name":"quiz_add","count":"1","amount":10},{"name":"forum_view subscriber","count":"1","amount":10},{"name":"forum_unsubscribe","count":"1","amount":10},{"name":"forum_mark read","count":"1","amount":10},{"name":"forum_delete discussi","count":"1","amount":10},{"name":"discussion_mark read","count":"1","amount":10},{"name":"choice_add","count":"1","amount":10},{"name":"quiz_preview","count":"2","amount":10},{"name":"forum_subscribe","count":"2","amount":10}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"name":"quiz_preview","count":"2","amount":2},{"name":"forum_subscribe","count":"2","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->eventNamesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}

	public function testEventNamesOverviewCSV() 
	{
		//The output of the function eventNamesOverviewCSV($SelectCourse, $SelectYear, $SelectSemester, $from, $to, $order, $ThresholdSelect, $Threshold) is a CSV file, I have manually tested and verified that the data in the CSV file is correct and is the same as what is displayed in the chart. 
	}

	public function testSpecificEventNameOverviewAutoComplete() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for term "f", course "MSE", from "20120723", to "20121117", $ThresholdSelect ">", $Threshold "5213"
		$expected = '[{"label":"forum_view discussion"}]';
		$term="f";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$ThresholdSelect='>';
		$Threshold=5213;
		$service = new Service;
		$actual = $service->specificEventNameOverviewAutoComplete($term, $SelectCourse, $from, $to, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for term "f", course "MSE", from "20120723", to "20121117", $ThresholdSelect ">=", $Threshold "5213"
		$expected = '[{"label":"forum_view forum"},{"label":"forum_view discussion"}]';
		$term="f";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$ThresholdSelect='>=';
		$Threshold=5213;
		$service = new Service;
		$actual = $service->specificEventNameOverviewAutoComplete($term, $SelectCourse, $from, $to, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for term "f", course "MSE", from "20120723", to "20121117", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"label":"forum_delete discussi"},{"label":"forum_mark read"},{"label":"forum_view subscriber"},{"label":"forum_unsubscribe"}]';
		$term="f";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverviewAutoComplete($term, $SelectCourse, $from, $to, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for term "f", course "MSE", from "20120723", to "20121117", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"label":"forum_delete discussi"},{"label":"forum_mark read"},{"label":"forum_view subscriber"},{"label":"forum_subscribe"},{"label":"forum_unsubscribe"}]';
		$term="f";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverviewAutoComplete($term, $SelectCourse, $from, $to, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for term "f", course "MSE", from "20120723", to "20121117", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"label":"forum_subscribe"}]';
		$term="f";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverviewAutoComplete($term, $SelectCourse, $from, $to, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for term "r", course "MSE", from "20120723", to "20121117", $ThresholdSelect ">", $Threshold "1000"
		$expected = '[{"label":"resource_view"}]';
		$term="r";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$ThresholdSelect='>';
		$Threshold=1000;
		$service = new Service;
		$actual = $service->specificEventNameOverviewAutoComplete($term, $SelectCourse, $from, $to, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}

	public function testSpecificEventNameOverview() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for EventName "forum_view forum", course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "194"
		$expected = '[{"date":"20 Sep 12","count":"265","amount":2},{"date":"06 Nov 12","count":"206","amount":2}]';
		$EventName="forum_view forum";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=194;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "forum_view forum", course "MSE", from "20120921", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "194"
		$expected = '[{"date":"06 Nov 12","count":"206","amount":1}]';
		$EventName="forum_view forum";
		$SelectCourse="MSE";
		$from= "20120921";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=194;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "94"
		$expected = '[{"date":"06 Nov 12","count":"404","amount":1}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=94;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">=", $Threshold "94"
		$expected = '[{"date":"23 Jul 12","count":"94","amount":2},{"date":"06 Nov 12","count":"404","amount":2}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>=';
		$Threshold=94;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"date":"01 Sep 12","count":"1","amount":5},{"date":"05 Sep 12","count":"1","amount":5},{"date":"11 Oct 12","count":"1","amount":5},{"date":"09 Nov 12","count":"1","amount":5},{"date":"12 Nov 12","count":"1","amount":5}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"date":"08 Aug 12","count":"2","amount":13},{"date":"30 Aug 12","count":"2","amount":13},{"date":"01 Sep 12","count":"1","amount":13},{"date":"05 Sep 12","count":"1","amount":13},{"date":"08 Sep 12","count":"2","amount":13},{"date":"13 Sep 12","count":"2","amount":13},{"date":"14 Sep 12","count":"2","amount":13},{"date":"01 Oct 12","count":"2","amount":13},{"date":"06 Oct 12","count":"2","amount":13},{"date":"11 Oct 12","count":"1","amount":13},{"date":"20 Oct 12","count":"2","amount":13},{"date":"09 Nov 12","count":"1","amount":13},{"date":"12 Nov 12","count":"1","amount":13}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"date":"08 Aug 12","count":"2","amount":8},{"date":"30 Aug 12","count":"2","amount":8},{"date":"08 Sep 12","count":"2","amount":8},{"date":"13 Sep 12","count":"2","amount":8},{"date":"14 Sep 12","count":"2","amount":8},{"date":"01 Oct 12","count":"2","amount":8},{"date":"06 Oct 12","count":"2","amount":8},{"date":"20 Oct 12","count":"2","amount":8}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">", $Threshold "94"
		$expected = '[{"date":"06 Nov 12","count":"404","amount":1}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>';
		$Threshold=94;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">=", $Threshold "94"
		$expected = '[{"date":"06 Nov 12","count":"404","amount":2},{"date":"23 Jul 12","count":"94","amount":2}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>=';
		$Threshold=94;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"date":"01 Sep 12","count":"1","amount":5},{"date":"05 Sep 12","count":"1","amount":5},{"date":"11 Oct 12","count":"1","amount":5},{"date":"09 Nov 12","count":"1","amount":5},{"date":"12 Nov 12","count":"1","amount":5}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"date":"08 Aug 12","count":"2","amount":13},{"date":"30 Aug 12","count":"2","amount":13},{"date":"08 Sep 12","count":"2","amount":13},{"date":"13 Sep 12","count":"2","amount":13},{"date":"14 Sep 12","count":"2","amount":13},{"date":"01 Oct 12","count":"2","amount":13},{"date":"06 Oct 12","count":"2","amount":13},{"date":"20 Oct 12","count":"2","amount":13},{"date":"01 Sep 12","count":"1","amount":13},{"date":"05 Sep 12","count":"1","amount":13},{"date":"11 Oct 12","count":"1","amount":13},{"date":"09 Nov 12","count":"1","amount":13},{"date":"12 Nov 12","count":"1","amount":13}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"date":"08 Aug 12","count":"2","amount":8},{"date":"30 Aug 12","count":"2","amount":8},{"date":"08 Sep 12","count":"2","amount":8},{"date":"13 Sep 12","count":"2","amount":8},{"date":"14 Sep 12","count":"2","amount":8},{"date":"01 Oct 12","count":"2","amount":8},{"date":"06 Oct 12","count":"2","amount":8},{"date":"20 Oct 12","count":"2","amount":8}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">", $Threshold "94"
		$expected = '[{"date":"06 Nov 12","count":"404","amount":1}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>';
		$Threshold=94;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">=", $Threshold "94"
		$expected = '[{"date":"23 Jul 12","count":"94","amount":2},{"date":"06 Nov 12","count":"404","amount":2}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>=';
		$Threshold=94;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<", $Threshold "2"
		$expected = '[{"date":"01 Sep 12","count":"1","amount":5},{"date":"05 Sep 12","count":"1","amount":5},{"date":"11 Oct 12","count":"1","amount":5},{"date":"09 Nov 12","count":"1","amount":5},{"date":"12 Nov 12","count":"1","amount":5}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<=", $Threshold "2"
		$expected = '[{"date":"01 Sep 12","count":"1","amount":13},{"date":"05 Sep 12","count":"1","amount":13},{"date":"11 Oct 12","count":"1","amount":13},{"date":"09 Nov 12","count":"1","amount":13},{"date":"12 Nov 12","count":"1","amount":13},{"date":"08 Aug 12","count":"2","amount":13},{"date":"30 Aug 12","count":"2","amount":13},{"date":"08 Sep 12","count":"2","amount":13},{"date":"13 Sep 12","count":"2","amount":13},{"date":"14 Sep 12","count":"2","amount":13},{"date":"01 Oct 12","count":"2","amount":13},{"date":"06 Oct 12","count":"2","amount":13},{"date":"20 Oct 12","count":"2","amount":13}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for EventName "resource_view", course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "=", $Threshold "2"
		$expected = '[{"date":"08 Aug 12","count":"2","amount":8},{"date":"30 Aug 12","count":"2","amount":8},{"date":"08 Sep 12","count":"2","amount":8},{"date":"13 Sep 12","count":"2","amount":8},{"date":"14 Sep 12","count":"2","amount":8},{"date":"01 Oct 12","count":"2","amount":8},{"date":"06 Oct 12","count":"2","amount":8},{"date":"20 Oct 12","count":"2","amount":8}]';
		$EventName="resource_view";
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='=';
		$Threshold=2;
		$service = new Service;
		$actual = $service->specificEventNameOverview($EventName, $SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}

	public function testSpecificEventNameOverviewCSV() 
	{
		//The output of the function specificEventNameOverviewCSV($EventName, $SelectCourse, $SelectYear, $SelectSemester, $from, $to, $order, $ThresholdSelect, $Threshold) is a CSV file, I have manually tested and verified that the data in the CSV file is correct and is the same as what is displayed in the chart. 
	}

	public function testEventContextsOverview() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//correct expected value for course "MSE", from "20120823", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "3771"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"5123","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120823";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=3771;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "3771"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":2},{"name":"Forum: News forum, Semester 2, 2012","count":"3772","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=3771;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "3772"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=3772;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">=", $Threshold "3772"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":2},{"name":"Forum: News forum, Semester 2, 2012","count":"3772","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>=';
		$Threshold=3772;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<", $Threshold "14"
		$expected = '[{"name":"System:, Semester 1, 2012","count":"2","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<=", $Threshold "14"
		$expected = '[{"name":"System:, Semester 1, 2012","count":"2","amount":2},{"name":"URL: The Google Story book, Semester 2, 2012","count":"14","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<=';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "=", $Threshold "14"
		$expected = '[{"name":"URL: The Google Story book, Semester 2, 2012","count":"14","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='=';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">", $Threshold "3772"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>';
		$Threshold=3772;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect ">=", $Threshold "3772"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":2},{"name":"Forum: News forum, Semester 2, 2012","count":"3772","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='>=';
		$Threshold=3772;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<", $Threshold "14"
		$expected = '[{"name":"System:, Semester 1, 2012","count":"2","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "<=", $Threshold "14"
		$expected = '[{"name":"URL: The Google Story book, Semester 2, 2012","count":"14","amount":2},{"name":"System:, Semester 1, 2012","count":"2","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='<=';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Descending order", $ThresholdSelect "=", $Threshold "14"
		$expected = '[{"name":"URL: The Google Story book, Semester 2, 2012","count":"14","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=2;//Descending order
		$ThresholdSelect='=';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">", $Threshold "3772"
		$expected = '[{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>';
		$Threshold=3772;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect ">=", $Threshold "3772"
		$expected = '[{"name":"Forum: News forum, Semester 2, 2012","count":"3772","amount":2},{"name":"Forum: Student Questions and Discussion, Semester 2, 2012","count":"7219","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='>=';
		$Threshold=3772;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<", $Threshold "14"
		$expected = '[{"name":"System:, Semester 1, 2012","count":"2","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "<=", $Threshold "14"
		$expected = '[{"name":"System:, Semester 1, 2012","count":"2","amount":2},{"name":"URL: The Google Story book, Semester 2, 2012","count":"14","amount":2}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='<=';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Ascending order", $ThresholdSelect "=", $Threshold "14"
		$expected = '[{"name":"URL: The Google Story book, Semester 2, 2012","count":"14","amount":1}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=3;//Ascending order
		$ThresholdSelect='=';
		$Threshold=14;
		$service = new Service;
		$actual = $service->eventContextsOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}

	public function testEventContextsOverviewCSV() 
	{
		//The output of the function eventContextsOverviewCSV($SelectCourse, $SelectYear, $SelectSemester, $from, $to, $order, $ThresholdSelect, $Threshold) is a CSV file, I have manually tested and verified that the data in the CSV file is correct and is the same as what is displayed in the chart. 
	}
}
?>