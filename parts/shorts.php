<?php
/**
 * Short Videos Section — with popup player
 */

$shorts = new WP_Query( [
    'post_type'      => 'pa_short',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
] );

if ( ! $shorts->have_posts() ) return;
?>

<section class="site-section">

    <div class="section-header">
        <h2 class="section-title">
            🎬 <?php esc_html_e( 'ویدئوهای کوتاه', 'persian-atheists' ); ?>
        </h2>
        <a href="<?php echo esc_url( home_url( '/shorts' ) ); ?>" class="view-all">
            <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ←
        </a>
    </div>

    <div class="scroll-row shorts-scroll-row">
        <?php while ( $shorts->have_posts() ) : $shorts->the_post();
            $yt_id   = pa_get_youtube_id();
            $duration= get_post_meta( get_the_ID(), 'pa_duration', true );
        ?>
            <div class="media-card short-card"
                 style="min-width:160px;cursor:pointer;"
                 data-yt="<?php echo esc_attr( $yt_id ); ?>"
                 data-title="<?php echo esc_attr( get_the_title() ); ?>"
                 data-url="<?php the_permalink(); ?>">
                <div class="media-thumb" style="aspect-ratio:9/16;">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'pa-square', [ 'alt' => get_the_title() ] ); ?>
                    <?php elseif ( $yt_id ) : ?>
                        <img src="https://i.ytimg.com/vi/<?php echo esc_attr( $yt_id ); ?>/oardefault.jpg"
                             alt="<?php the_title_attribute(); ?>"
                             style="object-position:center;object-fit:cover;width:100%;height:100%;">
                    <?php else : ?>
                        <div style="background:#1E2A38;width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:28px;">🎬</div>
                    <?php endif; ?>

                    <?php if ( $duration ) : ?>
                        <span class="media-duration"><?php echo esc_html( $duration ); ?></span>
                    <?php endif; ?>

                    <div class="play-overlay short-play-btn">
                        <div class="play-circle">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                    </div>
                </div>
                <div class="media-info">
                    <div class="media-title" style="-webkit-line-clamp:3;font-size:12px;">
                        <?php the_title(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</section>

<!-- Short Video Popup Modal -->
<div id="short-popup-overlay" style="
    display:none;position:fixed;inset:0;z-index:9999;
    background:rgba(0,0,0,0.88);
    align-items:center;justify-content:center;
    backdrop-filter:blur(6px);
">
    <div id="short-popup-box" style="
        position:relative;
        width:min(360px,92vw);
        animation:shortPopIn .3s cubic-bezier(.34,1.56,.64,1) both;
    ">
        <!-- Close -->
        <button onclick="closeShortPopup()" style="
            position:absolute;top:-44px;left:50%;transform:translateX(-50%);
            background:rgba(255,255,255,.12);border:none;color:#fff;
            width:36px;height:36px;border-radius:50%;cursor:pointer;
            font-size:18px;display:flex;align-items:center;justify-content:center;
        ">✕</button>

        <!-- Player 9:16 -->
        <div style="position:relative;aspect-ratio:9/16;border-radius:16px;overflow:hidden;background:#000;box-shadow:0 20px 60px rgba(0,0,0,.6);">
            <iframe id="short-popup-iframe"
                src=""
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                style="position:absolute;inset:0;width:100%;height:100%;">
            </iframe>
        </div>

        <!-- Title + link -->
        <div style="margin-top:12px;text-align:center;">
            <p id="short-popup-title" style="color:#fff;font-size:14px;font-weight:700;margin:0 0 8px;line-height:1.5;"></p>
            <a id="short-popup-link" href="#" style="font-size:12px;color:rgba(255,255,255,.6);text-decoration:none;">
                صفحه کامل →
            </a>
        </div>
    </div>
</div>

<style>
@keyframes shortPopIn {
    from { opacity:0; transform:scale(.85) translateY(20px); }
    to   { opacity:1; transform:scale(1)  translateY(0); }
}
@keyframes shortPopOut {
    from { opacity:1; transform:scale(1); }
    to   { opacity:0; transform:scale(.9); }
}
.short-card:hover .short-play-btn { opacity:1 !important; }
</style>

<script>
(function(){
    document.querySelectorAll('.short-card').forEach(function(card){
        card.addEventListener('click', function(){
            var yt   = card.dataset.yt;
            var ttl  = card.dataset.title;
            var url  = card.dataset.url;
            if (!yt) { window.location.href = url; return; }
            openShortPopup(yt, ttl, url);
        });
    });
})();

function openShortPopup(yt, title, url) {
    var overlay = document.getElementById('short-popup-overlay');
    var iframe  = document.getElementById('short-popup-iframe');
    var tEl     = document.getElementById('short-popup-title');
    var lEl     = document.getElementById('short-popup-link');
    iframe.src  = 'https://www.youtube.com/embed/' + yt + '?autoplay=1&rel=0&modestbranding=1';
    tEl.textContent = title || '';
    lEl.href = url || '#';
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeShortPopup() {
    var overlay = document.getElementById('short-popup-overlay');
    var iframe  = document.getElementById('short-popup-iframe');
    var box     = document.getElementById('short-popup-box');
    box.style.animation = 'shortPopOut .2s ease both';
    setTimeout(function(){
        overlay.style.display = 'none';
        iframe.src = '';
        box.style.animation = 'shortPopIn .3s cubic-bezier(.34,1.56,.64,1) both';
        document.body.style.overflow = '';
    }, 200);
}

document.getElementById('short-popup-overlay').addEventListener('click', function(e){
    if (e.target === this) closeShortPopup();
});
document.addEventListener('keydown', function(e){
    if (e.key === 'Escape') closeShortPopup();
});
</script>
