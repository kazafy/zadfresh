Schedule
Returns student schedule as json

URL
	http://ec2-52-14-112-185.us-east-2.compute.amazonaws.com/api/schedule
	
Method:
POST
	
URL 	Params	
	None
	
Data 	Params
		 start_date=[date(‘Y-m-d’)]
	 	days_per_week= [[array(integer)]
		chapter_sessions=[integer]
	
Example:  {"start_date": 	"2017-09-30",
      "Days_per_week":[0,2,4],
      "Chapter_sessions":5          }
	
Success  Response:	
		
Code: 200 
Content: { 		
“sessions”:[“01-10-2017”,”04-10-2017” 		, …… ] }
		
Error 	Response:	
		
Code: 400  Bad Request
Content: {
"days_per_week.*":["The days_per_week.* may not be greater	   than 6 ."]}
	
	
	OR
			
Code: 400 Bad Request
Content: {"days_per_week.*":["The days_per_week.* may not be greater than 6 ."]}
	
	OR

		Code: 400 Bad Request
		Content: {"start_date":["The start date field is required."]}

	OR
		
		Code: 400 Bad Request
		Content: {"start_date":["The start date must be a date after or equal to now."]}

	OR
		Code: 400 Bad Request
		Content: {"start_date":["The start date must be a date after or equal to now."],"days_per_week":["The days per week field is required."]}

	OR
		Code: 400 Bad Request
		Content: {"start_date":["The start date must be a date after or equal to now."],"chapter_sessions":["The chapter sessions field is required."]}

	OR
		Code: 400 Bad Request
		Content: {"chapter_sessions":["The chapter sessions field is required."]}

