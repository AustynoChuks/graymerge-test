"# graymerge-test" 

"#Get the details of a particular product given its id"
GET "api.php?product_id=[product_id]"
(i.e GET https://nameless-gorge-99473.herokuapp.com/api.php?product_id=1)


"#List all Products"
GET products.php
(i.e GET https://nameless-gorge-99473.herokuapp.com/products.php)


"#Add an item to Cart"
POST api.php parameters add=[product_id]
(i.e POST https://nameless-gorge-99473.herokuapp.com/api.php?add=1)


"#Get the total items in a cart including sum-total amount"
GET api.php parameter get_price=true
(i.e (i.e https://nameless-gorge-99473.herokuapp.com/api.php?get_price=true))
