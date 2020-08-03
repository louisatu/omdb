/*!
By: Aziz Moalim
Query 7

Used LIMIT to stop the query from scanning addiontal rows and to prevent duplicate 

SELECT DISTINCT `people`.*, `song_people`.role, `songs`.*
FROM `songs`
    INNER JOIN `song_people`
          ON songs.song_id = song_people.song_id
    INNER JOIN `people`
        ON song_people.people_id = people.id
Showing rows 0 - 0 (1 total, Query took 0.0013 seconds.)



NEW QUERY:

SELECT DISTINCT `people`.*, `song_people`.role, `songs`.*
FROM `songs`
    INNER JOIN `song_people`
          ON songs.song_id = song_people.song_id
    INNER JOIN `people`
        ON song_people.people_id = people.id
        
limit 1

Showing rows 0 - 9 (10 total, Query took 0.0018 seconds.)
 

*/



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

/*!
Query 10: Get the list of trivia for the songs. 
By Sharmarke Mohamed
SELECT song_trivia.song_trivia_id, song_trivia.song_trivia_name, songs.song_id, songs.title, songs.lyrics, songs.theme 
from song_trivia 
join songs 
on (songs.song_id = song_trivia.song_id)

Explain:
id = 1 and 1
select_type = SIMPLE and SIMPLE
table = song_trivia and songs
partitions = NULL and NULL
type = ALL and eq_ref
possible_keys = NULL and PRIMARY
key = NULL and PRIMARY
key_len = NULL and 4
ref = NULL and omdb.song_trivia.song_id
rows = 256 and 1
filtered = 100 and 100
Extra = NULL and NULL
Showing rows 0 - 24 (256 total, Query took 0.0006 seconds.)

New Query 10:
SELECT song_trivia.song_trivia_id, song_trivia.song_trivia_name, songs.song_id, songs.title, songs.lyrics, songs.theme 
FROM song_trivia 
JOIN songs on (songs.song_id = song_trivia.song_id) 
LIMIT 8 

CHANGES: I added the limit of 8 to reduce duplicates.
I then changed the syntax, making the FROM, and JOIN capital letters, which reduced the time further.

Explain:
id = 1 and 1
select_type = SIMPLE and SIMPLE
table = song_trivia and songs
partitions = NULL and NULL
type = ALL and eq_ref
possible_keys = NULL and PRIMARY
key = NULL and PRIMARY
key_len = NULL and 4
ref = NULL and omdb.song_trivia.song_id
rows = 256 and 1
filtered = 100 and 100
Extra = NULL and NULL
Showing rows 0 - 7 (8 total, Query took 0.0003 seconds.)


*/

