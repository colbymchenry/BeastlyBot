#!/usr/bin/env node
require('dotenv').config();

const commando = require('discord.js-commando');
const bot = new commando.Client();

bot.login(process.env.DISCORD_KEY);

/**
 * Called when the bot is done initializing
 */
bot.on('ready', () => {
});