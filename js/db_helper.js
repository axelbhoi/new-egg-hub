var mysql = require('mysql');

var client = mysql.createConnection({
	user: "root",
	password: "axelbhoi",
	database: "egghub"
});


exports.add_message = function(data, callback) {
	 client.query("insert into e_chat_table (user_email, chat_message_content, created_date) values (?,?,?)", [data.session, data.message,data.dates], function(err, info) {
		// callback function returns last insert id
		callback(info.insertId);
		console.log('name '+data.name+' message '+data.message); 
	  });
}