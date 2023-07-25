Project Title: Online Todo Application

Project Description:

User Registration and Login:
	Users can sign up using their name, phone number, email address and password to create a new account.
	While login, user have to provide email and password.
	Upon successful login, users are granted access to their personalized todo management interface.

Todo Management:
	Users can create, view, edit, and delete their own todos.
	Each todo consists of a title and description.
	Todos can be organized and prioritized according to the user's preferences.

User Interface:
	The application provides a user-friendly interface with intuitive navigation and clear design.
	The index page presents an overview of todos and provides easy access to various features.
	Users can easily search and sort todos based on title and description to find specific tasks.

Collaborative Features:
	Users have the option to view todos created by other users.
	Todos created by other users are displayed alongside the username of the creator.
	Collaboration features allow users to view a broader range of tasks and foster collaboration.

Security and Data Protection:
	User passwords are securely hashed and stored in the database to ensure data protection.
	Proper authentication and authorization mechanisms are implemented to prevent unauthorized access.
	The application follows best practices for data privacy and protection.
-----------------------------------------------------------------------------------------------------------------------------------------

Validations:

'name' Validation:
	The 'name' field is required and must consist of alphabetic characters and spaces.
	It should be between 3 and 50 characters long.

'phone' Validation:
	The 'phone' field is required and must follow the Indian phone number format.
	It should start with a digit from 6 to 9 and be exactly 10 digits long.

'email' Validation:
	The 'email' field is required and must be a valid email address.
	It should match the regular expression pattern for standard email format.

'password' and 'confirm password' Validations:
	The 'password' field is required and must follow a specific pattern for strong passwords.
	It should have at least 8 characters and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.
	The 'confirm password' field is required and must match the 'password' field value for password confirmation.
----------------------------------------------------------------------------------------------------------------------------------------

Deployment Configuration:

The application is designed to run on localhost with the port number set to 1234.
To ensure a successful connection to the MySQL database, please place the project folder inside the 'htdocs' folder of your server.
To access the application, Browse "localhost:1234" in web-browser.
----------------------------------------------------------------------------------------------------------------------------------------

Sample Database:

Attached with the project, you will find a sample MySQL database file (tododb.sql).
This database file includes two sample user accounts and some pre-populated todos for testing purposes.

The sample user accounts have the following credentials:
User 1:
	Email: user.one@test.com
	Password: Test@1234
User 2:
	Email: user.two@test.com
	Password: Test@1234
-----------------------------------------------------------------------------------------------------------------------------------------

Thanks,
Regards
Asik Ahmad Mondal
-PHP January Batch
-Ejob India

