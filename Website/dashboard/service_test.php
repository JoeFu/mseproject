<?php 
require_once dirname(__FILE__).'./service_class.php';

//Development environment: WAMPServer Version 2.2 (PHP 5.3.13, MYSQL 5.5.24)
//Testing tool: PhpUnit4.8.36
//Database and data used for testing: studentdata_#74.sql

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
}
?>