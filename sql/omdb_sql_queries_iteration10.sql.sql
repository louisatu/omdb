/*!
By: Aziz Moalim
7.43
Give me a summary of m_link_type. The result set should contain the count of each m_link_type. 

1,175,493 rows
Showing rows 0 - 2 (3 total, Query took 0.8430 seconds.)

18 rows
Showing rows 0 - 2 (3 total, Query took 0.0011 seconds.)



*/

SELECT m_link_type, count(*)
FROM movie_media
GROUP BY m_link_type;

/*