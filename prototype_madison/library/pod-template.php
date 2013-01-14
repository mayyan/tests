<?php

$podTemplate =<<<HTML
<div class="pod {type}" data-podid="{podId}" id="couponsinc-gallery-POD{podId}">
    <h3 class="premium-label">Savings Club</h3>

    <div class="hover">
        <div class="sprite-pod circle">
            <p class="click-text">{cta}</p>
            <p class="click-text-sec">{cta2}</p>
        </div>
    </div>
    <div class="left">
        <div class="pod-media">
            <div class="img">
                <img width="80" height="100" src="{imageUrl}" alt="{imageAlt}" class="pod-image">
            </div>
        </div>
    </div>
    <div class="right">
        <div class="pod-info">
            <h4 class="summary">{summary}</h4>
            <h5 class="brand">{brand}</h5>
            <p class="details">{details}</p>
        </div>
    </div>
    <div class="clipped-container">
        <div class="clipped-view">

            <span class="box clip-box clip-action">
                <i>&#x2713;</i>Clipped
            </span>
            <span class="box clip-box unclip-action">
                <i>&#x2715;</i>Unclip
            </span>

            <span class="box share-box">
                <i>&#x21f6;</i>Share
                <div class="social-container">
                    <div class="social-message">
                        Share with your friends.
                    </div>
                    <div class="social-strip">
                        <div class="sprite-urban facebook"></div>
                        <div class="sprite-urban twitter"></div>
                        <div class="sprite-urban email"></div>
                    </div>
                </div>
            </span>

            <span class="box info">
                <i>&#x21f1;</i>Info
            </span>


        </div>
    </div>
</div>
HTML;
?>
