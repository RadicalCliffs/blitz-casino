const TelegramBot = require('node-telegram-bot-api');
const mysql = require('mysql');
const nodeCron = require("node-cron");
const request = require('requestify');

const bot = new TelegramBot("", {
    polling: {
        interval: 300,
        autoStart: true,
        params: {
            timeout: 10
        }
    }
})
const client = mysql.createPool({
    connectionLimit: 50,
    host: "localhost",
    user: "blitz_user",
    database: "blitz_casino",
    password: "blitz_password"
});

bot.on('message', async msg => {

    let chat_id = msg.chat.id,
        text = msg.text ? msg.text : '',
        settings = await db('SELECT * FROM settings ORDER BY id DESC');

    if(!text) return bot.sendMessage(chat_id, 'Message must not contain images / emojis / stickers');

    if(text.toLowerCase() === '/start') {
        return bot.sendMessage(chat_id, `Hello!\nTo get a bonus, you need to:\n\n1. Subscribe to our <a href="https://t.me/blitzcasino">channel</a>\n2. Enter the command shown on the site`, {
            parse_mode: "HTML"
        });
    }

    else if(text.toLowerCase().startsWith('/bind')) {
        let id = text.split("/bind ")[1] ? text.split("/bind ")[1]  : 'undefined';
        id = id.replace(/[^a-z0-9\s]/gi);
        let user = await db(`SELECT * FROM users WHERE id = '${id}'`);
        let check = await db(`SELECT * FROM users WHERE tg_id = ${chat_id}`);
        let subs = await bot.getChatMember('@blitzcasino', chat_id).catch((err) => {});

        if (!subs || subs.status == 'left' || subs.status == undefined) {
            return bot.sendMessage(chat_id, `You have not subscribed to the <a href="https://t.me/blitzcasino">channel</a>`, {
                parse_mode: "HTML",
                disable_web_page_preview: true
            });
        }
        if(user.length < 1) return bot.sendMessage(chat_id, 'User not found', {
            parse_mode: "HTML"
        });
        if(check.length >= 1) return bot.sendMessage(chat_id, 'This Telegram account is already linked');
        if(user[0].bonus_2 == 1) return bot.sendMessage(chat_id, 'The user has already received the reward');
        console.log(user);

        await db(`UPDATE users SET tg_id = ${chat_id}, bonus_2 = 2 WHERE id = '${id}'`);

        return bot.sendMessage(chat_id, `Thank you for subscribing, ${user[0].name}!\n\nNow you can claim your bonus on the site.`);
    }

    return bot.sendMessage(chat_id, 'Unknown command', {
        reply_to_message_id: msg.message_id
    });
});

nodeCron.schedule('0 13 * * *', async () => {
    setTimeout(async () => {
        console.log(`[APP] Promo codes sent`);
    }, 10 * 1000);
});

nodeCron.schedule('0 18 * * *', async () => {
    setTimeout(async () => {
        console.log(`[APP] Promo codes sent`);
    }, 10 * 1000);
});

nodeCron.schedule('0 21 * * *', async () => {
    setTimeout(async () => {
        console.log(`[APP] Promo codes sent`);
    }, 10 * 1000);
});

function makeIdentify(length) {
    var result = "";
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function db(databaseQuery) {
    return new Promise(data => {
        client.query(databaseQuery, function (error, result) {
            if (error) {
                console.log(error);
                throw error;
            }
            try {
                data(result);

            } catch (error) {
                data({});
                throw error;
            }

        });

    });
    client.end()
}
