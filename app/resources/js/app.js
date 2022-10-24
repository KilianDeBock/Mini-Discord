import './bootstrap';

(() => {
    const actions = {
        getTargetWithDataset(target, dataset) {
            try {
                return target.dataset[dataset] ? target : actions.getTargetWithDataset(target.parentElement, dataset)
            } catch (e) {
                return target
            }
        },
        scrollToEnd() {
            app.$messagesContainer
                ? app.$messagesContainer.scrollTop = app.$messagesContainer.scrollHeight
                : null
        },
        setReplyMessage(e) {
            // Get the message id
            const target = actions.getTargetWithDataset(e.target, 'id')

            // if the target has reply attribute unreply it
            if (target.classList.contains('reply')) {
                // remove the reply attribute
                target.classList.remove('reply')
                // remove the reply message to form
                app.$messages_id.value = 0
                return
            }

            // Remove the reply class from all the messages
            app.$messages.forEach(message => message.classList.remove('reply'))

            // Add the reply class to the target
            target.classList.add('reply')

            // Set the messages_id input value to the target id
            app.$messages_id.value = target.dataset.id
        },
        startMessageChecking() {
            actions.updateMessages()
            setInterval(actions.updateMessages, 1000)
        },
        async updateMessages() {
            if (!app.$last_message) return;
            // Fetch new messages
            const apiUrl = `/api${window.location.pathname}/${app.$last_message.dataset.id}`;
            const result = await fetch(apiUrl)

            // Parse response and stop if no new messages
            const data = await result.text()
            if (!data) return;

            // Get if we can scroll after the update
            const msgContainer = app.$messagesContainer
            const canScroll = msgContainer.scrollHeight - msgContainer.clientHeight - msgContainer.scrollTop < 10

            // Update the messages
            app.$messagesContainer.insertAdjacentHTML('beforeend', data)
            app.$last_message = document.querySelector('#messages .message:last-child');

            // Scroll to the end if we could before the update
            if (canScroll) actions.scrollToEnd()
        },
        async popup(target) {
            console.log(target.dataset.name)
            console.log(`#popup .${target.dataset.name}`)
            const popup = document.querySelector(`#popup .${target.dataset.name}`)
            console.log(popup)
            popup && popup.classList.add('active')
            app.$popup.classList.add('active')
        },
        async closePopup() {
            app.$popup.classList.remove('active')
            app.$popups.forEach(popup => popup.classList.remove('active'))
        }
    }

    const app = {
        initialize() {
            console.log('App initializing...');
            this.cacheElements()
            this.bindEvents()
            actions.scrollToEnd()
            actions.startMessageChecking()
            console.log('App initialized!');
        },
        cacheElements() {
            this.$popup = document.querySelector('#popup')
            this.$popups = document.querySelectorAll('#popup .popup')
            this.$messagesContainer = document.querySelector('#messages')
            this.$messages = document.querySelectorAll('#messages .message')
            this.$messages_id = document.querySelector('#message_id')
            this.$last_message = document.querySelector('#messages .message:last-child')
            this.$popupButtons = document.querySelectorAll('.popup-button')
        },
        bindEvents() {
            this.$messagesContainer && this.$messagesContainer.addEventListener('click', actions.setReplyMessage)
            this.$popupButtons && this.$popupButtons.forEach(
                button => button.addEventListener('click', e => actions.popup(actions.getTargetWithDataset(e.target, 'name')))
            )
            this.$popup.addEventListener('click', e => e.target.id === 'popup' ? actions.closePopup() : null)
        }
    }

    app.initialize()
})()
