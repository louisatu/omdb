

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