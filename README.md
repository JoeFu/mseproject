# <b>Organised Access to Historical Student Data Project Discription </b>

The Universiry of Adelaide, School of Computer Seciece has <b>12</b> years of Moodle and WebSubmission data. These data have been collected. The problem now is organising it for searching and trend analysis.
<br><br>
Our database is given by clients which include <b>forum CSV files</b> and <b>web-submission</b> files.<br> 

Following points are what we have done to solve the problem we deiscribed above.

<li> We provide <a href="http://www.studata.tk/demo/pages/Moodlecharts.html">Moodle Charts </a> to show the students forum activities by charts.

<li> We provide <a href="http://www.studata.tk/demo/pages/WebSubmissionCharts.html">Websubmission Charts</a> to show the students websubmisson destribution by charts.

<li> We provide <a href="http://www.studata.tk/dashboard/CriticalQuestions.html">Critical Questions</a> to show the realtionships between students forum activities and websubmissions.

<li> We provide <a href="http://www.studata.tk/demo/pages/simplequery.html">Data Query</a> and <a href="http://www.studata.tk/demo/pages/tables.html">Data Table </a> as a handy tools for researchers.

<li> We provide survey framwork for resaercher post there survey, here are the examples, <a href="http://www.studata.tk/demo/pages/survey1.html">Survey1</a> and <a href="http://www.studata.tk/demo/pages/survey2.html">Survey2</a>.

<li> We have provide the <a href="http://www.studata.tk/login/">Login function</a> and <a href="http://www.studata.tk/demo/pages/help.html">Help Center</a>.

<li> We build the system based on research purpsoe. The main idea of the website is build a UI friendly and visualized data analyisis platform. We leave plenty of data interface and UI interface for second time development.

<li>The main development languages are <code >HTML+ PHP + JS</code>. 
<br>Backend is basd on php to output the json files, and front-end using Ajax to push the data to the charts module.


<b> Demo Guide </b>

<li> Access <a href="http://studata.tk">Index Page </a>.
<li> Using Demo username: <b>admin</b>, password: <b>admin</b> to login the system.
<li> After login, the system will takes you to our <a href="http://www.studata.tk/demo/pages/index.html">demo page</a>.
<li> Using navgation bar in the left select different function.
<li> Using the search bar in the top or access <a href="http://www.studata.tk/demo/pages/help.html">Help Center</a>.
<li> WebSubmission Charts, fill out the filter condition, then following the hint.You can see all the pre-configured charts below.
<li> Moodle Charts page, fill out the filter condition, then following the hint. You can see all the pre-configured charts. You can Change Presentation Order, Set period, export to CSV file, and set threshold.


<b>Second time development</b>

If you want to using it for your project, please follow the steps below.
<li> Clone the Project: <a href="https://github.com/JoeFu/mseproject.git">Downlaod</a>.
<li> Find out the <code> /Website </code> Folder.
<li> Modify the code as you need.
<li> We mainly using Echarts as our charts framwork. Please following the <a href="https://ecomfe.github.io/echarts-doc/public/en/api.html">Echarts API</a>. And the UI part, we are using <a href="https://getbootstrap.com/docs/3.3/getting-started/">Bootstrap </a>as the main UI framwork. Besides, we also import JQuery CSS and JS. The demo index page using <a href="https://disqus.com/">Disqus</a> as discussion forum.

<strong style="color:red"><li> Before you using, please follow the <a href="http://www.studata.tk/terms.html#license"> MIT license</a>.</strong>



More information:
<br>
 Development log, please refer <a href="https://github.com/JoeFu/mseproject/blob/master/Website/log/develop_log.md">Develop Log</a>.
 <br>
About developer and project full introduction: <a href="http://studata.tk/about.html">About us</a>.<br>
Before you using the Demo and modify the open source, Please read <a href="http://studata.tk/privacy.html">Privacy </a> & <a href = "http://studata.tk/terms.html">Terms</a> .