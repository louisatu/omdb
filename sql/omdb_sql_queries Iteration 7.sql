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
