# John BoDa Buff

A content management website to help new players start playing


58 currently
+ 5 composer - TinyMCE + BootStrap
## Timeline...So far

1. Build the backend
    - Create Users onto database
    - Password Security
    - Admin Dashboard
2. Front End
    - ?????
    - I haven't thought this far ahead yet

## Current Issues/Thoughts in Brain
1. User registration and creation - Completed March 17, 2019
    - ~How do I make the textbox all stars on input?~ Accomplished by using input="password"
    - ~How do I encrypt it in my database?~ Solved by password_hash()
    - What pieces of all of this need to come together before I can turn users into Approved or Admin?
    - ~At what point do I build the admin dashboard?~ This was dumb, i can do it whenever i want.
    - ~Do I need to make my member status an enum? instead of having 3 different columns in the database?~ Setting the member value to 1, Approved to 2, and Admin to 3 solves this
    - ~Create login page~ - Successful! the hard part of creating a login page was not selecting the wrong column name, its UserID not ID.....
    
2. Git
    - This is a test to see if this is making indented lists
    - How often do you commit?
3. Items/Heroes
    - (ADMIN ONLY) Setup pages to allow admin to insert of hero icons and spells
    - Users allow creation builds


## Contributing
* **John Bo** - This is a solo project after all!

## Versioning

* This is mostly used for me to get used to git! - Expect no consistency!

## Authors

* **John Bo** - I wrote the code, and doing all the back end stuff!


## Acknowledgments

* Me for being such a cool dude with really boring ideas!
* You - because you're reading this!
* **Nick Thiessen** - Helped with the database design!
