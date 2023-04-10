const notifications = () => {
    window.Echo.private('events')
        .listen('Test', (e) => {
            console.log('Test Event: ' + e.message)
        });

    window.Echo.private('App.Models.User.1')
        .notification((notification) => {
            const notifEl = document.createElement('div');
            notifEl.className = "p-5 hover:bg-primary hover:bg-opacity-5";

            const title = document.createElement('h6');
            title.className = "uppercase";
            title.appendChild(document.createTextNode('Broadcasted'));

            const message = document.createElement('p');
            message.appendChild(document.createTextNode(notification.message));

            const time = document.createElement('span');
            time.appendChild(document.createTextNode('Today'));

            notifEl.appendChild(title);
            notifEl.appendChild(message);
            notifEl.appendChild(time);

            document.getElementById('notification-list').insertBefore(notifEl, document.getElementById('notification-list').firstChild);
            document.getElementById('notification-count').innerHTML = parseInt(document.getElementById('notification-count').innerHTML) + 1;
        });

    document.getElementById('test-notif').addEventListener('click', (e) => {
        e.preventDefault();

        window.axios.get('/settings/notifications/broadcast')
            .catch(error => {
                console.log(error);
            })
    })
}

export default notifications;
