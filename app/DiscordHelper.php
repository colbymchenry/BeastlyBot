<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use League\OAuth2\Client\Token\AccessToken;
use Wohali\OAuth2\Client\Provider\Discord;

class DiscordHelper
{

    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function cache(): void {
        $data = $this->getDiscordData();
        $username = $data['username'] . ' #' . $data['discriminator'];
        $avatar_url = "https://cdn.discordapp.com/avatars/" . $this->user->DiscordOAuth->discord_id . "/" . $this->getDiscordData()['avatar'] . ".png";
        $minutes_to_cache = 10;
        Cache::put('discord_username_' . $this->user->DiscordOAuth->discord_id, $username, 60 * $minutes_to_cache);
        Cache::put('discord_email_' . $this->user->DiscordOAuth->discord_id, $data['email'], 60 * $minutes_to_cache);
        Cache::put('discord_avatar_' . $this->user->DiscordOAuth->discord_id, $avatar_url, 60 * $minutes_to_cache);
    }

    public function getAvatar(): string {
        if(!Cache::has('discord_username_' . $this->user->DiscordOAuth->discord_id)) {
            $this->cache();
        }
        return Cache::get('discord_avatar_' . $this->user->DiscordOAuth->discord_id, 'https://i.imgur.com/qbVxZbJ.png');
    }

    public function getUsername(): string {
        if(!Cache::has('discord_username_' . $this->user->DiscordOAuth->discord_id)) {
            $this->cache();
        }
        return Cache::get('discord_username_' . $this->user->DiscordOAuth->discord_id);
    }

    public function getEmail(): string {
        if(!Cache::has('discord_username_' . $this->user->DiscordOAuth->discord_id)) {
            $this->cache();
        }
        return Cache::get('discord_email_' . $this->user->DiscordOAuth->discord_id);
    }

    public function getGuilds() {
        $provider = $this->getDiscordProvider();
        $token = $this->getDiscordAccessToken();
        $guildsRequest = $provider->getAuthenticatedRequest('GET', $provider->getResourceOwnerDetailsUrl($token) . '/guilds', $token);

        $guilds = $provider->getParsedResponse($guildsRequest);
        return $guilds;
    }

    public function ownsGuild($guild_id): bool {
        if(Cache::has('owner_' . $guild_id)) return Cache::get('owner_' . $guild_id, false);

        foreach($this->getGuilds() as $guild) Cache::put('owner_'. $guild_id, $guild['owner']);

        return Cache::get('owner_' . $guild_id, false);
    }

    private function getDiscordData() {
        $provider = $this->getDiscordProvider();
        $authToken = $this->getDiscordAccessToken();
        $req = $provider->getAuthenticatedRequest('GET', $provider->getResourceOwnerDetailsUrl(new AccessToken(['access_token' => $authToken])), $authToken);
        return $provider->getParsedResponse($req);
    }

      // TODO: Have to get new token or whatver it's not working properly so we are getting 401 Unauthent
    private function getDiscordAccessToken(): AccessToken {
        $token = new AccessToken(['access_token' => $this->user->DiscordOAuth->access_token, 'refresh_token' => $this->user->DiscordOAuth->refresh_token, 'expires_in' => $this->user->DiscordOAuth->token_expiration]);
        return $token;
    }

    private function getDiscordProvider(): Discord {
        return new Discord([
            'clientId' => SiteConfig::get('DISCORD_CLIENT_ID'),
            'clientSecret' => SiteConfig::get('DISCORD_SECRET'),
            'redirectUri' => SiteConfig::get('APP_URL') . SiteConfig::get('DISCORD_OAUTH_REDIRECT_URL'),
        ]);
    }

}
