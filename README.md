# nensa_results
Updates for 1/19/2017

1) Import has been updated to pull in world_cup_points column if there for the U16.  

2) You will need to add a World_Cup_Points column to the events table. INT 5 or so.  Allow null.

3) The U16 rankings view has swapped the USSA_Points for World_Cup_Points.  There is no inclusion
   of USSA_results.  Let me know if you also want them.

4) There is NO ranking column as of yet.  I do not have a SQL solution.  If we want to add column(s) to 
   the season table, we can do so to accomodate averages and rankings.  I can then run a PHP ranking
   calculation script.  This can be triggered with every data import.

5) The wordpress template files include the main config and 4 theme files. Place them in the correct folder
   as indicated by the directory structure of source code.

6) There are 2 types of template.  One is the "original" where I hardcoded the datatable index.  Those are
   template-u16rankings and template-u20rankings.  Yes it's u18/u20 but the template is just called u20.
   The newer version of the template used an advanced custom field to get the index.  That is called 
   template-results.  It can be used for both the U16 and the U18/20.

7) If you choose to use template-results, then you need to install the Advanced Custom Filed plugin
		and create a field per the screen shots in the config directory.

8) The screen shots for the rankings datatables have now been added.

9)  This is the wpdatatables query for the U18/20

SELECT member_season_u20_jn_rankings.Season,
       member_season_u20_jn_rankings.NENSA,
       member_season_u20_jn_rankings.Athletes_Name,
       member_season_u20_jn_rankings.Club_Name,
       member_season_u20_jn_rankings.Sex,
       member_season_u20_jn_rankings.USSA_num,
       member_season_u20_jn_rankings.Age_Group,
       member_season_u20_jn_rankings.#_Races,
       member_season_u20_jn_rankings.Best_Race_Result,
       member_season_u20_jn_rankings.Best_USSA_Result,
       member_season_u20_jn_rankings.2ndBest_USSA_Result,
       member_season_u20_jn_rankings.3rdBest_USSA_Result,
       member_season_u20_jn_rankings.Avg_2_Best,
       member_season_u20_jn_rankings.Avg_4_Best
FROM member_season_u20_jn_rankings
WHERE member_season_u20_jn_rankings.Avg_2_Best<>0 AND member_season_u20_jn_rankings.Sex='%VAR1%'

10) This is the datatables query for U16

SELECT member_season_u16_jn_rankings.NENSA,
       member_season_u16_jn_rankings.USSA_num,
       member_season_u16_jn_rankings.Athletes_Name,
       member_season_u16_jn_rankings.Sex,
       member_season_u16_jn_rankings.Club_Name,
       member_season_u16_jn_rankings.#_Races,
       member_season_u16_jn_rankings.Best_World_Cup_Points,
       member_season_u16_jn_rankings.Best_World_Cup_Points,
       member_season_u16_jn_rankings.2ndBest_World_Cup_Points,
       member_season_u16_jn_rankings.3rdBest_World_Cup_Points,
       member_season_u16_jn_rankings.Avg_2_Best,
       member_season_u16_jn_rankings.Avg_3_Best
FROM member_season_u16_jn_rankings
WHERE member_season_u16_jn_rankings.Avg_2_Best<>0 AND member_season_u16_jn_rankings.Sex='%VAR1%'


------------------------------------------------------------------
There are 4 groups of files

1) The sql for the views.  

2) The php code for importing csv files to the results database

3) The Wordpress files.

4) Config images for the wp-datatables

-------------------------------------------------------------------

1) Views. Run as query using db tool.  Preferrably after the data has been loaded.  Adjust accordingly.  The Wordpress datatables will point to the views.  If the time is taken to asign named lables then there is less config at the Wordpress level.  They can still be overriden at the Wordpress wpdatatabes setting config.

2) The results import code.  The php in here will be migrated to a wordpress plugin but for the time being operate as a simple, stand alone web site.  Point a MAMP site to the parent directory and invoke the single index-nnnnn.php file.  member_skier is first, member_season is second, race_results last with an import for each race csv.  Note that the events for the EC1 must be entered by hand into the results database. Adjust the hardcoded event indices in the import code.  This will be cleaned up when incororated into the plugin.  Note that the db connection params must be set in connection.pgp.  Also, please review age_group.php. Checks have been added for correct file type and column headers on the member imports. File type must be csv and columns conform to lastest column as downloaded by Sean.  

3) The wordpress files are very limited at this point.  I suspect there will only be 4 to 5 files when the project is complete.  Now there are 2.  I added an extra global for the results database in the wp-config.php file. That's where something should live. Second, the tables and logic for the results and rankings will be done in a theme template. It's a bit risky and probably not the best design but it's pretty light weight.  The goal is to have a series of dynamic php driven secelts that adjust a parameter or two that is inserted into the shortcode for wpdatables.  For the results table, it's pretty easy.  Querey the main database for season, then get the events for that season, choose the event and then get the specific races.  Then with the race_name set as a variable in the shortcode, inject the shortcode into the wordpress results page for auto display using the set variable to display only the race in question.   NOTE:  each wpdatatable has an ID and shortcode references that ID.  Make sure to adjust the ID in the code.  We may be able to pull the ID from the wordpress database using the wpdatatables API but let's get it working first.  The directory structure conforms to the placement in the wordpress project.

4) The config files for the wpdatatables.  I dod not see anyway to export a series of setting so I took some screen shots of my config.  The config is very simple and can be done in a few minutes.  It is fragile though.  Change a few fields in the view and it won't work.  It is driven by a SQL query.  No other way around it.  Note that the wpdatatabes variables %VAR% must be capitilized.  %var1% will not work. Trust me, I wasted an hour on that one.

5) In order to create and view a Wordpress Results page, the current results page must have it's template changed to the results template.  This is accessible form a dropdown on the lower left of the Wordpress page edit page.  The wpdatatable shortcode will be processed via the template.  The content of the page can be left blank to start.  The title will appear above the select menus.

6) Add the varchar field 'club_name' to member_skier.  Check all fields for allow null against screen shots.  Can't remember which ones I changed.  Please note here or in an email.'



