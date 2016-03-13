Fetch a web page and parse the html tags.  Display the sorted list of tags by frequency, and highlight it's appearances in the content.

Written in PHP, utilizing XML_HTMLSax, http://sourceforge.net/projects/phpshelve/.  I made very minor changes for compatibility with
PHP 5.5, and I removed the dependency on Pear.

Admittedly, PHP isn't my strongest language.  I'm a Java developer, but didn't want to deal with setting up a webapp
on my IDE, IntelliJ, and then figuring out how to deploy it on Tomcat on AWS.  I'd rather spend that effort Googling PHP methods.

A working demo of the code can be found at http://ec2-54-191-48-26.us-west-2.compute.amazonaws.com/

Steve Weiss
stevekweiss@gmail.com