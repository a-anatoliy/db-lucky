DROP procedure IF EXISTS `getDressByID`;

DELIMITER $$

create procedure getDressByID(IN lid int, IN ids varchar(255))

BEGIN
	declare p int;
   	declare c int;

	SET @c = 1;

	WHILE @c<4 DO

		SELECT SPLIT_STR(ids, '|', @c) into @p;
		
		SELECT  d.id, 
				UCASE(d.title) as title,
				LOWER(d.url_name) as url_name,
				ld.description, ld.short_descr, ld.product_details, ld.care_advices,
				ldc.name as collection, d.price, ldcurr.name as currency,
				d.like_count,d.offer_price,d.discount_price,d.price_offer_end_date,d.order_count,d.view_count,d.add_date
			FROM ld_dresses d
			JOIN ld_descriptions ld ON d.id = @p AND d.id = ld.dress_id AND ld.lang_id = lid
			JOIN ld_collection_map lcm ON d.id = lcm.dress_id
			JOIN ld_collection ldc     ON lcm.collection_id = ldc.id
			JOIN ld_currency_map lcm2  ON d.id = lcm2.dress_id
			JOIN ld_currency ldcurr    ON lcm2.currency_id = ldcurr.id;

		SET @c:=@c+1;        
	END WHILE;
END$$

DELIMITER ;

call getDressByID(1,"1|2|2");

