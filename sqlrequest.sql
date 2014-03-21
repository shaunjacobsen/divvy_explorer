select count(trip_id) AS c, DATE_FORMAT(start_date, '%c/%d/%X') AS start_date, usertype AS u, gender AS g, SUBSTRING(start_time,1,2) AS st,
case
when age_in_2014 between 16 and 24 then '16-24'
when age_in_2014 between 25 and 34 then '25-34'
when age_in_2014 between 35 and 49 then '35-49'
when age_in_2014 between 50 and 64 then '50-64'
when age_in_2014 > 64 then '65+' else '0'
end as age,
case
when FLOOR(tripduration/60) between 0 and 5 then '0-5'
when FLOOR(tripduration/60) between 6 and 10 then '6-10'
when FLOOR(tripduration/60) between 11 and 15 then '11-15'
when FLOOR(tripduration/60) between 16 and 20 then '16-20'
when FLOOR(tripduration/60) between 21 and 25 then '21-25'
when FLOOR(tripduration/60) between 26 and 30 then '26-30'
when FLOOR(tripduration/60) between 31 and 35 then '31-35'
when FLOOR(tripduration/60) between 36 and 40 then '36-40'
when FLOOR(tripduration/60) between 41 and 45 then '41-45'
when FLOOR(tripduration/60) between 46 and 50 then '46-50'
when FLOOR(tripduration/60) between 51 and 55 then '51-55'
when FLOOR(tripduration/60) between 56 and 60 then '56-60'
when FLOOR(tripduration/60) > 60 then '60+' else '0'
end as du
FROM trips group by start_date, u, g, age, du, st