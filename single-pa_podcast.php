<?php
/**
 * Single Podcast — Persian Atheists
 * با audio player زیبا + playlist
 */
get_header();

$lang    = pa_current_lang();
$is_en   = ($lang === 'en');
$post_id = get_queried_object_id();
$post    = get_post($post_id);

if (!$post) { get_footer(); exit; }

$ep_num  = get_post_meta($post_id, 'pa_episode_number', true);
$dur     = get_post_meta($post_id, 'pa_duration', true);
$audio   = get_post_meta($post_id, 'pa_audio_url', true);
$spotify = get_post_meta($post_id, 'pa_spotify_url', true);
$anchor  = get_post_meta($post_id, 'pa_anchor_url', true);
$embed   = get_post_meta($post_id, 'pa_embed_code', true);
$content = get_the_content(null, false, $post_id);
$author  = get_the_author_meta('display_name', $post->post_author);

// همه پادکست‌ها برای playlist
$all_pods = new WP_Query([
    'post_type'      => 'pa_podcast',
    'posts_per_page' => 50,
    'post_status'    => 'publish',
    'orderby'        => 'meta_value_num',
    'meta_key'       => 'pa_episode_number',
    'order'          => 'ASC',
]);
$playlist = [];
if ($all_pods->have_posts()) {
    while ($all_pods->have_posts()) {
        $all_pods->the_post();
        $pid = get_the_ID();
        $playlist[] = [
            'id'      => $pid,
            'title'   => get_the_title(),
            'ep'      => get_post_meta($pid, 'pa_episode_number', true),
            'dur'     => get_post_meta($pid, 'pa_duration', true),
            'audio'   => get_post_meta($pid, 'pa_audio_url', true),
            'url'     => get_permalink($pid),
            'thumb'   => has_post_thumbnail($pid) ? get_the_post_thumbnail_url($pid, 'pa-square') : '',
            'current' => ($pid === $post_id),
        ];
    }
    wp_reset_postdata();
}

$thumb_url = has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id, 'pa-square') : '';
?>
<style>
/* ══ PODCAST PAGE ══ */
.pp-wrap {
    max-width: 860px;
    margin: 0 auto;
    padding: 28px 20px 60px;
    box-sizing: border-box;
}

.pp-bread {
    display: flex;
    gap: 6px;
    align-items: center;
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.pp-bread a { color: var(--muted); text-decoration: none; }
.pp-bread a:hover { color: var(--accent); }

/* ══ AUDIO PLAYER — همیشه LTR, هرگز تغییر نمی‌کنه ══ */
.pa-podcast-player {
    background: #1a1f2e;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    direction: ltr !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif !important;
}

/* Top — cover + info با blur background */
.pa-pod-top {
    position: relative;
    overflow: hidden;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    min-height: 90px;
}

.pa-pod-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    filter: blur(24px) brightness(0.35) saturate(1.5);
    transform: scale(1.15);
    z-index: 0;
}

/* overlay تیره */
.pa-pod-top::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(20,25,40,0.55);
    z-index: 0;
}

.pa-pod-cover {
    width: 68px;
    height: 68px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
    box-shadow: 0 4px 16px rgba(0,0,0,0.5);
}
.pa-pod-cover img { width: 100%; height: 100%; object-fit: cover; display: block; }
.pa-pod-cover-ph {
    width: 100%; height: 100%;
    background: rgba(212,160,23,0.25);
    display: flex; align-items: center; justify-content: center;
    font-size: 28px;
}

.pa-pod-header-info {
    flex: 1;
    min-width: 0;
    position: relative;
    z-index: 1;
}
.pa-pod-ep-badge {
    font-size: 11px;
    font-weight: 700;
    color: #D4A017;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 4px;
}
.pa-pod-htitle {
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 3px;
    line-height: 1.3;
}
.pa-pod-hauthor {
    font-size: 12px;
    color: rgba(255,255,255,0.5);
}

/* Progress */
.pa-pod-prog-section {
    padding: 6px 20px 2px;
    background: #1a1f2e;
    direction: ltr;
}
.pa-pod-times {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: rgba(255,255,255,0.4);
    font-family: 'SF Mono', 'Fira Code', monospace;
    margin-bottom: 6px;
}
.pa-pod-progress {
    height: 4px;
    background: rgba(255,255,255,0.12);
    border-radius: 4px;
    cursor: pointer;
    position: relative;
    transition: height .15s;
}
.pa-pod-progress:hover { height: 7px; }
.pa-pod-pbar {
    height: 100%;
    background: #D4A017;
    border-radius: 4px;
    width: 0%;
    position: relative;
    pointer-events: none;
    transition: width .1s linear;
}
.pa-pod-pbar::after {
    content: '';
    position: absolute;
    right: -6px;
    top: 50%;
    transform: translateY(-50%);
    width: 13px;
    height: 13px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
    opacity: 0;
    transition: opacity .15s;
}
.pa-pod-progress:hover .pa-pod-pbar::after { opacity: 1; }

/* Controls */
.pa-pod-ctrl {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px 16px;
    background: #1a1f2e;
    direction: ltr;
}
.pa-pod-ctrl-group { display: flex; align-items: center; gap: 4px; }

.pa-pod-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(255,255,255,0.6);
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
    padding: 0;
    font-family: inherit;
    flex-shrink: 0;
}
.pa-pod-btn:hover { color: #fff; background: rgba(255,255,255,0.09); }

/* Skip wrapper */
.pa-skip-wrap {
    position: relative;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.pa-skip-label {
    position: absolute;
    top: 52%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 7.5px;
    font-weight: 800;
    color: rgba(255,255,255,0.6);
    pointer-events: none;
    line-height: 1;
    font-family: inherit;
}

/* Play button */
.pa-pod-play {
    width: 54px !important;
    height: 54px !important;
    background: #D4A017 !important;
    color: #fff !important;
    border-radius: 50% !important;
    box-shadow: 0 3px 16px rgba(212,160,23,0.4);
    transition: all .2s !important;
}
.pa-pod-play:hover {
    background: #b8870e !important;
    transform: scale(1.07);
    box-shadow: 0 4px 20px rgba(212,160,23,0.55) !important;
}

/* Speed */
.pa-pod-spd {
    font-size: 12px !important;
    font-weight: 700 !important;
    width: auto !important;
    padding: 0 10px !important;
    border-radius: 6px !important;
    background: rgba(255,255,255,0.09) !important;
    color: rgba(255,255,255,0.65) !important;
    height: 30px !important;
    letter-spacing: .3px;
    border-radius: 6px !important;
}
.pa-pod-spd:hover { background: rgba(255,255,255,0.18) !important; color: #fff !important; }

/* Volume */
.pa-pod-vol-wrap {
    width: 64px;
    height: 4px;
    background: rgba(255,255,255,0.12);
    border-radius: 4px;
    cursor: pointer;
    position: relative;
}
.pa-pod-vol-bar {
    height: 100%;
    width: 80%;
    background: rgba(255,255,255,0.45);
    border-radius: 4px;
    pointer-events: none;
    transition: width .1s;
}

/* ══ PLAYLIST ══ */
.pa-pod-playlist {
    background: #13182280;
    border-top: 1px solid rgba(255,255,255,0.06);
    display: none;
    max-height: 320px;
    overflow-y: auto;
    direction: ltr !important;
    backdrop-filter: blur(10px);
}
.pa-pod-playlist.open { display: block; }
.pa-pod-playlist::-webkit-scrollbar { width: 3px; }
.pa-pod-playlist::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }

.pa-pl-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 18px;
    cursor: pointer;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    text-decoration: none;
    transition: background .15s;
}
.pa-pl-item:hover { background: rgba(255,255,255,0.05); }
.pa-pl-item.active {
    background: rgba(212,160,23,0.1);
    border-left: 3px solid #D4A017;
    padding-left: 15px;
}

.pa-pl-num {
    width: 22px;
    font-size: 11px;
    color: rgba(255,255,255,0.3);
    text-align: center;
    flex-shrink: 0;
    font-family: monospace;
}
.pa-pl-item.active .pa-pl-num { color: #D4A017; }

.pa-pl-thumb {
    width: 46px;
    height: 46px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
    background: rgba(255,255,255,0.07);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}
.pa-pl-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }

.pa-pl-info { flex: 1; min-width: 0; }
.pa-pl-title {
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.8);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 2px;
    line-height: 1.3;
}
.pa-pl-item.active .pa-pl-title { color: #fff; font-weight: 700; }
.pa-pl-dur { font-size: 11px; color: rgba(255,255,255,0.3); font-family: monospace; }

/* playing bars animation */
.pa-pl-bars {
    display: none;
    gap: 2px;
    align-items: flex-end;
    height: 16px;
    flex-shrink: 0;
}
.pa-pl-item.active .pa-pl-bars { display: flex; }
.pa-pl-bar {
    width: 3px;
    border-radius: 2px;
    background: #D4A017;
    animation: paBarAnim .8s ease infinite alternate;
}
.pa-pl-bar:nth-child(1) { height: 6px; animation-delay: 0s; }
.pa-pl-bar:nth-child(2) { height: 10px; animation-delay: .2s; }
.pa-pl-bar:nth-child(3) { height: 7px; animation-delay: .1s; }
@keyframes paBarAnim {
    from { transform: scaleY(.35); }
    to   { transform: scaleY(1); }
}

/* ══ REST ══ */
.pp-embed-wrap { border-radius:12px; overflow:hidden; margin-bottom:20px; }
.pp-embed-wrap iframe { display:block; }

.pp-listen { background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:16px 20px; margin-bottom:20px; }
.pp-listen-label { font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-bottom:10px; }
.pp-listen-btns { display:flex; gap:8px; flex-wrap:wrap; }
.pp-lbtn { display:inline-flex; align-items:center; gap:6px; padding:8px 14px; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none; }
.pp-lbtn-spotify { background:#1DB954; color:#fff; }
.pp-lbtn-anchor  { background:#222; color:#fff; }
.pp-lbtn-tg      { background:#0088cc; color:#fff; }

.pp-content { background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:22px; margin-bottom:28px; }
.pp-content-title { font-size:16px; font-weight:800; color:var(--text); margin-bottom:12px; }
.pp-content-body { font-size:15px; line-height:1.8; color:var(--muted); }

.pp-no-audio {
    text-align:center; padding:30px 20px;
    background:#1a1f2e; border-radius:16px; margin-bottom:20px;
    direction:ltr;
}
.pp-no-audio .ni { font-size:44px; margin-bottom:10px; }
.pp-no-audio p { color:rgba(255,255,255,0.5); font-size:14px; }

@media(max-width:600px){
    .pp-wrap { padding:16px 14px 40px; }
    .pa-pod-play { width:46px!important; height:46px!important; }
    .pa-pod-vol-wrap { display:none!important; }
}
</style>

<main class="site-main">
<div class="pp-wrap">

    <!-- Breadcrumb -->
    <nav class="pp-bread">
        <?php if ($is_en): ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span style="opacity:.4">›</span>
            <a href="<?php echo esc_url(home_url('/podcasts')); ?>">Podcasts</a>
            <?php if($ep_num): ?><span style="opacity:.4">›</span><span>Ep. <?php echo esc_html($ep_num); ?></span><?php endif; ?>
        <?php else: ?>
            <?php if($ep_num): ?><span>اپیزود <?php echo esc_html($ep_num); ?></span><span style="opacity:.4">‹</span><?php endif; ?>
            <a href="<?php echo esc_url(home_url('/podcasts')); ?>">پادکست‌ها</a>
            <span style="opacity:.4">‹</span>
            <a href="<?php echo esc_url(home_url('/')); ?>">خانه</a>
        <?php endif; ?>
    </nav>

    <?php if ($embed): ?>
    <!-- Embed -->
    <div class="pp-embed-wrap">
        <?php echo wp_kses($embed, ['iframe'=>['src'=>[],'width'=>[],'height'=>[],'frameborder'=>[],'allowtransparency'=>[],'allow'=>[],'style'=>[],'class'=>[],'title'=>[],'loading'=>[]]]); ?>
    </div>

    <?php elseif ($audio): ?>
    <!-- Custom Player -->
    <div class="pa-podcast-player" id="paPP">

        <!-- Top -->
        <div class="pa-pod-top">
            <?php if ($thumb_url): ?>
                <div class="pa-pod-bg" style="background-image:url('<?php echo esc_url($thumb_url); ?>')"></div>
            <?php endif; ?>
            <div class="pa-pod-cover">
                <?php if ($thumb_url): ?>
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="" id="paPPCoverImg">
                <?php else: ?>
                    <div class="pa-pod-cover-ph" id="paPPCoverPh">🎙️</div>
                <?php endif; ?>
            </div>
            <div class="pa-pod-header-info">
                <?php if($ep_num): ?><div class="pa-pod-ep-badge" id="paPPEp">Ep. <?php echo esc_html($ep_num); ?></div><?php endif; ?>
                <div class="pa-pod-htitle" id="paPPTitle"><?php echo esc_html(get_the_title($post_id)); ?></div>
                <div class="pa-pod-hauthor"><?php echo esc_html($author); ?></div>
            </div>
        </div>

        <!-- Progress -->
        <div class="pa-pod-prog-section">
            <div class="pa-pod-times">
                <span id="paPPCur">0:00</span>
                <span id="paPPDur">--:--</span>
            </div>
            <div class="pa-pod-progress" id="paPPProg">
                <div class="pa-pod-pbar" id="paPPBar"></div>
            </div>
        </div>

        <!-- Controls -->
        <div class="pa-pod-ctrl">
            <!-- Speed -->
            <div class="pa-pod-ctrl-group">
                <button class="pa-pod-btn pa-pod-spd" id="paPPSpd">1×</button>
            </div>

            <!-- Main controls: rew / play / fwd -->
            <div class="pa-pod-ctrl-group" style="gap:6px;">
                <!-- Rewind 15 -->
                <button class="pa-pod-btn" id="paPPRew" title="15s back" style="width:40px;height:40px;">
                    <div class="pa-skip-wrap">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.06"/>
                        </svg>
                        <span class="pa-skip-label">15</span>
                    </div>
                </button>

                <!-- Play / Pause -->
                <button class="pa-pod-btn pa-pod-play" id="paPPPlay">
                    <svg id="paPPPI" viewBox="0 0 24 24" fill="currentColor" width="22" height="22"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                    <svg id="paPPPaI" viewBox="0 0 24 24" fill="currentColor" width="22" height="22" style="display:none"><rect x="6" y="4" width="4" height="16" rx="1"/><rect x="14" y="4" width="4" height="16" rx="1"/></svg>
                </button>

                <!-- Forward 15 -->
                <button class="pa-pod-btn" id="paPPFwd" title="15s forward" style="width:40px;height:40px;">
                    <div class="pa-skip-wrap">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-.49-3.06"/>
                        </svg>
                        <span class="pa-skip-label">15</span>
                    </div>
                </button>
            </div>

            <!-- Volume + Playlist -->
            <div class="pa-pod-ctrl-group" style="gap:6px;">
                <button class="pa-pod-btn" id="paPPMute" style="width:30px;height:30px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="17" height="17">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
                    </svg>
                </button>
                <div class="pa-pod-vol-wrap" id="paPPVol">
                    <div class="pa-pod-vol-bar" id="paPPVolB" style="width:80%"></div>
                </div>
                <?php if (count($playlist) > 1): ?>
                <button class="pa-pod-btn" id="paPPList" title="Playlist" style="width:34px;height:34px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="17" height="17">
                        <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/>
                        <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                        <line x1="3" y1="18" x2="3.01" y2="18"/>
                    </svg>
                </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Playlist -->
        <?php if (count($playlist) > 1): ?>
        <div class="pa-pod-playlist" id="paPPPlaylist">
            <?php foreach ($playlist as $idx => $ep): ?>
            <a href="<?php echo esc_url($ep['url']); ?>"
               class="pa-pl-item <?php echo $ep['current'] ? 'active' : ''; ?>"
               data-audio="<?php echo esc_attr($ep['audio']); ?>"
               data-title="<?php echo esc_attr($ep['title']); ?>"
               data-ep="<?php echo esc_attr($ep['ep']); ?>"
               data-thumb="<?php echo esc_attr($ep['thumb']); ?>"
               data-url="<?php echo esc_attr($ep['url']); ?>">
                <div class="pa-pl-num"><?php echo esc_html($ep['ep'] ?: ($idx+1)); ?></div>
                <div class="pa-pl-thumb">
                    <?php if ($ep['thumb']): ?>
                        <img src="<?php echo esc_url($ep['thumb']); ?>" alt="" loading="lazy">
                    <?php else: ?>
                        🎙️
                    <?php endif; ?>
                </div>
                <div class="pa-pl-info">
                    <div class="pa-pl-title"><?php echo esc_html($ep['title']); ?></div>
                    <div class="pa-pl-dur"><?php echo esc_html($ep['dur'] ?: ''); ?></div>
                </div>
                <div class="pa-pl-bars">
                    <div class="pa-pl-bar"></div>
                    <div class="pa-pl-bar"></div>
                    <div class="pa-pl-bar"></div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div><!-- /pa-podcast-player -->

    <audio id="paPPAudio" preload="metadata">
        <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
    </audio>

    <script>
    (function(){
        var audio = document.getElementById('paPPAudio');
        var playBtn = document.getElementById('paPPPlay');
        var playI   = document.getElementById('paPPPI');
        var pauseI  = document.getElementById('paPPPaI');
        var prog    = document.getElementById('paPPProg');
        var bar     = document.getElementById('paPPBar');
        var curEl   = document.getElementById('paPPCur');
        var durEl   = document.getElementById('paPPDur');
        var rewBtn  = document.getElementById('paPPRew');
        var fwdBtn  = document.getElementById('paPPFwd');
        var spdBtn  = document.getElementById('paPPSpd');
        var muteBtn = document.getElementById('paPPMute');
        var volWrap = document.getElementById('paPPVol');
        var volBar  = document.getElementById('paPPVolB');
        var listBtn = document.getElementById('paPPList');
        var listEl  = document.getElementById('paPPPlaylist');

        var speeds = [1,1.25,1.5,1.75,2], si=0;
        audio.volume = 0.8;

        function fmt(s){
            if(!s||isNaN(s))return'--:--';
            s=Math.floor(s);
            var m=Math.floor(s/60),sec=s%60;
            return m+':'+(sec<10?'0':'')+sec;
        }

        // Play / Pause
        playBtn.onclick = function(){
            if(audio.paused) audio.play(); else audio.pause();
        };
        audio.onplay  = function(){ playI.style.display='none'; pauseI.style.display=''; };
        audio.onpause = function(){ playI.style.display=''; pauseI.style.display='none'; };

        // Time
        audio.ontimeupdate = function(){
            if(!audio.duration)return;
            bar.style.width=(audio.currentTime/audio.duration*100)+'%';
            curEl.textContent=fmt(audio.currentTime);
        };
        audio.onloadedmetadata = function(){ durEl.textContent=fmt(audio.duration); };

        // Auto next
        audio.onended = function(){
            var items=document.querySelectorAll('.pa-pl-item');
            for(var i=0;i<items.length;i++){
                if(items[i].classList.contains('active')&&i+1<items.length){
                    loadEp(items[i+1]); break;
                }
            }
        };

        // Seek
        prog.onclick=function(e){
            var r=prog.getBoundingClientRect();
            if(audio.duration) audio.currentTime=((e.clientX-r.left)/r.width)*audio.duration;
        };

        // Skip
        rewBtn.onclick=function(){audio.currentTime=Math.max(0,audio.currentTime-15);};
        fwdBtn.onclick=function(){audio.currentTime=Math.min(audio.duration||0,audio.currentTime+15);};

        // Speed
        spdBtn.onclick=function(){
            si=(si+1)%speeds.length;
            audio.playbackRate=speeds[si];
            spdBtn.textContent=speeds[si]+'×';
        };

        // Volume
        if(volWrap){
            volWrap.onclick=function(e){
                var r=volWrap.getBoundingClientRect();
                var v=Math.max(0,Math.min(1,(e.clientX-r.left)/r.width));
                audio.volume=v; audio.muted=false;
                volBar.style.width=(v*100)+'%';
                volBar.style.opacity='1';
            };
        }
        muteBtn.onclick=function(){
            audio.muted=!audio.muted;
            if(volBar) volBar.style.opacity=audio.muted?'.2':'1';
        };

        // Playlist toggle
        if(listBtn&&listEl){
            listBtn.onclick=function(){
                listEl.classList.toggle('open');
                listBtn.style.color=listEl.classList.contains('open')?'#D4A017':'';
            };
        }

        // Load episode from playlist
        function loadEp(item){
            var newAudio = item.getAttribute('data-audio');
            var newTitle = item.getAttribute('data-title');
            var newEp    = item.getAttribute('data-ep');
            var newThumb = item.getAttribute('data-thumb');
            var newUrl   = item.getAttribute('data-url');

            if(newAudio){
                // Update active
                document.querySelectorAll('.pa-pl-item').forEach(function(el){el.classList.remove('active');});
                item.classList.add('active');

                // Update UI
                var tEl=document.getElementById('paPPTitle');
                if(tEl) tEl.textContent=newTitle;
                var eEl=document.getElementById('paPPEp');
                if(eEl&&newEp) eEl.textContent='Ep. '+newEp;

                // Cover
                var ci=document.getElementById('paPPCoverImg');
                var bg=document.querySelector('.pa-pod-bg');
                if(newThumb){
                    if(ci){ci.src=newThumb;}
                    if(bg) bg.style.backgroundImage="url('"+newThumb+"')";
                }

                // Load
                audio.src=newAudio;
                audio.load();
                audio.play();
                bar.style.width='0%';
                curEl.textContent='0:00';
                durEl.textContent='--:--';
            } else {
                window.location.href=newUrl;
            }
        }

        document.querySelectorAll('.pa-pl-item').forEach(function(item){
            item.onclick=function(e){
                e.preventDefault();
                loadEp(this);
            };
        });

        // Auto-scroll به current item
        var cur=document.querySelector('.pa-pl-item.active');
        if(cur&&listEl) cur.scrollIntoView({block:'nearest'});

    })();
    </script>

    <?php else: ?>
    <div class="pp-no-audio">
        <div class="ni">🎙️</div>
        <p><?php echo $is_en?'Audio coming soon. Listen on platforms below.':'فایل صوتی به زودی. از پلتفرم‌های زیر گوش بده.'; ?></p>
    </div>
    <?php endif; ?>

    <!-- Listen on -->
    <?php if($spotify||$anchor): ?>
    <div class="pp-listen">
        <div class="pp-listen-label"><?php echo $is_en?'Also on:':'همچنین در:'; ?></div>
        <div class="pp-listen-btns">
            <?php if($spotify): ?>
                <a href="<?php echo esc_url($spotify); ?>" target="_blank" rel="noopener" class="pp-lbtn pp-lbtn-spotify">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02z"/></svg>
                    Spotify
                </a>
            <?php endif; ?>
            <?php if($anchor): ?>
                <a href="<?php echo esc_url($anchor); ?>" target="_blank" rel="noopener" class="pp-lbtn pp-lbtn-anchor">🎙️ Anchor</a>
            <?php endif; ?>
            <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink($post_id)); ?>" target="_blank" class="pp-lbtn pp-lbtn-tg">✈ Telegram</a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Notes -->
    <?php if($content): ?>
    <div class="pp-content">
        <div class="pp-content-title">📝 <?php echo $is_en?'Episode Notes':'یادداشت‌های اپیزود'; ?></div>
        <div class="pp-content-body"><?php echo apply_filters('the_content',$content); ?></div>
    </div>
    <?php endif; ?>

</div>
</main>

<?php wp_reset_postdata(); get_footer(); ?>
