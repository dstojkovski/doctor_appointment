Doctor's Appointment App
Welcome to the Doctor's Appointment App! This is a simple web application that allows users to schedule, edit, and cancel appointments with a doctor. The application is built using PHP and MySQL.

Features
Schedule new appointments within working hours (Mon-Fri, 9am-5pm).
Edit existing appointments, ensuring no overlaps and within working hours.
Cancel appointments.
Display a list of appointments with various details.
Setup Instructions
Database Setup:

Before starting, make sure you have MySQL and a web server (e.g., Apache) installed and running.

Create a new connection with Hostname: localhost , username : root , password : 1234
Create a new schema in MySQL, named pabau.
Import the provided pabau_appointments.sql file into the database from self-contained file. This will set up the required Appointments table.
Application Setup:

Clone this repository to your web server's document root folder.
Update the config.php file with your database connection details if needed.
Usage:

Access the application by visiting http://your-server/appointments.html.
To schedule a new appointment, provide the required details in the form and click "Schedule Appointment."
To edit an appointment, click the "Edit" link in the appointment list, update the details, and click "Save Changes."
To cancel an appointment, click the "Cancel" link in the appointment list.


Notes

Appointments are only allowed within working hours (Mon-Fri, 9am-5pm).
Overlapping appointments are not allowed.
Editing appointments ensures they are within the same day and working hours.
Canceling an appointment permanently removes it from the database.

David Stojkovski  
davidstojkovski51@yahoo.com
