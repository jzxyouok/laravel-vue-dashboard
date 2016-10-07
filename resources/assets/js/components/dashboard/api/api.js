var Vue = require('vue');
var VueResource = require('vue-resource');

Vue.use(VueResource);

export function getUsers () {
    return Vue.$http.get('/api/users').then(({data}) => ({ tableData: data }))
}
