/*!
By: Aziz Moalim
7.43
Give me a summary of m_link_type. The result set should contain the count of each m_link_type. 

This is the over 100,000 data set:
This is used on 1,175,493 rows and returns the below time
Showing rows 0 - 2 (3 total, Query took 0.8430 seconds.)

This is the orginal data:

This is used on 18 rows and returns the below time
Showing rows 0 - 2 (3 total, Query took 0.0011 seconds.)



*/

SELECT m_link_type, count(*)
FROM movie_media
GROUP BY m_link_type;

/*

/*!
Query 7: Get the list of trivia for the people. Do NOT show blanks on either side. 
By Kim San Heng 

[1]
SELECT DISTINCT `id`,`stage_name`,`first_name`,`middle_name`,`last_name`,`gender`,`image_name`,`people_trivia_id`,`people_trivia_name` 
FROM `people`
INNER JOIN `people_trivia` 
ON `id` = `people_id`
WHERE `id` = `people_id`
[2]
id = 1 and 1
select_type = simple and simple
table = people_trivia and people
type = ALL and eq_ref
possible_keys = Null and Primary
key = Null and Primary
key_len = Null and 4
ref = Null and omdb2.people_trivia.people_id
rows = 62366 and 1
Extra = Using temporary
Showing rows 0 - 24 (83630 total, Query took 0.0018 seconds.)
[3]
So I removed DISTINCT and the WHERE CLAUSE also added LIMIT 3 for duplicates
[4]
id = 1 and 1
select_type = simple and simple
table = people_trivia and people
type = ALL and eq_ref
possible_keys = Null and Primary
key = Null and Primary
key_len = Null and 4
ref = Null and omdb2.people_trivia.people_id
rows = 62366 and 1
Extra = 
Showing rows 0 - 2 (3 total, Query took 0.0011 seconds.)

*/

