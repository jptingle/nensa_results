CREATE OR REPLACE VIEW MEMBER_SEASON_TOP_RESULTS AS
SELECT s.season, m.nensa_num, m.first as 'First Name', m.last as 'Last Name', 
        m.sex as 'Sex', e.Division, s.age_group,
        COUNT(e.USSA_Result) as '# Races',
        MIN(e.USSA_Result) as 'Best Race Results',
        (SELECT USSA_Result
            FROM RACE_RESULTS
            WHERE member_season_id=s.id AND USSA_Result <> 0
            GROUP BY USSA_Result HAVING COUNT(*) > 0
            ORDER BY USSA_Result ASC
            LIMIT 0,1) as 'Best_USSA_Result',
        (SELECT USSA_Result
            FROM RACE_RESULTS
            WHERE member_season_id=s.id and USSA_Result <> 0
            GROUP BY USSA_Result HAVING COUNT(*) > 0
            ORDER BY USSA_Result ASC
            LIMIT 1,1) as '2ndBest_USSA_Result',
        (SELECT USSA_Result
            FROM RACE_RESULTS
            WHERE member_season_id=s.id and USSA_Result <> 0
            GROUP BY USSA_Result HAVING COUNT(*) > 0
            ORDER BY USSA_Result ASC
            LIMIT 2,1) as '3rdBest_USSA_Result'
FROM 
    MEMBER_SEASON s
        INNER JOIN 
    RACE_RESULTS e ON e.member_season_id = s.id
        INNER JOIN 
    MEMBER_SKIER m ON m.member_id = s.member_id
WHERE e.USSA_RESULT <> 0
GROUP BY s.id
ORDER BY Best_USSA_Result;

CREATE OR REPLACE VIEW MEMBER_SEASON_RANKINGS AS
SELECT `season`, `nensa_num`, `First Name`, `Sex`, `Last Name`, `Division`, `age_group`, `# Races`, 
`Best Race Results`, `Best_USSA_Result`, `2ndBest_USSA_Result`, `3rdBest_USSA_Result`,
(Best_USSA_Result+2ndBest_USSA_Result)/2 AS 'Avg Top 2', 
(Best_USSA_Result+2ndBest_USSA_Result+3rdBest_USSA_Result)/3 AS 'Avg Top 3'
FROM MEMBER_SEASON_TOP_RESULTS;