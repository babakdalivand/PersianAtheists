<?php
/**
 * Template Name: Homepage
 * @package persian-atheists
 */

get_header();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'parts/header' ); ?>

<main id="main-content" role="main">

  <!-- ============ HERO SECTION ============ -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-grid">

        <!-- Featured Article -->
        <div class="hero-featured" id="hero-slider">
          <?php
          $featured_args = [
            'posts_per_page' => 3,
            'meta_key'       => '_pa_featured',
            'meta_value'     => '1',
            'post_status'    => 'publish',
          ];
          $featured_query = new WP_Query( $featured_args );

          if ( ! $featured_query->have_posts() ) {
            $featured_query = new WP_Query( [ 'posts_per_page' => 3, 'post_status' => 'publish' ] );
          }

          $slide_index = 0;
          while ( $featured_query->have_posts() ) :
            $featured_query->the_post();
            $thumb = get_the_post_thumbnail_url( null, 'pa-hero' );
            $class = $slide_index === 0 ? 'hero-slide active' : 'hero-slide';
          ?>
          <div class="<?php echo esc_attr( $class ); ?>" style="position:<?php echo $slide_index === 0 ? 'relative' : 'absolute'; ?>;inset:0">
            <?php if ( $thumb ) : ?>
              <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="<?php echo $slide_index === 0 ? 'eager' : 'lazy'; ?>" />
            <?php else : ?>
              <div style="width:100%;height:100%;background:linear-gradient(135deg,#1E2A38,#0F172A)"></div>
            <?php endif; ?>

            <div class="hero-overlay"></div>
            <div class="hero-content">
              <?php pa_category_badge( 'hero-label' ); ?>
              <h1 class="hero-title">
                <a href="<?php the_permalink(); ?>" style="color:inherit"><?php the_title(); ?></a>
              </h1>
              <p class="hero-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
              <div class="hero-meta">
                <span><?php the_author(); ?></span>
                <span>·</span>
                <span><?php pa_human_date(); ?></span>
                <span>·</span>
                <span><?php printf( esc_html__( '%d دقیقه مطالعه', 'persian-atheists' ), pa_get_reading_time() ); ?></span>
              </div>
              <?php if ( $slide_index === 0 ) : ?>
              <div class="hero-dots" style="margin-top:16px">
                <button class="hero-dot active" data-index="0"></button>
                <button class="hero-dot" data-index="1"></button>
                <button class="hero-dot" data-index="2"></button>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php
            $slide_index++;
          endwhile;
          wp_reset_postdata();
          ?>
        </div>

        <!-- Side Cards -->
        <div class="hero-side">
          <?php
          $side_args = [
            'posts_per_page' => 2,
            'post_status'    => 'publish',
            'offset'         => 3,
          ];
          $side_query = new WP_Query( $side_args );
          while ( $side_query->have_posts() ) :
            $side_query->the_post();
            $thumb = get_the_post_thumbnail_url( null, 'pa-thumb' );
          ?>
          <a href="<?php the_permalink(); ?>" class="hero-side-card">
            <?php if ( $thumb ) : ?>
              <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
            <?php else : ?>
              <div style="background:var(--border);display:flex;align-items:center;justify-content:center;font-size:32px">📄</div>
            <?php endif; ?>
            <div class="hero-side-content">
              <?php pa_category_badge(); ?>
              <h3 class="card-title"><?php the_title(); ?></h3>
              <div class="card-meta">
                <span><?php pa_human_date(); ?></span>
              </div>
            </div>
          </a>
          <?php
          endwhile;
          wp_reset_postdata();
          ?>
        </div>

      </div><!-- .hero-grid -->
    </div><!-- .container -->
  </section>

  <!-- ============ MAIN LAYOUT ============ -->
  <div class="container">
    <div class="main-layout">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <!-- LATEST ARTICLES -->
        <section class="section-sm" id="articles">
          <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'آخرین مقالات', 'persian-atheists' ); ?></h2>
            <a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>" class="see-all">
              <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ›
            </a>
          </div>

          <div class="articles-grid" id="articles-grid">
            <?php
            $articles_query = new WP_Query( [
              'post_type'      => 'post',
              'posts_per_page' => 6,
              'post_status'    => 'publish',
            ] );

            while ( $articles_query->have_posts() ) :
              $articles_query->the_post();
              $thumb = get_the_post_thumbnail_url( null, 'pa-card' );
            ?>
            <article class="card">
              <a href="<?php the_permalink(); ?>">
                <?php if ( $thumb ) : ?>
                  <img class="card-img" src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                <?php else : ?>
                  <div class="card-img" style="background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.3);font-size:48px">A</div>
                <?php endif; ?>
              </a>
              <div class="card-body">
                <?php pa_category_badge(); ?>
                <h3 class="card-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="card-meta">
                  <span><?php the_author(); ?></span>
                  <span>·</span>
                  <span><?php pa_human_date(); ?></span>
                  <span>·</span>
                  <span><?php printf( esc_html__( '%d دقیقه', 'persian-atheists' ), pa_get_reading_time() ); ?></span>
                </div>
              </div>
            </article>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
          </div>

          <div style="text-align:center;margin-top:var(--space-6)">
            <button class="btn btn-outline load-more-btn"
                    data-post-type="post"
                    data-container="articles-grid"
                    data-page="1">
              <?php esc_html_e( 'بیشتر بخوانید', 'persian-atheists' ); ?>
            </button>
          </div>
        </section>

        <!-- YOUTUBE SHORTS -->
        <section class="section-sm" id="shorts">
          <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'شورت‌های یوتیوب', 'persian-atheists' ); ?></h2>
            <a href="<?php echo esc_url( home_url( '/shorts/' ) ); ?>" class="see-all">
              <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ›
            </a>
          </div>
          <div class="shorts-grid">
            <?php
            $shorts_query = new WP_Query( [
              'post_type'      => 'short',
              'posts_per_page' => 5,
              'post_status'    => 'publish',
            ] );

            while ( $shorts_query->have_posts() ) :
              $shorts_query->the_post();
              $media_url = pa_get_media_url();
              $thumb     = $media_url ? pa_youtube_thumbnail( $media_url, 'mqdefault' ) : get_the_post_thumbnail_url( null, 'pa-short' );
              $duration  = pa_get_duration();
            ?>
            <a href="<?php the_permalink(); ?>" class="short-card">
              <?php if ( $thumb ) : ?>
                <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
              <?php else : ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#1E2A38,#0F172A)"></div>
              <?php endif; ?>
              <div class="short-overlay">
                <div class="short-play">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 3l14 9-14 9z"/></svg>
                </div>
                <p style="color:#fff;font-size:12px;font-weight:600;line-height:1.3;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                  <?php the_title(); ?>
                </p>
                <?php if ( $duration ) : ?>
                  <span style="color:rgba(255,255,255,0.7);font-size:11px;margin-top:4px"><?php echo esc_html( $duration ); ?></span>
                <?php endif; ?>
              </div>
            </a>
            <?php
            endwhile;
            wp_reset_postdata();

            // Placeholder shorts if none exist
            if ( ! $shorts_query->have_posts() && $shorts_query->post_count === 0 ) :
              for ( $i = 0; $i < 5; $i++ ) :
            ?>
            <div class="short-card" style="background:linear-gradient(135deg,#1E2A38,#0F172A)">
              <div class="short-overlay">
                <div class="short-play" style="opacity:0.5">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 3l14 9-14 9z"/></svg>
                </div>
                <p style="color:rgba(255,255,255,0.5);font-size:12px">...</p>
              </div>
            </div>
            <?php
              endfor;
            endif;
            ?>
          </div>
        </section>

        <!-- VIDEOS -->
        <section class="section-sm" id="videos">
          <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'ویدیوهای یوتیوب', 'persian-atheists' ); ?></h2>
            <a href="<?php echo esc_url( home_url( '/videos/' ) ); ?>" class="see-all">
              <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ›
            </a>
          </div>
          <div class="scroll-container">
            <?php
            $videos_query = new WP_Query( [
              'post_type'      => 'video',
              'posts_per_page' => 4,
              'post_status'    => 'publish',
            ] );

            while ( $videos_query->have_posts() ) :
              $videos_query->the_post();
              $media_url = pa_get_media_url();
              $thumb     = $media_url ? pa_youtube_thumbnail( $media_url ) : get_the_post_thumbnail_url( null, 'pa-card' );
              $duration  = pa_get_duration();
            ?>
            <div class="media-card">
              <div class="thumbnail">
                <?php if ( $thumb ) : ?>
                  <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                <?php else : ?>
                  <div style="width:100%;height:100%;background:linear-gradient(135deg,#1E2A38,#D4A017)"></div>
                <?php endif; ?>
                <div class="play-btn">
                  <div class="play-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M5 3l14 9-14 9z"/></svg>
                  </div>
                </div>
                <?php if ( $duration ) : ?>
                  <span class="duration-badge"><?php echo esc_html( $duration ); ?></span>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <h3 class="card-title" style="font-size:13px">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="card-meta">
                  <span><?php pa_human_date(); ?></span>
                </div>
              </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </section>

        <!-- PODCASTS -->
        <section class="section-sm" id="podcasts">
          <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'آخرین پادکست‌ها', 'persian-atheists' ); ?></h2>
            <a href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>" class="see-all">
              <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ›
            </a>
          </div>
          <div class="scroll-container">
            <?php
            $podcast_query = new WP_Query( [
              'post_type'      => 'podcast',
              'posts_per_page' => 4,
              'post_status'    => 'publish',
            ] );

            while ( $podcast_query->have_posts() ) :
              $podcast_query->the_post();
              $thumb    = get_the_post_thumbnail_url( null, 'pa-card' );
              $duration = pa_get_duration();
            ?>
            <div class="media-card">
              <div class="thumbnail">
                <?php if ( $thumb ) : ?>
                  <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                <?php else : ?>
                  <div style="width:100%;height:100%;background:linear-gradient(135deg,#0F172A,#1E293B);display:flex;align-items:center;justify-content:center">
                    <svg width="48" height="48" fill="none" stroke="rgba(212,160,23,0.5)" stroke-width="1.5" viewBox="0 0 24 24">
                      <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>
                    </svg>
                  </div>
                <?php endif; ?>
                <div class="play-btn">
                  <div class="play-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M5 3l14 9-14 9z"/></svg>
                  </div>
                </div>
                <?php if ( $duration ) : ?>
                  <span class="duration-badge"><?php echo esc_html( $duration ); ?></span>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <h3 class="card-title" style="font-size:13px">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="card-meta">
                  <span><?php pa_human_date(); ?></span>
                </div>
              </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </section>

      </div><!-- .main-content -->

      <!-- SIDEBAR -->
      <?php get_template_part( 'parts/sidebar' ); ?>

    </div><!-- .main-layout -->
  </div><!-- .container -->

  <!-- ============ CTA STRIP ============ -->
  <div class="cta-strip">
    <div class="container">
      <div class="cta-grid">

        <!-- Constitution CTA -->
        <a href="<?php echo esc_url( home_url( '/constitution/' ) ); ?>" class="cta-block">
          <div class="cta-icon">
            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div class="cta-info">
            <h3 class="cta-title"><?php esc_html_e( 'اساسنامه گروه', 'persian-atheists' ); ?></h3>
            <p class="cta-desc"><?php esc_html_e( 'مطالعه اصول، ارزش‌ها و قوانین فعالیت گروه آتئیست‌های ایرانی', 'persian-atheists' ); ?></p>
            <span class="cta-btn"><?php esc_html_e( 'مطالعه', 'persian-atheists' ); ?> ›</span>
          </div>
        </a>

        <!-- Membership CTA -->
        <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="cta-block">
          <div class="cta-icon">
            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <div class="cta-info">
            <h3 class="cta-title"><?php esc_html_e( 'عضویت در دنیای واقعی', 'persian-atheists' ); ?></h3>
            <p class="cta-desc"><?php esc_html_e( 'فرم درخواست عضویت در گروه آتئیست‌های ایرانی را پر کنید.', 'persian-atheists' ); ?></p>
            <span class="cta-btn"><?php esc_html_e( 'درخواست عضویت', 'persian-atheists' ); ?> ›</span>
          </div>
        </a>

        <!-- Donate CTA -->
        <a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>" class="cta-block">
          <div class="cta-icon">
            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </div>
          <div class="cta-info">
            <h3 class="cta-title"><?php esc_html_e( 'حمایت مالی از ما', 'persian-atheists' ); ?></h3>
            <p class="cta-desc"><?php esc_html_e( 'با حمایت مالی خود به ما کمک کنید تا ادامه فعالیت مستقل داشته باشیم.', 'persian-atheists' ); ?></p>
            <span class="cta-btn"><?php esc_html_e( 'حمایت کنید', 'persian-atheists' ); ?> ›</span>
          </div>
        </a>

      </div>
    </div>
  </div>

</main>

<?php get_template_part( 'parts/footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
