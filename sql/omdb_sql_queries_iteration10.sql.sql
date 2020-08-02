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