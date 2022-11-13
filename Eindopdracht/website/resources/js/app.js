// import './bootstrap';

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
            app.$messageContentBox && app.$messageContentBox.select();
        },
        startMessageChecking() {
            actions.updateMessages()
            setInterval(actions.updateMessages, 1000)
        },
        async updateMessages() {
            const msgContainer = app.$messagesContainer
            if (!msgContainer) return

            const messageId = app.$last_message?.dataset?.id ?? 0

            // Fetch new messages
            const apiUrl = `/api${window.location.pathname}/${messageId}`;
            const result = await fetch(apiUrl)

            // Parse response and stop if no new messages
            const data = await result.text()
            if (!data) return;

            // Get if we can scroll after the update
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
        },
        async deleteMessage(guildId, messageId, token, $message) {
            const apiUrl = `/guild/${guildId}/message/${messageId}`
            await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token: token})
            })

            $message.remove()
        },
        async deleteChannel(guildId, channelId, token) {
            const apiUrl = `/guild/${guildId}/${channelId}/delete`
            await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token: token})
            })

            window.location.replace("/guild/" + guildId)
        },
        async deleteGuild(guildId, token) {
            const apiUrl = `/guild/${guildId}/delete`
            await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({_token: token})
            })

            window.location.replace("/");
        },
        handleMessageContentBoxSubmit: (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault()
                e.target.form.submit()
            }
        },
        waitForConfirm: async () => {
            await actions.popup(app.$popupConfirm)
            const {submitter} = await actions.getPromiseFromEvent(app.$popupConfirm, "submit")
            await actions.closePopup()
            return submitter.id === 'yes';

        },
        // Credit: https://stackoverflow.com/a/70789108
        getPromiseFromEvent: (item, event) => {
            return new Promise((resolve) => {
                const listener = (ev) => {
                    ev.preventDefault();
                    item.removeEventListener(event, listener);
                    resolve(ev);
                }
                item.addEventListener(event, listener);
            })
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
            this.$popupConfirm = document.querySelector('#popup #confirm')
            this.$messagesContainer = document.querySelector('#messages')
            this.$messages = document.querySelectorAll('#messages .message')
            this.$messages_id = document.querySelector('#message_id')
            this.$messageContentBox = document.querySelector('#content')
            this.$last_message = document.querySelector('#messages .message:last-child')
            this.$popupButtons = document.querySelectorAll('.popup-button')
            this.$messageDeleteButtons = document.querySelectorAll('.message__delete')
            this.$channelDeleteButtons = document.querySelectorAll('.channel__delete')
            this.$guildDeleteButton = document.querySelector('.guild__delete')
        },
        bindEvents() {
            this.$messageContentBox && this.$messageContentBox.select();
            this.$messageContentBox && this.$messageContentBox.addEventListener('keydown', actions.handleMessageContentBoxSubmit)
            this.$messagesContainer && this.$messagesContainer.addEventListener('click', actions.setReplyMessage)
            this.$popupButtons && this.$popupButtons.forEach(
                button => button.addEventListener('click', e => actions.popup(actions.getTargetWithDataset(e.target, 'name')))
            )
            this.$popup.addEventListener('click', e => e.target.id === 'popup' ? actions.closePopup() : null)
            this.$messageDeleteButtons && this.$messageDeleteButtons.forEach(
                button => button.addEventListener('click', e => {
                    e.preventDefault()
                    const messageId = actions.getTargetWithDataset(e.target.querySelector('button'), 'id').dataset.id
                    const guildId = actions.getTargetWithDataset(e.target.querySelector('button'), 'guild_id').dataset.guild_id
                    const token = e.target.querySelector('input').value
                    const $message = e.target.parentNode
                    actions.waitForConfirm().then((r) => {
                        if (r) actions.deleteMessage(guildId, messageId, token, $message)
                    })
                })
            )
            this.$channelDeleteButtons && this.$channelDeleteButtons.forEach(
                button => button.addEventListener('click', e => {
                    e.preventDefault()
                    console.log(e.target)
                    const channelId = e.target.dataset.id
                    const guildId = e.target.dataset.guild_id

                    const token = e.target.parentNode.querySelector('input').value
                    actions.waitForConfirm().then((r) => {
                        if (r) actions.deleteChannel(guildId, channelId, token)
                    })
                })
            )
            this.$guildDeleteButton && this.$guildDeleteButton.addEventListener('click', e => {
                e.preventDefault()
                const guildId = e.target.dataset.id
                const token = e.target.parentNode.querySelector('input').value
                actions.waitForConfirm().then((r) => {
                    if (r) actions.deleteGuild(guildId, token)
                })
            })
        }
    }

    app.initialize()
})()
