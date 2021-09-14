### This little program developed in 2 days is done to refresh the skills I used on larger projects some years ago before I had to left developing because I had to take care about my ill mother.
### In this case we can register an user and upload an avatar to the server. Also we make an <u>asynchonous call to the server</u> which allows a modal to retrieve data on real time <u>without having to reload the page</u>.
### This time I did with no frameworks because I always like to know and understand how things work with vanilla languages.
### I used jquery because, although this library is not very used in 2021, there are a lot of old projects out there with jquery which maybe can require to be maintained.
### Also jquery is needed in this case because in order to use Bootsrap modals you must include jquery before the bootstrap .js files.
### Another advantage of jequery for this project is that ajax calls to perform async request are much more legible and maintainable than with vanilla JS, as well as it allows me to manipulate the modal HTML easily.
### Feel free to use the code if you want. Actually the uploadFile.php will serve as a template for me whenever I have to do it. You have only to be careful with methods like insertUser() which are called inside this .php file because we will only create the user on database when the file we are trying to upload is allowed. Yes I am sure there are better ways to implement this but for now it is enough.
### You can upload images with max. 50KB size, and .jpg or .npg extensions.
### Many validations and usability tests are not done because this time the idea was to refresh the upload file logic.
### The idea on how to show modals with async data was taken from here https://stackoverflow.com/questions/29458705/ajax-request-with-bootstrap-modal-in-php
