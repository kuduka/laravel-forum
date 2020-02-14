let user = window.App.user;

module.exports = {
    owns (model, prop = 'user_id') {
    	res = model[prop] === user.id;
    	console.log(model[prop], user.id)
        return res;
    }
};