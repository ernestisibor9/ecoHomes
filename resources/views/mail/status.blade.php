<!DOCTYPE html>

<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta content="width=device-width" name="viewport" />
    <style>
        .bee-row,
        .bee-row-content {
            position: relative
        }

        .bee-row-1,
        .bee-row-10,
        .bee-row-11,
        .bee-row-12,
        .bee-row-13,
        .bee-row-14,
        .bee-row-15,
        .bee-row-16,
        .bee-row-2,
        .bee-row-3,
        .bee-row-4,
        .bee-row-5,
        .bee-row-6,
        .bee-row-7,
        .bee-row-8,
        .bee-row-9 {
            background-repeat: no-repeat
        }

        body {
            background-color: #cbe0ee;
            color: #000;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif
        }

        a {
            color: #000000
        }

        * {
            box-sizing: border-box
        }

        body,
        h1,
        p {
            margin: 0
        }

        .bee-row-content {
            max-width: 1025px;
            margin: 0 auto;
            display: flex
        }

        .bee-row-content .bee-col-w1 {
            flex-basis: 8%
        }

        .bee-row-content .bee-col-w2 {
            flex-basis: 17%
        }

        .bee-row-content .bee-col-w3 {
            flex-basis: 25%
        }

        .bee-row-content .bee-col-w4 {
            flex-basis: 33%
        }

        .bee-row-content .bee-col-w5 {
            flex-basis: 42%
        }

        .bee-row-content .bee-col-w6 {
            flex-basis: 50%
        }

        .bee-row-content .bee-col-w8 {
            flex-basis: 67%
        }

        .bee-row-content .bee-col-w12 {
            flex-basis: 100%
        }

        .bee-button .content {
            text-align: center
        }

        .bee-button a,
        .bee-icon .bee-icon-label-right a {
            text-decoration: none
        }

        .bee-icon {
            display: inline-block;
            vertical-align: middle
        }

        .bee-icon .bee-content {
            display: flex;
            align-items: center
        }

        .bee-paragraph,
        .bee-text {
            overflow-wrap: anywhere
        }

        .bee-row-1 .bee-row-content,
        .bee-row-2 .bee-row-content {
            background-color: #000000;
            background-repeat: no-repeat;
            border-radius: 0;
            color: #000
        }

        .bee-row-11 .bee-row-content,
        .bee-row-12 .bee-row-content,
        .bee-row-3 .bee-row-content,
        .bee-row-4 .bee-row-content,
        .bee-row-5 .bee-row-content {
            background-color: #fff;
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-3 .bee-row-content {
            background-image: url('https://d1oco4z2z1fhwp.cloudfront.net/templates/default/7326/hero-background.png');
            background-size: auto;
            border-radius: 0
        }

        .bee-row-3 .bee-col-1 {
            padding-bottom: 20px;
            padding-right: 00px
        }

        .bee-row-3 .bee-col-2 {
            padding-bottom: 20px;
            padding-left: 10px;
            padding-right: 10px
        }

        .bee-row-3 .bee-col-2 .bee-block-2 {
            padding-bottom: 30px;
            text-align: center;
            width: 100%
        }

        .bee-row-3 .bee-col-2 .bee-block-3,
        .bee-row-4 .bee-col-1 .bee-block-1 {
            padding-bottom: 30px
        }

        .bee-row-3 .bee-col-2 .bee-block-4 {
            padding: 10px;
            text-align: center
        }

        .bee-row-3 .bee-col-3 {
            padding: 5px 30px
        }

        .bee-row-5 .bee-col-2 .bee-block-1 {
            padding-bottom: 30px;
            padding-left: 10px;
            padding-right: 10px
        }

        .bee-row-5 .bee-col-2 .bee-block-2 {
            padding: 10px 10px 30px;
            text-align: center
        }

        .bee-row-6 .bee-row-content,
        .bee-row-7 .bee-row-content {
            background-color: #fafafa;
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-10 .bee-row-content,
        .bee-row-8 .bee-row-content,
        .bee-row-9 .bee-row-content {
            background-color: #fafafa;
            background-repeat: no-repeat;
            border-radius: 0;
            color: #000
        }

        .bee-row-11 .bee-col-1 {
            padding: 30px
        }

        .bee-row-13 .bee-row-content {
            background-color: #fff;
            background-repeat: no-repeat;
            border-radius: 0;
            color: #000
        }

        .bee-row-14 .bee-row-content {
            background-color: #000000;
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-14 .bee-col-1 {
            padding: 30px 20px 10px
        }

        .bee-row-14 .bee-col-2 {
            padding: 30px 10px 10px
        }

        .bee-row-14 .bee-col-2 .bee-block-1,
        .bee-row-14 .bee-col-2 .bee-block-2,
        .bee-row-14 .bee-col-3 .bee-block-1,
        .bee-row-14 .bee-col-3 .bee-block-2,
        .bee-row-15 .bee-col-1 .bee-block-1 {
            padding: 10px
        }

        .bee-row-14 .bee-col-3,
        .bee-row-14 .bee-col-4 {
            padding: 30px 10px
        }

        .bee-row-15 .bee-row-content,
        .bee-row-16 .bee-row-content {
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-16 .bee-col-1 {
            padding-bottom: 5px;
            padding-top: 5px
        }

        .bee-row-16 .bee-col-1 .bee-block-1 {
            color: #9d9d9d;
            font-family: inherit;
            font-size: 15px;
            padding-bottom: 5px;
            padding-top: 5px;
            text-align: center
        }

        .bee-row-4 .bee-col-1 .bee-block-1 {
            color: #393d47;
            direction: ltr;
            font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 44px;
            font-weight: 700;
            letter-spacing: 0;
            line-height: 120%;
            text-align: center
        }

        .bee-row-3 .bee-col-2 .bee-block-3,
        .bee-row-5 .bee-col-2 .bee-block-1 {
            direction: ltr;
            font-weight: 400;
            letter-spacing: 0;
            line-height: 120%;
            text-align: left
        }

        .bee-row-3 .bee-col-2 .bee-block-3 a,
        .bee-row-4 .bee-col-1 .bee-block-1 a,
        .bee-row-5 .bee-col-2 .bee-block-1 a {
            color: #8a3b8f
        }

        .bee-row-3 .bee-col-2 .bee-block-3 p:not(:last-child),
        .bee-row-4 .bee-col-1 .bee-block-1 p:not(:last-child),
        .bee-row-5 .bee-col-2 .bee-block-1 p:not(:last-child) {
            margin-bottom: 16px
        }

        .bee-row-3 .bee-col-2 .bee-block-3 {
            color: #fff;
            font-size: 16px
        }

        @media (max-width:768px) {
            .bee-row-content:not(.no_stack) {
                display: block
            }

            .bee-row-3 .bee-col-2 .bee-block-2 h1,
            .bee-row-4 .bee-col-1 .bee-block-1 {
                font-size: 60px !important
            }
        }

        .bee-row-5 .bee-col-2 .bee-block-1 {
            color: #3c3c3c;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 23px
        }

        .bee-row-16 .bee-col-1 .bee-block-1 .bee-icon-image {
            padding: 5px 6px 5px 5px
        }

        .bee-row-16 .bee-col-1 .bee-block-1 .bee-icon:not(.bee-icon-first) .bee-content {
            margin-left: 0
        }

        .bee-row-16 .bee-col-1 .bee-block-1 .bee-icon::not(.bee-icon-last) .bee-content {
            margin-right: 0
        }
    </style>
</head>

<body>
    <div class="bee-page-container">
        <div class="bee-row bee-row-1">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:15px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-2">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:30px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-3">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w1">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w5">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                    <div class="bee-block bee-block-2 bee-heading">
                        {{-- <img src="{{asset('frontend/assets/img/logorem.png')}} " alt="" width="130px" height="130px"> --}}
                        <h1
                            style="color:#000000;direction:ltr;font-family:'Roboto Slab', Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:74px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                            EcoHomes<br /> </h1>
                    </div>
                    <div class="bee-block bee-block-3 bee-paragraph">
                    </div>
                    <div class="bee-block bee-block-4 bee-button"></div>
                </div>
                <div class="bee-col bee-col-3 bee-col-w6"></div>
            </div>
        </div>
        <div class="bee-row bee-row-4">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-paragraph">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-5">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w8">
                    <div class="bee-block bee-block-1 bee-paragraph">
                        <?php
                        $message = $status['Message'];
                        ?>

                        <p><strong>Hello </strong><br /></p>
                        <p>{!! nl2br($message) !!}</p>
                        <p>
                            @if (isset($status['link']))
                                <p><a href="{{ $status['link'] }}">Proceed to Next Step</a></p>
                            @else
                            @endif
                        </p>
                    </div>
                    <div class="bee-block bee-block-2 bee-button"></div>
                </div>
                <div class="bee-col bee-col-3 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-6">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12"></div>
            </div>
        </div>
        <div class="bee-row bee-row-7">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w8"></div>
                <div class="bee-col bee-col-3 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-8">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w4"></div>
                <div class="bee-col bee-col-3 bee-col-w4"></div>
                <div class="bee-col bee-col-4 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-9">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w4"></div>
                <div class="bee-col bee-col-3 bee-col-w4"></div>
                <div class="bee-col bee-col-4 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-10">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:60px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-11">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12"></div>
            </div>
        </div>
        <div class="bee-row bee-row-12">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w8"></div>
                <div class="bee-col bee-col-3 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-13">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-14">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w3"></div>
                <div class="bee-col bee-col-2 bee-col-w3">
                    <div class="bee-block bee-block-1 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 120%; font-size: 12px; font-family: inherit; color: #fafafa;">

                        </div>
                    </div>
                    <div class="bee-block bee-block-2 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 150%; font-size: 12px; font-family: inherit; color: #fafafa;">
                        </div>
                    </div>
                </div>
                <div class="bee-col bee-col-3 bee-col-w3">
                    <div class="bee-block bee-block-1 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 120%; font-size: 12px; font-family: inherit; color: #fafafa;">
                            <p style="font-size: 14px; line-height: 16px; text-align: center;"><span
                                    style="font-size: 18px; line-height: 21px;"><strong style=""><span
                                            style="line-height: 14px;">Contact Us</span></strong></span></p>
                        </div>
                    </div>
                    <div class="bee-block bee-block-2 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 150%; font-size: 12px; font-family: inherit; color: #fafafa;">
                            <p style="line-height: 18px; text-align: center;"><span style="line-height: 18px;">13,
                                    Joseph Street, Ikeja, Lagos</span></p>
                            <p style="line-height: 18px; text-align: center;"><span
                                    style="line-height: 18px;">info@ecohomes.com </span></p>
                            <p style="line-height: 18px; text-align: center;"><span
                                    style="line-height: 18px;">+2347038950658</span></p>
                        </div>
                    </div>
                </div>
                <div class="bee-col bee-col-4 bee-col-w3"></div>
            </div>
        </div>
        <div class="bee-row bee-row-15">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 120%; font-size: 12px; font-family: inherit; color: #868686;">
                            <p style="font-size: 14px; line-height: 16px; text-align: center;"><span
                                    style="font-size: 12px; line-height: 14px;"><?= date('Y') ?> © All Rights
                                    Reserved</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-16">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-icons">
                        <div class="bee-icon bee-icon-last">
                            <div class="bee-content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// Set headers for HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
