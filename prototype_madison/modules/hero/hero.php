<?php

function renderHero() {
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
						<div class=info></div>
						<img src="images/slide1.jpg" />
					</article>

					<article>
						<div class=info></div>
						<img src="images/slide2.jpg" />
					</article>

					<article>
						<div class=info></div>
						<img src="images/slide3.jpg" />
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
