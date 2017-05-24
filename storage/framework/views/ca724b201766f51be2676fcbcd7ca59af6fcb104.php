<?php $__env->startSection('content'); ?>
    <section class="news-text">
        <div class="news-center-left">
            <div class="news-center-left-head">
                <a href="javascript:history.go(-1);">
                    <span class="news-back">
                        <img src="<?php echo e(asset('image/fanhui.png')); ?>" alt=""><span>Back</span>
                    </span>
                </a>
                <span class="selected">View selected</span>
            </div>
            <textarea name="" id="textarea" disabled="disabled">
        </textarea>
            <div class="details-center-left-text">
                <ul></ul>
            </div>
        </div>
        <div class="details-center-right">
            <h1>Result</h1>
            <div class="details-age">
                <div id="detailsAge"></div>
            </div>
            <div class="gender-loyalty">
                <div id="gender"></div>
                <div id="loyalty"></div>
            </div>
            <div id="race"></div>
            <input type="button" id="buttons" value="Download">
        </div>
    </section>
    <section class="details-picture">
        <div class="background"></div>
        <img class="details-Close" src="<?php echo e(asset('image/close.png')); ?>" alt="">
        <div class="details-text">
            <div id="selectedAge"></div>
            <div id="selectedGender"></div>
            <div id="selectedRace"></div>
            <div class="clearfix"></div>
            <p>15 people delected in selected </p>
        </div>
    </section>

    <section class="character-data">
        <div class="background"></div>
        <img class="character-Close" src="<?php echo e(asset('image/close.png')); ?>" alt="">
        <div class="character-text">
            <h3></h3>
            <div class="character-text-left">
                <div>
                    <img src="" alt="">
                </div>

                <p></p>
                <?php /*<div id="FigureOne"></div>*/ ?>
            </div>
            <div class="character-text-right">
                <div class="Circular-data">
                    <div class="Circular-data-text">
                        <div id="circularAge"></div>
                        <p>Age</p>
                    </div>
                    <div class="Circular-data-text">
                        <div id="circularGender"></div>
                        <p>Gender</p>
                    </div>
                    <div class="Circular-data-text">
                        <div id="circularEthnicity"></div>
                        <p>Race</p>
                    </div>
                </div>
                <div id="RunData"></div>
            </div>
        </div>
    </section>
    <input type="hidden" id="img_id" value="<?php echo e($id); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageEnd'); ?>
    @parent
    <script type="text/javascript">
        $(function () {
            id = $('#img_id').val();
            $.ajax({
                url: '/details/' + id,
                type: "get",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    var females = 0, men = 0, low = 0, middle = 0, high = 0, Asian = 0, Hispanic = 0, Africa = 0, Caucasian = 0
                        , agetwenty = 0, ByTwentyFive = 0, ByThirty = 0, ByThirtyFive = 0, ByForty = 0, ByFortyFive = 0
                        , ByFifty = 0, ByFiftyFive = 0, BySixty = 0, thanSixty = 0;
                    $.each(data.list, function (key, val) {
                        var html = "<li>" +
                            "<input type='checkbox' class='checkbox' name='checkboxt'>" +
                            "<img class='img-Graphical' src='" + val.img_url + "' alt=''>" +
                            "<p>" + val.img_name + "</p>" +
                            "</li>";
                        $(".details-center-left-text").find("ul").append(html);
                        $("#textarea").html(val.author.description)
                    });

                    $(".details-center-left-text").find("ul").find("li").find("img").on("click", function () {
                        /*============获取图片和名称==================*/
                        var imgsrc = $(this).attr("src");
                        var ptext = $(this).next().html();
                        $(".character-text-left").find("p").html(ptext);
                        $(".character-text-left").find("img").attr("src", imgsrc);
                        /* =============显示和关闭===============*/
                        $(".character-data").css({display: "block"});
                        $(".character-Close").on("click", function () {
                            $(".character-data").css({display: "none"})
                        });
                        /*=============自动居中=====================*/
                        var imgH = $(".character-text").height();
                        var dH = ($(window).height() - imgH) / 2;
                        var dW = ($(window).width() - 1030) / 2;
                        $('.character-text').css({left: dW, top: dH});
                        var index = $(this).parent().index();
                        $(".character-text-left").find("div").find("span").remove();
                        /*==============对应的数据===============*/
                        var gfemales = 0, gmen = 0, glow = 0, gmiddle = 0, ghigh = 0, gAsian = 0, gHispanic = 0, gAfrica = 0, gCaucasian = 0
                            , gagetwenty = 0, gByTwentyFive = 0, gByThirty = 0, gByThirtyFive = 0, gByForty = 0, gByFortyFive = 0
                            , gByFifty = 0, gByFiftyFive = 0, gBySixty = 0, gthanSixty = 0;
                        $.each(data.list_a[index], function (d, s) {
                            $.each(s, function (f, z) {
                                var positions = z.position.split(" ");
                                var lefts = (positions[0]) * 100;
                                var tops = (positions[1]) * 100;
                                var kuis = (positions[2]) * 100;
                                var gaos = (positions[3]) * 100;
                                var div = "<span style='width:" + kuis + "%;height:" + gaos + "%;top:" + tops + "%;left:" + lefts + "%;position: absolute'></span>";
                                $(".character-text-left").find("div").append(div);
                                /***************判断所对应的数据**************************/
                                if (z.gender == "female") {
                                    gfemales = gfemales + 1;
                                }
                                if (z.gender == "male") {
                                    gmen = gmen + 1;
                                }
                                if (z.loyalty <= 0.3) {
                                    glow = glow + 1;
                                }
                                if (z.loyalty > 0.3 && z.loyalty <= 0.7) {
                                    gmiddle = gmiddle + 1;
                                }
                                if (z.loyalty > 0.7) {
                                    ghigh = ghigh + 1;
                                }
                                if (z.race == "Caucasian") {
                                    gCaucasian = gCaucasian + 1;
                                }
                                if (z.race == "African") {
                                    gAfrica = gAfrica + 1;
                                }
                                if (z.race == "Asian") {
                                    gAsian = gAsian + 1;
                                }
                                if (z.race == "Hispanic") {
                                    gHispanic = gHispanic + 1;
                                }
                                if (z.age == "20-25") {
                                    gByTwentyFive = gByTwentyFive + 1
                                }
                                if (z.age == "25-30") {
                                    gByThirty = gByThirty + 1
                                }
                                if (z.age == "30-35") {
                                    gByThirtyFive = gByThirtyFive + 1
                                }
                                if (z.age == "35-40") {
                                    gByForty = gByForty + 1
                                }
                                if (z.age == "40-45") {
                                    gByFortyFive = gByFortyFive + 1
                                }
                                if (z.age == "45-50") {
                                    gByFifty = gByFifty + 1
                                }
                                if (z.age == "50-55") {
                                    gByFiftyFive = gByFiftyFive + 1
                                }
                                if (z.age == "55-60") {
                                    gBySixty = gBySixty + 1
                                }
                                if (z.age == "0-20") {
                                    gagetwenty = gagetwenty + 1
                                }
                                if (z.age == ">60") {
                                    gthanSixty = gthanSixty + 1
                                }
                            });
                            /*   console.log(s[0]);
                             console.log(s[0].age);*/

                            var chart = Highcharts.chart('RunData', {
                                title: {text: ''},
                                subtitle: {text: ''},
                                xAxis: {categories: [s[0].age, s[0].gender, s[0].race, s[0].loyalty]},
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                },
                                series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    data: [{y: 0.95, color: "#eca865"}, {y: 0.48, color: "#de443c"}, {
                                        y: 0.64,
                                        color: "#e6d94c"
                                    }, {
                                        y: 0.5,
                                        color: "#58e2b4"
                                    }],
                                    showInLegend: false
                                }],
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            align: 'left',
                                            enabled: true
                                        }
                                    }
                                }
                            });
                            chart.update({
                                chart: {
                                    inverted: true,
                                    polar: false
                                },
                                subtitle: {
                                    text: ''
                                }
                            });
                            $(".character-text-left").find("div").find("span").on("click", function () {
                                $(this).addClass("PersonalDetails").siblings().removeClass("PersonalDetails");
                                var indexs = $(this).index() - 1;
                                var chart = Highcharts.chart('RunData', {
                                    title: {text: ''},
                                    subtitle: {text: ''},
                                    xAxis: {categories: [s[indexs].age, s[indexs].gender, s[indexs].race, s[indexs].loyalty]},
                                    bar: {dataLabels: {enabled: true}},
                                    series: [{
                                        type: 'column',
                                        colorByPoint: true,
                                        data: [{y: 0.95, color: "#eca865"}, {y: 0.48, color: "#de443c"}, {
                                            y: 0.64,
                                            color: "#e6d94c"
                                        }, {
                                            y: 0.5,
                                            color: "#58e2b4"
                                        }],
                                        showInLegend: false
                                    }],
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                align: 'left',
                                                enabled: true
                                            }
                                        }
                                    }
                                });
                                chart.update({
                                    chart: {
                                        inverted: true,
                                        polar: false
                                    },
                                    subtitle: {
                                        text: ''
                                    }
                                });
                            });
                        });
                        var size = $(".character-text-left").find("div").find("span").size();
                        $(".character-text").find('h3').html(size + "people  delected");
                        /*****************年龄的本分比（age Percentage）**********************/
                        if (gByTwentyFive != 0) {
                            gByTwentyFive = (gByTwentyFive / size) * 100
                        }
                        if (gByThirty != 0) {
                            gByThirty = (gByThirty / size) * 100
                        }
                        if (gByThirtyFive != 0) {
                            gByThirtyFive = (gByThirtyFive / size) * 100
                        }
                        if (gByForty != 0) {
                            gByForty = (gByForty / size) * 100
                        }
                        if (gByFortyFive != 0) {
                            gByFortyFive = (gByFortyFive / size) * 100
                        }
                        if (gByFifty != 0) {
                            gByFifty = (gByFifty / size) * 100
                        }
                        if (gByFiftyFive != 0) {
                            gByFiftyFive = (gByFiftyFive / size) * 100
                        }
                        if (gBySixty != 0) {
                            gBySixty = (gBySixty / size) * 100
                        }
                        if (gagetwenty != 0) {
                            gagetwenty = (gagetwenty / size) * 100
                        }
                        if (gthanSixty != 0) {
                            gthanSixty = (gthanSixty / size) * 100
                        }
                        $('#circularAge').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                backgroundColor: "#f1f1f1"
                            },
                            title: {text: ''},
                            tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: false, format: '{point.percentage:.1f} %',
                                        style: {"color": "#fff", "fontSize": "6px", "textOutline": "1px 1px contrast"},
                                        distance: -10, connectorPadding: 0
                                    },
                                    colors: ["#f0d6a4", "#f8c35e", "#f7b63a", "#e49909", "#cd8907", "#b47805",
                                        "#a16b04", "#8a5b02", "#764f03", "#5c3f06"]
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: 'Browser share',
                                data: [
                                    ['0-20', gagetwenty],
                                    ['20-25', gByTwentyFive],
                                    ['25-30', gByThirty],
                                    ['30-35', gByThirtyFive],
                                    ['35-40', gByForty],
                                    ['40-45', gByFortyFive],
                                    ['45-50', gByFifty],
                                    ['50-55', gByFiftyFive],
                                    ['55-60', gBySixty],
                                    ['>60', gthanSixty]
                                ]
                            }]
                        });
                        /*******************种族的半分比（ race Percentage）********************************/
                        if (gCaucasian != 0) {
                            gCaucasian = (gCaucasian / size) * 100
                        }
                        if (gAfrica != 0) {
                            gAfrica = (gAfrica / size) * 100
                        }
                        if (gAsian != 0) {
                            gAsian = (gAsian / size) * 100
                        }
                        if (gHispanic != 0) {
                            gHispanic = (gHispanic / size) * 100
                        }
                        $('#circularEthnicity').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                backgroundColor: "#f1f1f1"
                            },
                            title: {text: ''},
                            tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: false,
                                        format: '{point.percentage:.1f} %',
                                        style: {
                                            "color": "#fff", "fontSize": "6px", "textOutline": "1px 1px contrast"
                                        },
                                        distance: -10,
                                        connectorPadding: 0
                                    },
                                    colors: ["#e2e2e2", "#565553", "#ece165", "#81511c"]
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: 'Browser share',
                                data: [
                                    ['Caucasian', gCaucasian],
                                    ['Africa', gAfrica],
                                    ['Asian', gAsian],
                                    ['Hispanic', gHispanic]
                                ]
                            }]
                        });
                        /*****************性别的半分比（Gender Percentage）**********************/
                        if (gfemales != 0) {
                            gfemales = (gfemales / size) * 100
                        }
                        if (gmen != 0) {
                            gmen = (gmen / size) * 100
                        }
                        $('#circularGender').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                backgroundColor: "#f1f1f1"
                            },
                            title: {
                                text: ''
                            },
                            tooltip: {
                                pointFormat: '{series.name}:<b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: false,
                                        format: '{point.percentage:.1f} %',
                                        style: {
                                            "color": "#fff", "fontSize": "6px", "textOutline": "1px 1px contrast"
                                        },
                                        distance: -10,
                                        connectorPadding: 0
                                    },
                                    colors: ["#2e9dd9", "#de443c"]
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: 'Browser share',
                                data: [
                                    ['men', gmen],
                                    ['females', gfemales]

                                ]
                            }]
                        });
                        /****************点击个人数据********************************/
                        $(".character-text-left").find("div").find("span").eq(0).addClass("PersonalDetails");

                    });
                    /*==================所有图片的数据统计==================*/
                    $.each(data.list_a, function (k, y) {
                        $.each(y.face, function (s, z) {
                            if (z.gender == "female") {
                                females = females + 1;
                            }
                            if (z.gender == "male") {
                                men = men + 1;
                            }
                            if (z.loyalty <= 0.3) {
                                low = low + 1;
                            }
                            if (z.loyalty > 0.3 && z.loyalty <= 0.7) {
                                middle = middle + 1;
                            }
                            if (z.loyalty > 0.7) {
                                high = high + 1;
                            }
                            if (z.race == "Caucasian") {
                                Caucasian = Caucasian + 1;
                            }
                            if (z.race == "African") {
                                Africa = Africa + 1;
                            }
                            if (z.race == "Asian") {
                                Asian = Asian + 1;
                            }
                            if (z.race == "Hispanic") {
                                Hispanic = Hispanic + 1;
                            }
                            if (z.age == "20-25") {
                                ByTwentyFive = ByTwentyFive + 1
                            }
                            if (z.age == "25-30") {
                                ByThirty = ByThirty + 1
                            }
                            if (z.age == "30-35") {
                                ByThirtyFive = ByThirtyFive + 1
                            }
                            if (z.age == "35-40") {
                                ByForty = ByForty + 1
                            }
                            if (z.age == "40-45") {
                                ByFortyFive = ByFortyFive + 1
                            }
                            if (z.age == "45-50") {
                                ByFifty = ByFifty + 1
                            }
                            if (z.age == "50-55") {
                                ByFiftyFive = ByFiftyFive + 1
                            }
                            if (z.age == "55-60") {
                                BySixty = BySixty + 1
                            }
                            if (z.age == "0-20") {
                                agetwenty = agetwenty + 1
                            }
                            if (z.age == ">60") {
                                thanSixty = thanSixty + 1
                            }
                        })
                    });
                    /*================年龄 age=====================*/
                    Highcharts.chart('detailsAge', {
                        title: {text: 'Age'},
                        subtitle: {text: ''},
                        xAxis: {
                            categories: ['<20', '20-25', '25-30', '30-35', '35-40', '40-45', '45-50', '50-55', '55-60', '>60'],
                            labels: {
                                rotation: 90,
                                style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}
                            }
                        },
                        yAxis: {labels: {step: 1}},
                        series: [{
                            type: 'column',
                            colorByPoint: true,
                            data: [{y: agetwenty, color: "#f0d6a4"}, {y: ByTwentyFive, color: "#f8c35e"}, {
                                y: ByThirty,
                                color: "#f7b63a"
                            },
                                {y: ByThirtyFive, color: "#e49909"}, {y: ByForty, color: "#cd8907"},
                                {y: ByFortyFive, color: "#b47805"}, {y: ByFifty, color: "#a16b04"}, {
                                    y: ByFiftyFive,
                                    color: "#8a5b02"
                                },
                                {y: BySixty, color: "#764f03"}, {y: thanSixty, color: "#5c3f06"}],
                            showInLegend: false
                        }]
                    });
                    /*================性别 gender =================*/
                    Highcharts.chart('gender', {
                        title: {text: 'Gender'},
                        subtitle: {text: ''},
                        xAxis: {
                            categories: ['men', 'female'],
                            labels: {
                                rotation: 0,
                                style: {
                                    fontSize: '12px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {labels: {step: 1}},
                        series: [{
                            type: 'column',
                            colorByPoint: true,
                            data: [
                                {y: men, color: "#2e9dd9"}, {y: females, color: "#de443c"}
                            ],
                            showInLegend: false
                        }]
                    });
                    /*================忠诚度 loyalty =================*/
                    Highcharts.chart('loyalty', {
                        title: {text: 'Loyalty'},
                        subtitle: {text: ''},
                        xAxis: {
                            categories: ['low', 'middle', 'high'],
                            labels: {
                                rotation: 0,
                                style: {
                                    fontSize: '12px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {labels: {step: 1}},
                        series: [{
                            type: 'column',
                            colorByPoint: true,
                            data: [
                                {y: low, color: "#99e4cb"}, {y: middle, color: "#58e2b4"}, {y: high, color: "#0af0a3"}
                            ],
                            showInLegend: false
                        }]
                    });
                    /*================种族 Race==================*/
                    Highcharts.chart('race', {
                        title: {text: 'Race'},
                        subtitle: {text: ''},
                        xAxis: {
                            categories: ['Asian', 'Hispanic', 'Africa', 'Caucasian'],
                            labels: {
                                rotation: 0,
                                style: {
                                    fontSize: '12px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {labels: {step: 1}},
                        series: [{
                            type: 'column',
                            colorByPoint: true,
                            data: [
                                {y: Asian, color: "#ece165"}, {y: Hispanic, color: "#81511c"}, {
                                    y: Africa,
                                    color: "#565553"
                                }, {
                                    y: Caucasian,
                                    color: "#e2e2e2"
                                }
                            ],
                            showInLegend: false
                        }]
                    });


                    $(".selected").on("click", function () {
                        /*************添加样式******************/
                        $(".details-picture").css({display: "block"});
                        var imgH = $(".details-text").height();
                        var dH = ($(window).height() - imgH) / 2;
                        var dW = ($(window).width() - 1180) / 2;
                        $(".details-text").css({left: dW, top: dH});
                        $(".details-Close").on("click", function () {
                            $(".details-picture").css({display: "none"})
                        });
                        /**************添加数据*************************/
                        var indexs = [];
                        $("[name=checkboxt]").each(function () {
                            if ($(this).prop("checked") == true) {
                                indexs.push($(this).parent().index());
                            }
                        });
                        var tfemales = 0, tmen = 0, tCaucasian = 0, tAfrica = 0, tAsian = 0, tHispanic = 0, tByTwentyFive = 0,
                            tByThirty = 0, ttByThirtyFive = 0, tByForty = 0,
                            tByFortyFive = 0, tByFifty = 0, tByFiftyFive = 0, tBySixty = 0, tagetwenty = 0, tthanSixty = 0;
                        $.each(indexs, function (n, l) {
                            $.each(data.list_a[l], function (n, t) {
                                $.each(t, function (k, m) {
                                    if (m.gender == "female") {
                                        tfemales = tfemales + 1;
                                    }
                                    if (m.gender == "male") {
                                        tmen = tmen + 1;
                                    }
                                    if (m.race == "Caucasian") {
                                        tCaucasian = tCaucasian + 1;
                                    }
                                    if (m.race == "African") {
                                        tAfrica = tAfrica + 1;
                                    }
                                    if (m.race == "Asian") {
                                        tAsian = tAsian + 1;
                                    }
                                    if (m.race == "Hispanic") {
                                        tHispanic = tHispanic + 1;
                                    }
                                    if (m.age == "20-25") {
                                        tByTwentyFive = tByTwentyFive + 1
                                    }
                                    if (m.age == "25-30") {
                                        tByThirty = tByThirty + 1
                                    }
                                    if (m.age == "30-35") {
                                        ttByThirtyFive = ttByThirtyFive + 1
                                    }
                                    if (m.age == "35-40") {
                                        tByForty = tByForty + 1
                                    }
                                    if (m.age == "40-45") {
                                        tByFortyFive = tByFortyFive + 1
                                    }
                                    if (m.age == "45-50") {
                                        tByFifty = tByFifty + 1
                                    }
                                    if (m.age == "50-55") {
                                        tByFiftyFive = tByFiftyFive + 1
                                    }
                                    if (m.age == "55-60") {
                                        tBySixty = tBySixty + 1
                                    }
                                    if (m.age == "0-20") {
                                        tagetwenty = tagetwenty + 1
                                    }
                                    if (m.age == ">60") {
                                        tthanSixty = tthanSixty + 1
                                    }
                                })
                            })
                        });
                        /******************统计选中图片的年龄数（age）**********************/
                        Highcharts.chart('selectedAge', {
                            title: {
                                text: 'Age'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: ['<20', '20-25', '25-30', '30-35', '35-40', '40-45', '45-50', '50-55', '55-60', '>60'],
                                labels: {
                                    rotation: 90,
                                    style: {
                                        fontSize: '12px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {labels: {step: 1}},
                            series: [{
                                type: 'column',
                                colorByPoint: true,
                                data: [{y: tagetwenty, color: "#f0d6a4"}, {
                                    y: tByTwentyFive,
                                    color: "#f8c35e"
                                }, {y: tByThirty, color: "#f7b63a"},
                                    {y: ttByThirtyFive, color: "#e49909"}, {y: tByForty, color: "#cd8907"},
                                    {y: tByFortyFive, color: "#b47805"}, {
                                        y: tByFifty,
                                        color: "#a16b04"
                                    }, {y: tByFiftyFive, color: "#8a5b02"},
                                    {y: tBySixty, color: "#764f03"}, {y: tthanSixty, color: "#5c3f06"}],
                                showInLegend: false
                            }]
                        });
                        /*********************统计选中图片的性别数（cender）************************/
                        Highcharts.chart('selectedGender', {
                            title: {
                                text: 'Gender'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: ['men', 'female'],
                                labels: {
                                    rotation: 0,
                                    style: {
                                        fontSize: '12px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {labels: {step: 1}},
                            series: [{
                                type: 'column',
                                colorByPoint: true,
                                data: [
                                    {y: tmen, color: "#2e9dd9"}, {y: tfemales, color: "#de443c"}
                                ],
                                showInLegend: false
                            }]
                        });
                        /*********************统计选中图片的种族数（race）************************/
                        Highcharts.chart('selectedRace', {
                            title: {
                                text: 'Race'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: ['Asian', 'Hispanic', 'Africa', 'Caucasian'],
                                labels: {
                                    rotation: 0,
                                    style: {
                                        fontSize: '12px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {labels: {step: 1}},
                            series: [{
                                type: 'column',
                                colorByPoint: true,
                                data: [
                                    {y: tAsian, color: "#ece165"}, {y: tHispanic, color: "#81511c"}, {
                                        y: tAfrica,
                                        color: "#565553"
                                    }, {
                                        y: tCaucasian,
                                        color: "#e2e2e2"
                                    }
                                ],
                                showInLegend: false
                            }]
                        });
                    });


                },
                error: function () {
                    alert("Failed to load")
                }
            });

        });


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>