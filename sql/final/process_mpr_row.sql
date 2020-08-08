
-- select the columns from mpr_test_data and assign those to variables for subsequent use in downstream SQL statements
-- For now, we will ignore the loops and hardcode the id
SET @id := 1;

SELECT @name := native_name, 
       @year := year_made,
       @stage_name := stage_name,
       @role := role,
       @screen_name := screen_name
FROM mpr_test_data 
WHERE id=@id;

-- find the count of the movies based on the selected values
SELECT @movie_count := COUNT(native_name) 
FROM movies 
WHERE native_name = @name AND 
      year_made = @year;

-- find the count of the persons based on the selected values
SELECT @person_count := COUNT(stage_name) 
FROM people 
WHERE stage_name = @stage_name;


-- we now have @movie_count and @person_count
-- based these counts, implement the corresponding test case 
-- IGNORE / INSERT / UPDATE
-- See the URL reference 4 given above

-- Update movies
INSERT INTO movies (native_name, year_made) SELECT @name, @year WHERE @movie_count = 0;

-- Update people
INSERT INTO people (stage_name) SELECT @stage_name WHERE @person_count = 0;

-- Add relation
SELECT @movie_id := movie_id FROM movies WHERE native_name = @name AND year_made = @year;
SELECT @people_id := id FROM people WHERE stage_name = @stage_name;


SELECT @relationship_count := COUNT(screen_name) 
FROM movie_people 
WHERE movie_id = @movie_id AND people_id = @people_id AND screen_name = @screen_name;

INSERT INTO movie_people (movie_id, people_id, role, screen_name) 
    SELECT @movie_id, @people_id, @role, @screen_name WHERE @relationship_count = 0;


SELECT @execution_status := 
CASE
    WHEN @movie_count=1 AND @person_count=1 AND @relationship_count=1 THEN "M, P, R Ignored, Data already exists"
    WHEN @movie_count=0 AND @person_count=0 AND @relationship_count=0 THEN "M, P, R Created"
    WHEN @movie_count=1 AND @person_count=1 AND @relationship_count=0 THEN "M, P Ignored, R Created"
    WHEN @movie_count=1 AND @person_count=0 AND @relationship_count=0 THEN "M Ignored, P and R Created"
    WHEN @movie_count=0 AND @person_count=1 AND @relationship_count=0 THEN "P Ignored, M and R Created"
    WHEN @movie_count>1 THEN "MPR Ignored, unique tuple cannot be identified"
    WHEN @person_count>1 THEN "MPR Ignored, unique tuple cannot be identified"
    ELSE "Unknown Status"
END;

UPDATE mpr_test_data SET execution_status = @execution_status WHERE id = @id;