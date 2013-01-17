<?php
/**
 * http://csscience.com/responsiveslidercss3/
 */
function renderHero() {
    global $configIndex;

    $html =<<<HTML
<div class="mod-hero">
    <article class="slider">

		<!-- Slider Setup -->

		<input type=radio name=slider id=hero-slide1 checked />
		<input type=radio name=slider id=hero-slide2 />
		<input type=radio name=slider id=hero-slide3 />

		<!-- The Slider -->

		<div class="slides">

			<div class="overflow">

				<div class="inner">

					<article>
                        <a href="brand.php?config={$configIndex}">
                            <div class=info></div>
                            <img src="images/Yoplait_Hero1_20130115.png" />
                        </a>
					</article>

					<article>
						<div class=info></div>
						<img src="images/Recipe_Hero_Banners_20130116.png" />
					</article>

					<article>
						<div class=info></div>
						<img src="images/Yoplait_Hero3b_20130115.png" />
					</article>

				</div> <!-- .inner -->

			</div> <!-- .overflow -->

		</div> <!-- .slides -->


		<!-- Controls and Active Slide Display -->

		<div class="controls">

			<label for=hero-slide1></label>
			<label for=hero-slide2></label>
			<label for=hero-slide3></label>

		</div> <!-- .controls -->


	</article> <!-- #slider -->
</div>
HTML;

    return $html;
}
?>
