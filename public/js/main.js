$(document).ready(() => {
    $('#create-job').on('click', () => {
        $.post('/api/job', (job) => {
            console.info(`Job#${job.id} created`)
        })
    })
    setInterval(() => {
        $.get('/api/log-messages', (res) => {
            $('#logs').text(
                res.map((msgData) => {
                    return {
                        ...msgData,
                        time: new Date(Number(msgData.time) * 1000)
                    }
                }).map((msg) =>
                    [
                        [
                            msg.time.getFullYear(),
                            (msg.time.getMonth() < 9 ? '0' : '') + (msg.time.getMonth() + 1),
                            (msg.time.getDate() < 10 ? '0' : '') + (msg.time.getDate())
                        ].join('-'),
                        [
                            (msg.time.getHours() < 10 ? '0' : '') + (msg.time.getHours()),
                            (msg.time.getMinutes() < 10 ? '0' : '') + (msg.time.getMinutes()),
                            (msg.time.getSeconds() < 10 ? '0' : '') + (msg.time.getSeconds())
                        ].join(':'),
                        msg.msg
                    ].join(' ')
                ).join("\n")
            )
            $('.info').scrollTop($('.info')[0].scrollHeight)
        })
    }, 500)
})
