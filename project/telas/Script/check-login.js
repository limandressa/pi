async function checkLogin() {
var x = await fetch('../api/login-verifica.php')
var y = await x.json()
    if (!y) window.location.href = 'login-correto.html'
}
checkLogin();