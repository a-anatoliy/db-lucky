DROP function IF EXISTS `SPLIT_STR`;
CREATE FUNCTION `SPLIT_STR`
(    str VARCHAR(2000), 
     delim VARCHAR(12), 
     pos INT ) 
RETURNS varchar(255) CHARSET utf8
COMMENT 'split the inout string'
RETURN
     REPLACE(
          SUBSTRING(
               SUBSTRING_INDEX(str, delim, pos),
               CHAR_LENGTH(
                    SUBSTRING_INDEX(str, delim, pos - 1)
               ) + 1
          ),
          delim,
          ''
     );
