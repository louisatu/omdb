

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


