if (typeof(document.querySelectorAll('.icon-profile a')[0].getAttribute('href')) !== \"undefined\") {
var chat_id = document.querySelectorAll('.icon-profile a')[0].getAttribute('href');
var chat_name = document.querySelectorAll('.header-profile span')[0].innerText;
var chat_link = typeof jqcc('.icon-profile a')[0].getAttribute('href') === 'undefined'?'':document.querySelectorAll('.icon-profile a')[0].getAttribute('href'); var chat_avatar = typeof document.querySelectorAll('.header-profile img')[0].getAttribute('src') === 'undefined'?'':document.querySelectorAll('.header-profile img')[0].getAttribute('src'); } 

(function() {
    var chat_css = document.createElement('link'); chat_css.rel = 'stylesheet'; chat_css.type = 'text/css'; chat_css.href = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.css';
    document.getElementsByTagName(\"head\")[0].appendChild(chat_css);
    var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.js'; var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
})();