<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title><?php bloginfo('name'); ?></title>
	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php  echo get_stylesheet_uri();  ?>">
	<?php wp_head(); ?>
</head>
<body <?php  body_class();//bodyに付加するクラス名を出力する  ?>>

	<header>
		<div class="siteinfo">
			<div class="container">
				<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
				<p><?php bloginfo('description'); ?></p>
			</div>
		</div>
	</header>

	<div class="container">

		<?php if(have_posts()): ?>
			<?php while(have_posts()): ?>
				<?php the_post();  ?>

				<article <?php  post_class();//記事に付加するクラス名を出力する  ?>>

					<?php  if(is_single())://個別ページかどうかを判定する  ?>
						<h1><?php  the_title();//記事のタイトルを出力する  ?></h1>
					<?php  else:  ?>
						<h1>
							<a href="<?php the_permalink();///*個別ページへのＵＲＬを出力する*/ ?>">
								<?php  the_title();//記事のタイトルを出力する  ?>
							</a>
						</h1>
					<?php  endif;  ?>

					<div class="postinfo">
						<time datetime="<?php  echo get_the_date('Y-m-d');//記事の投稿日を出力する  ?>">
							<i class="fa fa-clock-o"></i>
							<?php  echo get_the_date();  ?>
						</time>

						<span class="postcat">
							<i class="fa fa-folder-open"></i>
							<?php  the_category(',');  //記事のカテゴリーを表示する ?>
						</span>
					</div>

					<p><?php  the_content();//記事の本文を出力する  ?></p>

					<?php  if(is_single())://シングルページかどうかを判定する  ?>
						<!--シングルページの時のみ前後の記事へのリンクを出力するようにする-->
						<div class="pagenav">
							<span class="old">
								<?php //前の記事へのリンクを表示るする（引数が２つの場合）
								previous_post_link('%link',
									'<i class="fa fa-chevron-circle-left"></i> %title'); ?>
							</span>
							<span class="new">
								<?php //後の記事へのリンクを表示する（引数が2つの場合）
								next_post_link('%link',
									'%title <i class="fa fa-chevron-circle-right"></i>');
								?>
							</span>
						</div>
					<?php  endif;  ?>

					</article>

				<?php endwhile; ?>
			<?php endif; ?>

			<?php   if( $wp_query->max_num_pages > 1)://記事が複数ページあるかどうかを判定 ?>
				<div class="pagenav">
					<span class="old">
						<?php next_posts_link('古い記事'); //古いページへのリンクを表示する（引数が1つの場合）?>
					</span>

					<span class="new">
						<?php previous_posts_link('新しい記事'); //新しいページへのリンクを表示する（引数が1つの場合） ?>
					</span>
				</div>
			<?php  endif;  ?>
		</div><!--container-->

		<footer>
			<div class="container">
				<small>Copyright &copy; <?php bloginfo('name'); ?></small>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
	</html>