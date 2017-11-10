#1. Evil shit

#Command Injection
curl “http://192.168.0.16/example.php?127.0.0.1;ls”

#Download File from URL
curl -O https://the.earth.li/~sgtatham/putty/latest/putty.exe

#HTTP Headers
curl -v -X http://www.google.com

#File Inclusion
curl http://192.168.0.16/example.php?page=etc/passwd

#HTTP Authentication
curl -data “uname=test&pass=test” http://testphp.vulnweb.com/userinfo.php

#File Upload
curl -F ‘image=@/root/Desktop/putty.exe’ http://192.168.0.16/upload/example1.php

#2. Reading URLs

#Read a plain URL.
curl http://www.google.com

#Read a secured URL.
curl https://www.secure-site.com

#Get a web page and store it in a file. The following for example will store the index page retrieved to the file savedpage.html
curl -o savedpage.html http://www.example.com/

#Get a HTTP Basic authenticated page
curl -u username:password http://www.example.com/

#Sometimes a page may redirect to another resource. By default CURL will not follow page redirections. To make CURL follow redirections use the -L option.
curl -L http://www.example.com/


#Get your routers IP
curl ifconfig.me #returns only the IP
curl ifconfig.me/all.json

#3. Reading URL’s with variable GET parameters

#You can also download pages with a variable GET parameter. For e.g take the following url:
http://example.com/pages.php?pageNo=35

#The variable here is the pageNo parameter. You can download all the pages by adding a regular expression like parameter in the CURL url as given below.
curl -o pages#1.html http://example.com/pages.php?pageNo=[1-12]
#This will download all the pages from page no 1 to page no 12 and save it to a corresponding file.


#4. Reading document information

#Show document headers only
curl --head http://www.google.com/

#You can also use it on any specific resource.
curl --head http://www.google.com/logo_plain.jpg

#Dump document headers to a file
curl --dump-header headers.txt http://www.google.com/


#5. CURL and FTP

#Get a FTP directory listing
curl ftp://username:password@example.com

#To get the listing of a different directory append the directory name to the URL.
curl ftp://username:password@example.com/directory/

#Upload a file to a remote directory using FTP
curl -T uploadfilename -u username:password ftp://sitename.com/myfile

#The ‘uploadfilename’ file will be copied to the remote site and named ‘myfile’. If the destination filename is eliminated the file will be copied with the original name. By default the file will be copied to the root directory. To copy to some other directory specify the directory after the site name;e.g.
curl -T uploadfilename -u username:password ftp://sitename.com/directory/myfile


#6. To POST to a page.

#You can also process a POST request using CURL. The data will use the application/x-www-form-urlencoded encoding. Lets say you have the following POST form in your page:
<form method="POST" action="process.php">
          <input type=text name="item">
          <input type=text name="category">
          <input type=submit name="submit" value="ok">
</form>

#You can use the following CURL command to POST the request.
curl -d "item=bottle&category=consumer&submit=ok" www.example.com/process.php


#7. Referer & User Agent

#HTTP requests may include a ‘referer’ field, which is used to tell from which URL the client got to this particular page. Many programs/scripts check the referer field of requests to check the source of the request. You can simulate the referer field by the following command.
 curl -e http://some_referring_site.com  http://www.example.com/

#All HTTP requests may set the User-Agent field. It names what user agent or client that is being used. Many web applications use this information to decide how to display web pages or use it to track browser usage. You can impersonate a particular browser by the following method:
curl -A "Mozilla/5.0 (compatible; MSIE 7.01; Windows NT 5.0)"  http://www.example.com

