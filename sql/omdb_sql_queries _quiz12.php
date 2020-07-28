


/* 
Query 7: Get the list of trivia for the people. Do NOT show blanks on either side. 
By Kim San Heng 
*/
SELECT DISTINCT `id`,`stage_name`,`first_name`,`middle_name`,`last_name`,`gender`,`image_name`,`people_trivia_id`,`people_trivia_name` 
FROM `people`
INNER JOIN `people_trivia` 
ON `id` = `people_id`
WHERE `id` = `people_id`



/*
Query 8: Get the list of those people who have some association with 
the songs. If they don’t have any association, then do NOT 
show them in the list.
And for each song, show the corresponding movie. If the 
corresponding movie doesn’t exist, then return NULLs for 
the movie information.
By Louis Atu Tetuh
*/
SELECT DISTINCT people.id, people.stage_name, people.image_name, song_people.song_id , songs.title, movie_song.movie_id, movies.native_name
FROM `people`
INNER JOIN `song_people`
    ON `id` = song_people.people_id
INNER JOIN `songs`
    ON song_people.song_id = songs.song_id
INNER JOIN `movie_song`
    ON songs.song_id = movie_song.song_id
INNER JOIN `movies`
    ON movie_song.movie_id = movies.movie_id



/* 
Query 9: Get the list of all songs in the database. 
By Mahamad Osman 
*/
SELECT * FROM `songs` WHERE 1



/*
Query 10: Get the list of trivia for the songs. 
By Sharmarke Mohamed 
*/
SELECT song_trivia.song_trivia_id, song_trivia.song_trivia_name, 
songs.song_id, songs.title, songs.lyrics, songs.theme
FROM song_trivia JOIN songs ON (songs.song_id = song_trivia.song_id)



/* 
Query 11: Get the list of associated people for each song. 
If corresponding people do NOT exist, show blanks for the people. 
By Aziz Moalim 
*/
SELECT DISTINCT `people`.*, `song_people`.role, `songs`.*
FROM `songs`
    INNER JOIN `song_people`
          ON songs.song_id = song_people.song_id
    INNER JOIN `people`
        ON song_people.people_id = people.id



/* 
Query 12: Get the list of the songs and the corresponding media. 
By Kim Pampusch 
*/
SELECT songs.song_id, songs.title, songs.lyrics, songs.theme, song_media.song_media_id, song_media.s_link, song_media.s_link_type
FROM songs INNER JOIN song_media ON songs.song_id = song_media.song_id;



/* 
Query 33:
Connect all the tables from “movies” perspective; 
You should show ALL movies. Show NULLs if there is no corresponding movie_data or media or songs or people
*/
SELECT movies.movie_id, movies.native_name, movies.english_name, movies.year_made, 
movie_data.tag_line, movie_data.language, movie_data.country, movie_data.genre, movie_data.plot, 
(SELECT COUNT(*) FROM movie_trivia WHERE movie_trivia.movie_id = movies.movie_id) AS number_of_trivia, 
(SELECT COUNT(*) FROM movie_keywords WHERE movie_keywords.movie_id = movies.movie_id) AS number_of_keywords, 
(SELECT COUNT(*) FROM movie_media WHERE movie_media.movie_id = movies.movie_id) AS number_of_media, 
(SELECT COUNT(*) FROM movie_song WHERE movie_song.movie_id = movies.movie_id) AS number_of_songs, 
(SELECT COUNT(*) FROM movie_people WHERE movie_people.movie_id = movies.movie_id) AS number_of_people 
FROM (movies LEFT JOIN movie_data ON movies.movie_id = movie_data.movie_id);



/*!
By: Aziz Moalim
7.43
Give me a summary of m_link_type. The result set should contain the count of each m_link_type. 
*/
SELECT m_link_type, count(*)
FROM movie_media
GROUP BY m_link_type;



/*
By: Mahamad Osman
7.52
Give me a summary of the song count by the “theme”
*/
SELECT DISTINCT theme, COUNT(*) as 'number of songs'FROM songs GROUP BY theme DESC;



/*
By: Kim Pampusch
7.59
Give me the list of people who played “leading actor” role 
and their corresponding “screen name”
*/
SELECT `movie_people`.`screen_name`, `people`.`first_name`, `people`.`last_name` 
FROM `movie_people` INNER JOIN `people` ON (`movie_people`.`people_id` = `people`.`id`) 
WHERE LOWER(`movie_people`.`role`) = "lead actor";



/*!
By: Kimsan Heng
7.64
Given a search string, the query should search across native_name (in movies table), stage_name (in peoples table) and title (in songs table). And the query should return all the matches specifying the type of the item (movie, people, song) matched. Let us say I have given the input string as “o”, your tuples may look as follows since “o” is there in “frozen”, “tom hanks”, and “let it snow”.
*/
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



/*
By: Louis Atu Tetuh 
7.58
Give me the list of people who played “supporting actor” role 
and their corresponding “screen name"
*/
SELECT p.id, p.first_name, p.middle_name, p.last_name, mp.screen_name
FROM `people` p
INNER JOIN movie_people mp ON p.id = mp.people_id WHERE mp.role = 'supporting actor';



/*
By: Sharmarke Mohamed 
7.65
Give the list of all the movies which didn’t make any money (compare budget with box_office)
*/
SELECT movies.movie_id, movies.native_name, (movie_numbers.box_office - movie_numbers.budget) 
AS "Loss" 
FROM movie_numbers 
INNER JOIN movies 
ON movie_numbers.movie_id = movies.movie_id 
WHERE (movie_numbers.box_office - movie_numbers.budget) < 0



/*!
By: Kimsan Heng
A series of insert data that will be used to cascade delete from phpMyAdmin
*/
INSERT INTO `movies`(`movie_id`, `native_name`, `english_name`, `year_made`) 
VALUES (2000, 'JAWS' , 'JAWS' ,1990);

INSERT INTO `movie_anagrams`(`movie_id`, `anagram`) 
VALUES (2000, 'SJWA');

INSERT INTO `movie_data`(`movie_id`, `tag_line`, `language`, `country`, `genre`, `plot`) 
VALUES (2000, 'JAWS' , 'english' , 'United States', 'Thriller' , 'A shark terrorizing people on the beach');

INSERT INTO `movie_keywords`(`movie_id`, `keyword`) 
VALUES (2000, 'sharks');

INSERT INTO `movie_media`(`movie_media_id`, `m_link`, `m_link_type`, `movie_id`) 
VALUES ('', 'jaws.jpg', 'Poster', 2000);

INSERT INTO `movie_numbers`(`movie_id`, `running_time`, `length`, `strength`, `weight`, `budget`, `box_office`) 
VALUES (2000, '120', '4', '4', '4', '180', '360');

INSERT INTO `movie_quotes`(`movie_id`, `movie_quote_id`, `movie_quote_name`) 
VALUES (2000, '', 'Shark! Shark! Run!');

INSERT INTO `movie_trivia`(`movie_id`, `movie_trivia_id`, `movie_trivia`) 
VALUES (2000, '', 'Sharks are apex predators');



/*
By: Kim Pampusch
A query that creates a view called `movie_view` that contains a lot of info about each movie.
Including people and song data.
Part 1 of iteration 9
*/
CREATE VIEW `movie_view` AS SELECT
    `movies`.`movie_id`,
    `movies`.`native_name`,
    `movies`.`english_name`,
    `movies`.`year_made`,
    `movie_data`.`tag_line`,
    `movie_data`.`language`,
    `movie_data`.`country`,
    `movie_data`.`genre`,
    `movie_data`.`plot`,
    GROUP_CONCAT(
        DISTINCT `movie_trivia`.`movie_trivia`
    ) AS 'trivia',
    GROUP_CONCAT(
        DISTINCT `movie_keywords`.`keyword`
    ) AS 'keywords',
    GROUP_CONCAT(DISTINCT `movie_media`.`m_link`) AS 'media_links',
    GROUP_CONCAT(DISTINCT `songs`.`title`) AS 'songs',
    GROUP_CONCAT(
        DISTINCT CONCAT(
            `people`.`first_name`,
            ' ',
            `people`.`last_name`
        )
    ) AS 'people'
FROM
    `movies`
LEFT JOIN `movie_data` ON `movies`.`movie_id` = `movie_data`.`movie_id`
LEFT JOIN `movie_trivia` ON `movies`.`movie_id` = `movie_trivia`.`movie_id`
LEFT JOIN `movie_keywords` ON `movies`.`movie_id` = `movie_keywords`.`movie_id`
LEFT JOIN `movie_media` ON `movies`.`movie_id` = `movie_media`.`movie_id`
LEFT JOIN `movie_song` ON `movies`.`movie_id` = `movie_song`.`movie_id`
LEFT JOIN `songs` ON `movie_song`.`song_id` = `songs`.`song_id`
LEFT JOIN `movie_people` ON `movie_people`.`movie_id` = `movies`.`movie_id`
LEFT JOIN `people` ON `people`.`id` = `movie_people`.`people_id`
GROUP BY
    `movies`.`movie_id`;


