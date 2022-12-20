select * from user where IDuser in 
	(select * from user_item_rating where rating = 5 and IDuser in 
		(select * from user_item_rating where rating = 4 and IDuser in
			(select * from user_item_rating where rating = 3 and IDuser in 
				(select * from user_item_rating where rating = 2 and IDuser in 
					(select * from user_item_rating where rating = 1)
				)
			 )
		 )
	 ) limit 100