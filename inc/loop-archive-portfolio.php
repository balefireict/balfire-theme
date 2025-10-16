<?php
/**
 * Template part for displaying portfolio items
 */
?>
<article id="post-<?php the_ID(); ?>" role="article">					
    <div class="folio-header" data-accordion-trigger>
        <div class="expand-icon">
            <div class="circle">
                <span class="plus-minus"></span>
            </div>
        </div>
        <div class="folio-grid">
            <div class="folio-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array(
                        'title' => get_the_title(),
                        'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?: get_the_title()
                    )); ?>
                <?php endif; ?>
            </div>
            
            <div class="folio-location">
                <?php echo get_field('bma_portfolio_location'); ?>
            </div>
            
            <div class="folio-industry">
                <?php echo get_field('bma_portfolio_industry_type'); ?>
            </div>

            <div class="folio-status">
                <?php 
                $terms = get_the_terms(get_the_ID(), 'investments');
                if ($terms && !is_wp_error($terms)) {
                    echo '<span>' . esc_html($terms[0]->name) . '</span>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="folio-content" data-accordion-content>
        <?php the_content(); ?>
        
        <?php if (get_field('bma_portfolio_link')) : ?>
            <div class="folio-link">
                <a href="<?php echo esc_url(get_field('bma_portfolio_link')); ?>" target="_blank" rel="noopener noreferrer" class="folio-link" title="Visit <?php the_title(); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17.955" height="16.5" viewBox="0 0 17.955 16.5">
                        <path id="Path_756" data-name="Path 756" d="M10.182,3.182H.727V16.273H15.273v-8H16V17H0V2.455H10.182Zm7.273,3.636h-.727V2.241l-8.47,8.471L7.743,10.2l8.471-8.47H11.636V1h5.818Z" transform="translate(0.25 -0.75)" fill="#eb751f" stroke="#eb751f" stroke-width="0.5" fill-rule="evenodd"/>
                    </svg>
                    <span class="folio-link-text">Visit Website</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="gray-triangle-ornament">
        <svg id="gray-triangle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38.92 38.92">
        <path id="_1" data-name="1" d="M2.16,38.92l2.16-2.16-2.16-2.16-2.16,2.16,2.16,2.16" fill="#ebebeb"/>
        <path id="_2" data-name="2" d="M12.97,36.76l-2.16-2.16-2.16,2.16,2.16,2.16,2.16-2.16" fill="#ebebeb"/>
        <path id="_3" data-name="3" d="M6.49,30.27l-2.16,2.16,2.16,2.16,2.16-2.16-2.16-2.16" fill="#ebebeb"/>
        <path id="_4" data-name="4" d="M0,28.11l2.16,2.16,2.16-2.16-2.16-2.16L0,28.11Z" fill="#ebebeb"/>
        <path id="_5" data-name="5" d="M17.3,36.76l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16" fill="#ebebeb"/>
        <path id="_6" data-name="6" d="M15.14,34.59l2.16-2.16-2.16-2.16-2.16,2.16,2.16,2.16" fill="#ebebeb"/>
        <path id="_7" data-name="7" d="M12.97,28.11l-2.16-2.16-2.16,2.16,2.16,2.16,2.16-2.16" fill="#ebebeb"/>
        <path id="_8" data-name="8" d="M4.33,23.78l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16Z" fill="#ebebeb"/>
        <path id="_8-2" data-name="8" d="M0,19.46l2.16,2.16,2.16-2.16-2.16-2.16L0,19.46Z" fill="#ebebeb"/>
        <path id="_9" data-name="9" d="M25.95,36.76l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16" fill="#ebebeb"/>
        <path id="_10" data-name="10" d="M21.62,32.43l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16" fill="#ebebeb"/>
        <path id="_11" data-name="11" d="M17.3,28.11l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16" fill="#ebebeb"/>
        <path id="_12" data-name="12" d="M12.97,23.78l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16" fill="#ebebeb"/>
        <path id="_13" data-name="13" d="M12.97,19.46l-2.16-2.16-2.16,2.16,2.16,2.16,2.16-2.16" fill="#ebebeb"/>
        <path id="_14" data-name="14" d="M4.33,15.13l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16Z" fill="#ebebeb"/>
        <path id="_15" data-name="15" d="M0,10.81l2.16,2.16,2.16-2.16-2.16-2.16L0,10.81Z" fill="#ebebeb"/>
        <path id="_16" data-name="16" d="M36.76,34.59l-2.16,2.16,2.16,2.16,2.16-2.16-2.16-2.16Z" fill="#ebebeb"/>
        <path id="_17" data-name="17" d="M32.43,30.27l-2.16,2.16,2.16,2.16,2.16-2.16-2.16-2.16" fill="#ebebeb"/>
        <path id="_18" data-name="18" d="M28.11,25.95l-2.16,2.16,2.16,2.16,2.16-2.16-2.16-2.16" fill="#ebebeb"/>
        <path id="_19" data-name="19" d="M23.78,21.62l-2.16,2.16,2.16,2.16,2.16-2.16-2.16-2.16" fill="#ebebeb"/>
        <path id="_20" data-name="20" d="M19.46,21.62l2.16-2.16-2.16-2.16-2.16,2.16,2.16,2.16" fill="#ebebeb"/>
        <path id="_21" data-name="21" d="M12.97,15.13l2.16,2.16,2.16-2.16-2.16-2.16-2.16,2.16Z" fill="#ebebeb"/>
        <path id="_22" data-name="22" d="M10.81,8.65l-2.16,2.16,2.16,2.16,2.16-2.16-2.16-2.16Z" fill="#ebebeb"/>
        <path id="_23" data-name="23" d="M0,2.16l2.16,2.16,2.16-2.16L2.16,0,0,2.16" fill="#ebebeb"/>
            <path id="_24" data-name="24" d="M8.65,6.49l-2.16-2.16-2.16,2.16,2.16,2.16,2.16-2.16Z" fill="#ebebeb"/>
        </svg>
    </div>
</article>




