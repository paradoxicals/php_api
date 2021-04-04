# PHP Mobil User API

It has 3 functions:

Register: Checks requests and do register the user. Also if you have a record of user, returns client token.

Purchase: Checks purchase requests with one simple Mock api then do db procedures and return the result to the user.

checkSubscription: Checks user's status and return the result to the user.

--
The other classes is related with the api structure.

mHelper : All validation processes are related to the post variables. In this way you can manage easily all validations with same functions. You dont need to write same code blocks when you need it.

database: Api db connection for all classes and functions. In this way you can manage easily db connections in one hand.

route : It can give acceptable links to your Api. You can also operate all process and callbacks with it. 
