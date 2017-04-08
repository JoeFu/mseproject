<h1>Student_data develop Log</h1>
<h2>Previous Develop Log before 4/8/2017</h2>

<h2>Log in 4/8/2017</h2>
<p>Q&A</p>
<li><b>Q 1:How to solve the 404 page in Server?</li></b>
<p>A: In this website development, I 'm using ubuntu LTS 14 as our server in AWS, so the configure file should in
etc/apache2/sites-enable/000-default.conf  Add these script into this file.
<br>
<code>  CustomLog ${APACHE_LOG_DIR}/access.log combined<br>
        ErrorDocument 404 /custom_404.html<br>
        ErrorDocument 500 /custom_50x.html<br>
        ErrorDocument 502 /custom_50x.html<br>
        ErrorDocument 503 /custom_50x.html<br>
        ErrorDocumenr 504 /custom_50x.html<br>
</code>
And create following html file which show the 404 page, for example custom_404.html, and edit this file.
Finally, restart the apache2 service. <br>
<code>sudo apache2 service restart</code>
</p>
