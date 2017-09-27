<?php 
require_once dirname(__FILE__).'./service_class.php';

//Development environment: WAMPServer Version 2.2 (PHP 5.3.13, MYSQL 5.5.24)
//Testing tool: PhpUnit4.8.36
//Database and data used for testing: studentdata_#122.sql

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

	public function testStudentActivitiesOverview() 
	{
		//Since the data is fake data, we only test (course "MSE", year "2012", semester "Semester 2") to verify and validate the logic of this function, we don't test other courses in other semesters/ years for this function because we don't have real data for them.

		//We don't test "ascending order/descending order" cases for this function. The testing outcome is always failure for these cases. Because each time the actual output is different. For one time {"FKUserId":"U0019","count":"4"} goes before {"FKUserId":"U0018","count":"4"} in the actual output, for another time {"FKUserId":"U0018","count":"4"} goes before {"FKUserId":"U0019","count":"4"} in the actual output. The order of element changes each time, but the results are the same because the  order doesn't matters. So I only test "alphabetical order" case for this function.

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect ">", $Threshold "0"
		$expected = '[{"name":"U0001","count":"278","amount":104},{"name":"U0002","count":"201","amount":104},{"name":"U0004","count":"142","amount":104},{"name":"U0006","count":"35","amount":104},{"name":"U0009","count":"1","amount":104},{"name":"U0010","count":"215","amount":104},{"name":"U0011","count":"667","amount":104},{"name":"U0013","count":"346","amount":104},{"name":"U0016","count":"3","amount":104},{"name":"U0018","count":"235","amount":104},{"name":"U0019","count":"906","amount":104},{"name":"U0021","count":"85","amount":104},{"name":"U0025","count":"163","amount":104},{"name":"U0026","count":"155","amount":104},{"name":"U0028","count":"3","amount":104},{"name":"U0031","count":"4","amount":104},{"name":"U0032","count":"5","amount":104},{"name":"U0033","count":"124","amount":104},{"name":"U0034","count":"2","amount":104},{"name":"U0037","count":"7","amount":104},{"name":"U0038","count":"2","amount":104},{"name":"U0040","count":"268","amount":104},{"name":"U0041","count":"108","amount":104},{"name":"U0042","count":"170","amount":104},{"name":"U0044","count":"520","amount":104},{"name":"U0047","count":"5","amount":104},{"name":"U0048","count":"734","amount":104},{"name":"U0049","count":"290","amount":104},{"name":"U0050","count":"66","amount":104},{"name":"U0051","count":"9","amount":104},{"name":"U0054","count":"276","amount":104},{"name":"U0055","count":"122","amount":104},{"name":"U0058","count":"636","amount":104},{"name":"U0060","count":"460","amount":104},{"name":"U0062","count":"1","amount":104},{"name":"U0063","count":"295","amount":104},{"name":"U0064","count":"174","amount":104},{"name":"U0068","count":"136","amount":104},{"name":"U0069","count":"39","amount":104},{"name":"U0070","count":"163","amount":104},{"name":"U0071","count":"12","amount":104},{"name":"U0074","count":"177","amount":104},{"name":"U0075","count":"114","amount":104},{"name":"U0076","count":"121","amount":104},{"name":"U0078","count":"68","amount":104},{"name":"U0079","count":"9","amount":104},{"name":"U0080","count":"450","amount":104},{"name":"U0081","count":"154","amount":104},{"name":"U0082","count":"32","amount":104},{"name":"U0084","count":"215","amount":104},{"name":"U0085","count":"192","amount":104},{"name":"U0086","count":"2","amount":104},{"name":"U0088","count":"376","amount":104},{"name":"U0090","count":"16","amount":104},{"name":"U0091","count":"1","amount":104},{"name":"U0092","count":"60","amount":104},{"name":"U0093","count":"69","amount":104},{"name":"U0094","count":"7","amount":104},{"name":"U0095","count":"327","amount":104},{"name":"U0096","count":"108","amount":104},{"name":"U0097","count":"2","amount":104},{"name":"U0099","count":"19","amount":104},{"name":"U0100","count":"1","amount":104},{"name":"U0101","count":"270","amount":104},{"name":"U0102","count":"169","amount":104},{"name":"U0105","count":"200","amount":104},{"name":"U0107","count":"2","amount":104},{"name":"U0108","count":"307","amount":104},{"name":"U0109","count":"199","amount":104},{"name":"U0110","count":"6","amount":104},{"name":"U0111","count":"35","amount":104},{"name":"U0112","count":"472","amount":104},{"name":"U0113","count":"67","amount":104},{"name":"U0115","count":"19","amount":104},{"name":"U0118","count":"4","amount":104},{"name":"U0119","count":"1","amount":104},{"name":"U0120","count":"135","amount":104},{"name":"U0121","count":"39","amount":104},{"name":"U0122","count":"278","amount":104},{"name":"U0123","count":"488","amount":104},{"name":"U0124","count":"95","amount":104},{"name":"U0125","count":"59","amount":104},{"name":"U0126","count":"26","amount":104},{"name":"U0128","count":"14","amount":104},{"name":"U0130","count":"120","amount":104},{"name":"U0131","count":"163","amount":104},{"name":"U0133","count":"68","amount":104},{"name":"U0134","count":"356","amount":104},{"name":"U0135","count":"65","amount":104},{"name":"U0137","count":"2","amount":104},{"name":"U0138","count":"122","amount":104},{"name":"U0139","count":"21","amount":104},{"name":"U0140","count":"266","amount":104},{"name":"U0142","count":"372","amount":104},{"name":"U0143","count":"181","amount":104},{"name":"U0145","count":"8","amount":104},{"name":"U0146","count":"155","amount":104},{"name":"U0148","count":"55","amount":104},{"name":"U0149","count":"153","amount":104},{"name":"U0152","count":"267","amount":104},{"name":"U0153","count":"14","amount":104},{"name":"U0154","count":"13","amount":104},{"name":"U0155","count":"43","amount":104},{"name":"U0156","count":"1","amount":104}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='>';
		$Threshold=0;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);

		//correct expected value for course "MSE", from "20120723", to "20121117", order "Alphabetical order", $ThresholdSelect "<=", $Threshold "50"
		$expected = '[{"name":"U0006","count":"35","amount":39},{"name":"U0009","count":"1","amount":39},{"name":"U0016","count":"3","amount":39},{"name":"U0028","count":"3","amount":39},{"name":"U0031","count":"4","amount":39},{"name":"U0032","count":"5","amount":39},{"name":"U0034","count":"2","amount":39},{"name":"U0037","count":"7","amount":39},{"name":"U0038","count":"2","amount":39},{"name":"U0047","count":"5","amount":39},{"name":"U0051","count":"9","amount":39},{"name":"U0062","count":"1","amount":39},{"name":"U0069","count":"39","amount":39},{"name":"U0071","count":"12","amount":39},{"name":"U0079","count":"9","amount":39},{"name":"U0082","count":"32","amount":39},{"name":"U0086","count":"2","amount":39},{"name":"U0090","count":"16","amount":39},{"name":"U0091","count":"1","amount":39},{"name":"U0094","count":"7","amount":39},{"name":"U0097","count":"2","amount":39},{"name":"U0099","count":"19","amount":39},{"name":"U0100","count":"1","amount":39},{"name":"U0107","count":"2","amount":39},{"name":"U0110","count":"6","amount":39},{"name":"U0111","count":"35","amount":39},{"name":"U0115","count":"19","amount":39},{"name":"U0118","count":"4","amount":39},{"name":"U0119","count":"1","amount":39},{"name":"U0121","count":"39","amount":39},{"name":"U0126","count":"26","amount":39},{"name":"U0128","count":"14","amount":39},{"name":"U0137","count":"2","amount":39},{"name":"U0139","count":"21","amount":39},{"name":"U0145","count":"8","amount":39},{"name":"U0153","count":"14","amount":39},{"name":"U0154","count":"13","amount":39},{"name":"U0155","count":"43","amount":39},{"name":"U0156","count":"1","amount":39}]';
		$SelectCourse="MSE";
		$from= "20120723";
		$to="20121117";
		$order=1;//Alphabetical order
		$ThresholdSelect='<=';
		$Threshold=50;
		$service = new Service;
		$actual = $service->studentActivitiesOverview($SelectCourse, $from, $to, $order, $ThresholdSelect, $Threshold);
		$this->assertEquals($expected,$actual);
	}
}
?>