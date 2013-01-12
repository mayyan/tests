<?php

function renderHero() {
    $html =<<<HTML
<div class="mod-hero">
    <article id=slider>

		<!-- Slider Setup -->

		<input checked type=radio name=slider id=slide1 />
		<input type=radio name=slider id=slide2 />
		<input type=radio name=slider id=slide3 />
		<input type=radio name=slider id=slide4 />
		<input type=radio name=slider id=slide5 />


		<!-- The Slider -->

		<div id=slides>

			<div id=overflow>

				<div class=inner>

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

					<article>
						<div class=info></div>
						<img src="images/slide1.jpg" />
					</article>

					<article>
						<div class=info></div>
						<img src="images/slide1.jpg" />
					</article>

				</div> <!-- .inner -->

			</div> <!-- #overflow -->

		</div> <!-- #slides -->


		<!-- Controls and Active Slide Display -->

		<div id=controls>

			<label for=slide1></label>
			<label for=slide2></label>
			<label for=slide3></label>
			<label for=slide4></label>
			<label for=slide5></label>

		</div> <!-- #controls -->
        <div class="clearfix"></div>


		<div id=active>

			<label for=slide1></label>
			<label for=slide2></label>
			<label for=slide3></label>
			<label for=slide4></label>
			<label for=slide5></label>

		</div> <!-- #active -->


	</article> <!-- #slider -->
</div>
HTML;

    return $html;
}
?>
