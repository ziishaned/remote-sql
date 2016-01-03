---------------------Show Query---------------------------
SHOW TABLES; 

--------------------SELECT Queries----------------------------------------
SELECT * FROM city;
SELECT * FROM country;
SELECT * FROM countryLanguage;
--------------------------------------------------------------------------

----------------------WHERE QUERIES---------------------------------------
SELECT * FROM city WHERE district = 'Santiago';
-- WHERE with OR
SELECT * FROM city WHERE district = 'Santiago' OR district = 'California';
-- Where with AND
SELECT * FROM city WHERE name = 'San Bernardo' AND CountryCode = 'CHL';
---------------------------------------------------------------------------

---------------------Greater OR Less Than----------------------------------
-- SQL accepts various inequality symbols, including: 
	#	= "equal to"
	#	> "greater than"
	#	< "less than"
	#	>= "greater than or equal to"
	#	<= "less than or equal to"

SELECT id, Name AS counrt, district AS dis FROM city WHERE population > 240000;
SELECT id, Name AS counrt, countrycode AS code FROM city WHERE population < 240000;

------------------------------------------------------------------------------

------------------------------IN CLAUSE---------------------------------------
SELECT Name, Region, population FROM country WHERE continent IN ('asia', 'africa');
------------------------------------------------------------------------------

-------------------------------DISTINCT---------------------------------------
SELECT DISTINCT name, region FROM country;
------------------------------------------------------------------------------

-------------------------------Order By---------------------------------------
SELECT * FROM countrylanguage ORDER BY language;
------------------------------------------------------------------------------


