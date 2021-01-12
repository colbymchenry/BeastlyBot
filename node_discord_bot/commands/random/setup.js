const commando = require('discord.js-commando');
const bot = require('discord.js');

class SetupCommand extends commando.Command {

    constructor(client) {
        super(client, {
            name: 'setup_premium',
            group: 'random',
            memberName: 'setup_premium',
            description: 'Sets up the roles'
        });
    }

    async run(message, args) {
        // var role = message.guild.roles.find(x => x.name == 'Premium Callout Group');
        //
        // // only create the role if it doesn't exist
        // if(!role) {
        //     message.guild.createRole({
        //         name: 'Premium Callout Group',
        //         color: 'BLUE',
        //     }).then(role => console.log(`Created new role with name ${role.name} and color ${role.color}`)).catch(console.error);
        // }

        message.guild.members.cache.forEach((key, data) => {
           console.log(key.id)
        });

        message.reply('Server guild ID: ' + message.guild.id);
    }

}

module.exports = SetupCommand;
