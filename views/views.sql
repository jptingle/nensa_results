CREATE VIEW '_view_userlist' AS 
SELECT u.userid,u.fullname,u.username,e.userid,e.listid,e.title,e.status 
FROM users u 
LEFT OUTER JOIN list e ON e.userid=u.userid 
WHERE u.status=1 AND e.status=1 



CREATE VIEW EventResults AS
    SELECT 
        d.orderNumber,
        customerName,
    FROM
        orderDetails d
            INNER JOIN
        orders o ON o.orderNumber = d.orderNumber
            INNER JOIN
        customers c ON c.customerNumber = c.customerNumber;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `video_and_category`
AS SELECT
   `b`.`title` AS `video_name`,
   `d`.`name` AS `category_name`
FROM ((`video_category_links` `a` join `videos` `b` on((`a`.`video_id` = `b`.`id`))) join `video_categories` `d` on((`a`.`cat_id` = `d`.`id`)));


CREATE VIEW EVENT_RESULTS AS
SELECT e.event_name, e.technique, e.distance, e.season, m.nensa_num, m.ussa_num, r.Finish_Place, m.first, m.last, m.country, m.state, r.Full_Name, r.Birth_Year, e.sex, r.Division, r.Race_Time, r.Race_Points,r.USSA_Result
FROM 
    Race_Results r
        INNER JOIN
    RACE_EVENT e ON e.event_id = r.event_id
        INNER JOIN
    MEMBER_SKIER m ON m.ussa_num = r.member_season_id;


CREATE VIEW RANKINGS_5 AS
SELECT e.season, m.nensa_num, m.ussa_num, m.first, m.last, m.country, m.state, r.Full_Name, r.Birth_Year, e.sex, r.Division, AVG(r.Race_Points),AVG(r.USSA_Result),
       MIN(r.Race_Points) as '#1'
FROM 
    Race_Results r
        INNER JOIN
    RACE_EVENT e ON e.event_id = r.event_id
        INNER JOIN
    MEMBER_SKIER m ON m.ussa_num = r.member_season_id
WHERE r.Finish_Place>0
GROUP BY m.ussa_num;


CREATE VIEW MEMBER_SEASON_RANKINGS AS
SELECT m.season, m.nensa_num, e.Full_Name, e.Division, m.age_group,
        COUNT(e.USSA_Result) as '# Races',
        MIN(e.USSA_Result) as 'Best Race Results',
        (SELECT USSA_Result
            FROM RACE_RESULTS
            WHERE member_season_id=m.id
            ORDER BY USSA_Result ASC
            LIMIT 1) as 'Race Results #1',
        (SELECT USSA_Result
            FROM RACE_RESULTS
            WHERE member_season_id=m.id
            ORDER BY USSA_Result ASC
            LIMIT 0,1) as 'Race Results #2',
        (SELECT Finish_Place
            FROM RACE_RESULTS
            WHERE member_season_id=m.id
            ORDER BY Finish_Place ASC
            LIMIT 1) as 'Finish Place #1',
        (SELECT Finish_Place
            FROM RACE_RESULTS
            WHERE member_season_id=m.id
            ORDER BY Finish_Place ASC
            LIMIT 0,1) as 'Finish Place #2'
FROM 
    MEMBER_SEASON m
        INNER JOIN
    RACE_RESULTS e ON e.member_season_id = m.id
GROUP BY m.id