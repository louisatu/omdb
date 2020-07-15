/*!
By: Aziz Moalim
7.43
Give me a summary of m_link_type. The result set should contain the count of each m_link_type. 

*/;

SELECT m_link_type, count(*)
FROM movie_media
GROUP BY m_link_type;

/*!
By: Kimsan Heng
7.64
Given a search string, the query should search across native_name (in movies table), stage_name (in peoples table) and title (in songs table). And the query should return all the matches specifying the type of the item (movie, people, song) matched. Let us say I have given the input string as “o”, your tuples may look as follows since “o” is there in “frozen”, “tom hanks”, and “let it snow”.

*/;

SELECT `movie_id` AS `id`,`native_name` AS `name_matched`, "movie" AS `type_of_match`
FROM `movies`
WHERE (`native_name`) LIKE '%o%'
UNION ALL

SELECT `id`,`stage_name` AS `name_matched`, "people" AS `type_of_match`
FROM `people`
WHERE (`stage_name`) LIKE '%o%'
UNION ALL

SELECT `song_id`,`title` AS `name_matched`, "song" AS `type_of_match`
FROM `songs`
WHERE (`title`) LIKE '%o%'
