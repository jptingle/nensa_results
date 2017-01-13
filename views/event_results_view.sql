CREATE OR REPLACE VIEW EVENT_RESULTS AS
SELECT 
      (SELECT event_name
        FROM RACE_EVENT
        WHERE event_id=e.parent_event_id) as 'Event',
      e.parent_event_id, e.event_name, e.season, m.nensa_num, s.ussa_num, 
      r.Finish_Place, r.Full_Name, s.last, r.Birth_Year, e.sex, r.Division, 
      m.age_group, m.club_name, r.Race_Time, r.Race_Points,r.USSA_Result
FROM 
    Race_Results r
        INNER JOIN
    RACE_EVENT e ON e.event_id = r.event_id
        LEFT JOIN
    MEMBER_SEASON m ON m.id = r.member_season_id
    	LEFT JOIN 
    MEMBER_SKIER s ON s.member_id = m.member_id
WHERE r.Finish_Place<>0;


