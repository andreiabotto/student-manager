require('./bootstrap');
require('sweetalert2')

if (window.location.pathname === '/') {
    require('./users/userList');
}
else {
    require('./users/userForms');
}

