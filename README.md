# Jellyworld

This is a project I made for a friend. They started off with a JSON file that had to manually be maintained, so I built a back-end with PHP/SQL to make management a little more automated.

This project is built & tested with PHP 7.4.

## Overview

This project contains different webpages:
- /login/ (public) - The login page.
- /logout/ (public) - The logout page.
- /register/ (public) - The account registration page.
- /dashboard/ (private) - The dashboard/approval page.
- /dashboard/jelly-management.php (private) - The jelly management page.
- /dashboard/jelly-o-tron.php (private) - The jelly-o-tron page (to submit adoptable jellies)
- /claim/index.php - The page where anyone can claim a jelly.

Users are required to register for an account before they can see any of the private pages. I turned off **email validation** for new registrations because this is a pretty much a specific private project for a friend, but you can always add that in later if you like.


## Flow

Below is the recommended flow of usage for the main pages:

- **/dashboard/** (private)
    - The dashboard/approval page.
    - You can approve new entries by clicking on them. There is no way to deny users from the approval page currently.

- **/dashboard/jelly-management.php** (private)
    - The jelly management page.
    - You can edit existing jellies here, by clicking on the "edit" link beside the jelly you want to edit. This will display form fields where you can fill in the data. When you 'save' a jelly, it automatically updates the JSON file.

- **/dashboard/jelly-o-tron.php** (private) 
    - The jelly-o-tron page (to submit adoptable jellies)
    - This is a 'stripped down' submission page which is meant to only be used to add **brand new** jellies that do not have an owner.

- **/claim/index.php**
    - The page where anyone can claim a jelly.
    - While mainly meant for 'public' use, it's recommended that if you'd like to add a new jelly with a owner, you should fill out the form at the bottom of this page and submit it.
    - Every item submitted via the form here goes over to the **/dashboard/** approval queue. While it is waiting for approval, the "claimed" Jelly temporarily enters 'limbo' where it is not yet available and not yet claimed.