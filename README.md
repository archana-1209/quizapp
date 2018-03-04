# QuizApp

QuizApp is a quiz application that made with PHP. Enjoy!

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

(Windows instructions)

#### Set up Server and Repo
1. Download and install the latest version of [XAMPP](https://www.apachefriends.org/download.html), which is a free software package consisting of a web server, MySQL database, and PHP. The installation directory (e.g. C:\xampp) will be referred to as `${XAMPP}`)
2. From the command prompt, navigate to `${XAMPP}\htdocs`
3. Clone the repo. In the command prompt, enter:
	1. `git clone https://github.com/ecehanece/quizapp.git quizapp`
	2. Note: Replace "quizapp" with any name you want for your root folder. The root of the local git repo will be referred to as `${REPO}`
	
#### Set up database
1. Start the XAMPP control panel (`${XAMPP}\xampp-control.exe`)
2. From the control panel, start Apache and MySQL
3. Navigate to `localhost/phpmyadmin` in your browser
4. Click "Import" on the top
5. Upload the sql file on ${XAMPP}\htdocs\quizapp\quizapp.sql
6. Click "Go" on this page and your table is ready

Now, navigate to `localhost/quizapp` in your browser and you can start solving the quiz.

## Built With

* [PHP](http://php.net/)
* [JQuery](http://jquery.com/)
* [Bootstrap](http://getbootstrap.com/)
* [Bootstrap Notify](http://bootstrap-notify.remabledesigns.com/)
* [MySQL](http://www.mysql.com/)

## Authors

* **Ecehan Ece** - [LinkedIn](https://linkedin.com/in/ecehanece/)
