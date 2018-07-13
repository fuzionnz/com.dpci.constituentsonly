# Constituents Only Filter

CiviCRM Extension to allow only AGBU constituents to appear in searches and reports.
AGBU wants only records that are flagged as a "constituent" to be included in searches and reports. 
For instance, if John Doe is a donor and Jane Doe is his wife, you can see Jane's info from John's relationships tab, 
but she won't show up in search.

This extension that allows us to exclude users from search but still allow them to appear in relationships.
Here we repurposed the "do_not_trade" field in the `civicrm_contact` table in the database. 
Only contacts with this field/flag set is considered constituent and will be returned in the searches and reports.


Install as any other CiviCRM Extension.

Release Notes:
* This CiviCRM extension is custom developed for AGBU.org
* This is the alpha version, more changes to come as it is tested in real environment.
* This extension id designed to work on CiviCRM 4.7+.

Author: Joozer Tohfafarosh, DPCI, jtohfafarosh at dpci dot com.

Mentor: Jon Goldberg, Megaphone Technology Consulting. 

