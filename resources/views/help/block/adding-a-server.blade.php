
          <li class="timeline-period bg-purple-600 text-white">Add a Server</li>
          <li class="timeline-item">
            <div class="timeline-dot bg-purple-500">
              <i class="icon icon-shop" aria-hidden="true" id="step1-icon-shop"></i>
            </div>
            <div class="timeline-info pr-15">
              Go to <button type="button" class="btn btn-dark btn-link ml-10" onclick="location.href = '/servers#guide-ultimate=true'"><i class="icon icon-shop"></i> Servers</button>
            </div>
            <div class="timeline-content">
              <div class="card card-article card-shadow">
              </div>
            </div>
          </li>

          <li class="timeline-item timeline-reverse">
            <div class="timeline-dot bg-purple-500 add-pulse">
              <i class="icon wb-chevron-right-mini" aria-hidden="true"></i>
            </div>
            <div class="timeline-info pr-10 mb-0">
                <time datetime="2017-05-15">
                    Click <a class="btn btn-sm btn-primary btn-round ml-10" href="{{ 'https://discordapp.com/oauth2/authorize?client_id=' . env('DISCORD_CLIENT_ID') . '&scope=bot&permissions=' . env('DISCORD_BOT_PERMISSIONS') }}" target="_blank">
                    <i class="icon wb-plus" aria-hidden="true"></i>
                    Add Bot
                    </a>
                </time>
            </div>
            <div class="timeline-content">
              <div class="card card-article card-shadow">
                <div class="card-block pt-10 pr-20 pl-10">
                  <p>This will redirect you to discord, add Beastly Bot to your server.</p>                
                </div>
              </div>
            </div>
          </li>

          <li class="timeline-item mb-0">
            <div class="timeline-dot bg-purple-500">
              <i class="icon wb-chevron-left-mini" aria-hidden="true"></i>
            </div>
            <div class="timeline-info pl-10 mb-0">
                <time datetime="2017-05-15">
                    <button type="button" class="btn btn-sm btn-primary btn-round mr-10" onclick="location.href = '/servers?click-first=true#guide-ultimate=true'">
                    <i class="icon wb-refresh" aria-hidden="true"></i> Refresh
                </button> the List
                </time>
            </div>
            <div class="timeline-content">
              <div class="card card-article card-shadow">
                <div class="card-block pt-10 pl-20">
                  <p>Your server will appear on the servers page. You can now start building your shop.</p>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-period">Success! Server Added</li>