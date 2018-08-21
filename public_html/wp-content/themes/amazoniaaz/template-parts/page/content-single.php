<div class="txt">
    <h3><a href="#"><span class="label label-success">#<?=get_the_category()[0]->name?></span></a></h3>
    <div class="caption">
        <h1><a href="#"><?php the_title(); ?></a></h1>
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <b style="color: #080808;">Atualizado em</b></span>
        <span><?=get_the_date(); ?></span>
        <span>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            <b style="color: #080808;">escrito por</b></span>
        <span> <?=get_the_author(); ?> </span>
    </div>
</div>
<?php
$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
if(isset($image[0])):
?>
    <img src="<?=WP_SITE_URL . $image[0]?>">
<div class="cap"><i class="fa fa-file-image-o" aria-hidden="true"></i> <?=get_the_post_thumbnail_caption();?></div>
<?php endif; ?>
<div class="conteudo">
    <?php the_content(); ?>
	<div class="addthis_inline_share_toolbox"></div>
    <?php
        $tags = wp_get_post_tags($post->ID);
        $tagsHtml = "";
        foreach ($tags as $tag)
        {
            $tagsHtml .= "<a href=\"/tags/{$tag->slug}\" rel=\"tag\">{$tag->name}</a>";
        }
    ?>
    <div class="post-tags">
        Tags: <?=$tagsHtml?><br>
    </div>
    <h2>Comentários</h2>
	<div id="disqus_thread"></div>
<script>

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://portalamazonia-br.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
</div>


