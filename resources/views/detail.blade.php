@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/image-crop-styles.css') }}">
    <form action="{{ url('/export') }}" method="get" enctype="multipart/form-data">
        <section class="news-text">
            <div class="news-center-left">
                <div class="news-center-left-head">
                    <span class="news-back data-back">
                        <a href="javascript:history.go(-1);">
                            <i class="material-icons">arrow_back</i>Events
                        </a>
                    </span>
                    <div class="data-title"><span>  </span> <i class="material-icons">info_outline</i></div>
                </div>
            </div>
            <div class="details-center-right">
                <div class="detailsTitle">
                    <h1>Results</h1>
                    <span class="clickHide">
                        <i class="material-icons">keyboard_arrow_up</i>
                    </span>
                    <input type="submit" id="buttons" value="Download">
                    <select name="checkbox" id="downloadType">
                        <option value="0">Please select download type</option>
                        <option value="1">XML</option>
                        <option value="2">PDF</option>
                        <option value="3">XML and PDF</option>
                    </select>
                    <input type="hidden" id="img_id" name="event_id" value="{{$id}}">
                </div>
                <div class="allDataStatistics">
                    <div>
                        <p>Total Number of Photos</p>
                        <span id="allImageNumber">0</span>
                    </div>
                    <div>
                        <p>Total Faces Detected</p>
                        <span id="allCharacterNumber">0</span>
                    </div>
                    <div>
                        <p>Unique Faces</p>
                        <span id="NoRepeatCharacters">0</span>
                    </div>
                    <div>
                        <p>Repeating faces</p>
                        <span id="RepeatCharacters">0</span>
                    </div>
                </div>
                <div class="dataExhibition">
                    <div class="details-age">
                        <p>Age</p>
                        <div id="detailsAge"></div>
                    </div>

                    <div class="gender">
                        <p>Gender</p>
                        <div id="gender"></div>
                    </div>
                    <div class="race">
                        <p>Race</p>
                        <div id="race"></div>
                    </div>
                </div>
            </div>
            <div class="details-center-left-text">
                <div class="detailsEvents">
                    <p>Pictures</p>
                    <span class="selected" >View Selected</span>
                </div>
                <ul></ul>
            </div>
        </section>
    </form>
    <section class="character-data">
        <div class="background"></div>
        <div class="character-text">
            <i class="material-icons character-Close">clear</i>
            <h3>Demographics per picture</h3>
            <div class="character-text-left">
                <h6>Group</h6>
                <p id="GroupNumber"></p>
                <div class="Circular-data">
                    <div class="Circular-data-text">
                        <div id="circularAge"></div>
                        <i>Age</i>
                    </div>
                    <div class="Circular-data-text">
                        <div id="circularGender"></div>
                        <i>Gender</i>
                    </div>
                    <div class="Circular-data-text">
                        <div id="circularEthnicity"></div>
                        <i>Race</i>
                    </div>
                </div>
                <div id="personalData"><img src="" alt=""></div>
            </div>
            <div class="character-text-right">
                <h6>Individual</h6>
                <p>Select a face from the picture to view individual's metrices</p>
             {{--   <img src="" alt="">--}}
                <canvas id="myCanvas">

                </canvas>
                <div id="RunData"></div>
            </div>
        </div>
    </section>
    <section class="details-picture">
        <div class="background"></div>
        <div class="details-text">
            <i class="material-icons details-Close">clear</i>
            <div class="details-text-title">
                <p>Pictures:&numsp;<span id="detailsImgNumber">0</span> </p>
                <p>People detected:&numsp;<span id="detailsCharacterNumber">0</span> </p>
            </div>
            <div id="selectedAge"></div>
            <div id="selectedGender"></div>
            <div id="selectedRace"></div>
            <div class="clearfix"></div>

        </div>
    </section>
    <section class="activityInformation">
        <div class="background"></div>
        <div class="activityText">
            <i class="material-icons">clear</i>
            <h1></h1>
            <p></p>
            <div></div>
        </div>
    </section>
    @include('auth.setting')
@endsection
@section('pageEnd')
    @parent
    <script type="text/javascript" src="{{ asset('js/highcharts-more.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var resultsH =$(".details-center-right").height()+20;
            var detailsEventsT =$(".details-center-left-text").offset().top - 100;
            $(".clickHide").on("click",function () {
                var text=$(this).find("i").text();
                var WalkHow =resultsH-60;
                var muchHow =detailsEventsT - WalkHow;
                if(text=="keyboard_arrow_up"){
                    $(".details-center-right").animate({
                        height:60
                    },1000);
                    $(this).find("i").text("keyboard_arrow_down");
                    $(".details-center-left-text").animate({
                        top:muchHow
                    },1000)
                } else {
                    $(".details-center-right").animate({
                        height:resultsH
                    },1000);
                    $(this).find("i").text("keyboard_arrow_up");
                    $(".details-center-left-text").animate({
                        top:detailsEventsT
                    },1000)
                }
            });
            var  id = $('#img_id').val();
            console.log(id);
            $.ajax({
                url: '/details/' + id,
                type: "get",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    var females = 0,
                        men = 0,
                        low = 0,
                        middle = 0,
                        high = 0,
                        Asian = 0,
                        Hispanic = 0,
                        Africa = 0,
                        Caucasian = 0,
                        agetwenty = 0,
                        ByTwentyFive = 0,
                        ByThirty = 0,
                        ByThirtyFive = 0,
                        ByForty = 0,
                        ByFortyFive = 0,
                        ByFifty = 0,
                        ByFiftyFive = 0,
                        BySixty = 0,
                        thanSixty = 0;
                    // 渲染图片
                   $.each(data,function (key,val) {
                       var html = "<li>" +
                           "<input type='checkbox' class='checkbox' name='checkboxt'>" +
                           "<img class='img-Graphical' src='" + val.img_url + "' alt=''>" +
                           "<p>" + val.img_name + "</p>"+
                           "<i class='material-icons'>create</i>"+
                           "</li>";
                       $(".details-center-left-text").find("ul").append(html);
                       $(".activityText").find("h1").html(val.author.title);
                       $(".activityText").find("p").html(val.author.created_at);
                       $(".activityText").find("div").html(val.author.description);
                       $(".data-title").find("span").html(val.author.title)
                   });
                    // 统计所有图片的数据
                    $.each(data,function( AllObjects,AllData) {
                        if(AllData.child.face.length > 0){
                            $.each(AllData.child.face,function(singleObject,singleData) {
                                if (singleData.gender == "female") {females = females + 1;}
                                if (singleData.gender == "male") {men = men + 1;}
                                if (singleData.loyalty == "low") {low = low + 1;}
                                if (singleData.loyalty == "middle") {middle = middle + 1;}
                                if (singleData.loyalty == "high") {high = high + 1;}
                                if (singleData.race == "Caucasian") {Caucasian = Caucasian + 1;}
                                if (singleData.race == "African") {Africa = Africa + 1;}
                                if (singleData.race == "Asian") {Asian = Asian + 1;}
                                if (singleData.race == "Hispanic") {Hispanic = Hispanic + 1;}
                                if (singleData.age == "20-25") {ByTwentyFive = ByTwentyFive + 1}
                                if (singleData.age == "25-30") {ByThirty = ByThirty + 1}
                                if (singleData.age == "30-35") {ByThirtyFive = ByThirtyFive + 1}
                                if (singleData.age == "35-40") {ByForty = ByForty + 1}
                                if (singleData.age == "40-45") {ByFortyFive = ByFortyFive + 1}
                                if (singleData.age == "45-50") {ByFifty = ByFifty + 1}
                                if (singleData.age == "50-55") {ByFiftyFive = ByFiftyFive + 1}
                                if (singleData.age == "55-60") {BySixty = BySixty + 1}
                                if (singleData.age == "0-20") {agetwenty = agetwenty + 1}
                                if (singleData.age == ">60") {thanSixty = thanSixty + 1}
                            })
                        } else {
                            if (AllData.child.face.gender == "female") {females = females + 1;}
                            if (AllData.child.face.gender == "male") {men = men + 1;}
                            if (AllData.child.face.loyalty == "low") {low = low + 1;}
                            if (AllData.child.face.loyalty == "middle") {middle = middle + 1;}
                            if (AllData.child.face.loyalty == "high") {high = high + 1;}
                            if (AllData.child.face.race == "Caucasian") {Caucasian = Caucasian + 1;}
                            if (AllData.child.face.race == "African") {Africa = Africa + 1;}
                            if (AllData.child.face.race == "Asian") {Asian = Asian + 1;}
                            if (AllData.child.face.race == "Hispanic") {Hispanic = Hispanic + 1;}
                            if (AllData.child.face.age == "20-25") {ByTwentyFive = ByTwentyFive + 1}
                            if (AllData.child.face.age == "25-30") {ByThirty = ByThirty + 1}
                            if (AllData.child.face.age == "30-35") {ByThirtyFive = ByThirtyFive + 1}
                            if (AllData.child.face.age == "35-40") {ByForty = ByForty + 1}
                            if (AllData.child.face.age == "40-45") {ByFortyFive = ByFortyFive + 1}
                            if (AllData.child.face.age == "45-50") {ByFifty = ByFifty + 1}
                            if (AllData.child.face.age == "50-55") {ByFiftyFive = ByFiftyFive + 1}
                            if (AllData.child.face.age == "55-60") {BySixty = BySixty + 1}
                            if (AllData.child.face.age == "0-20") {agetwenty = agetwenty + 1}
                            if (AllData.child.face.age == ">60") {thanSixty = thanSixty + 1}
                        }

                    });
                    // 年龄 age
                    Highcharts.chart('detailsAge', {

                        title: {text: ''},
                        subtitle: {text: ''},
                        xAxis: {
                            categories: ['<20', '20-25', '25-30', '30-35', '35-40', '40-45', '45-50', '50-55', '55-60', '>60'],
                            labels: {rotation: 90, style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}}
                        },
                        yAxis: {
                            allowDecimals: false
                        },
                        series: [{
                            name: 'Number',
                            type: 'column',
                            colorByPoint: true,
                            data: [
                                {y: agetwenty, color: "#d3f2c1"},
                                {y: ByTwentyFive, color: "#ade58a"},
                                {y: ByThirty, color: "#9ae06e"},
                                {y: ByThirtyFive, color: "#78d43b"},
                                {y: ByForty, color: "#64c020"},
                                {y: ByFortyFive, color: "#5ab01c"},
                                {y: ByFifty, color: "#519e1a"},
                                {y: ByFiftyFive, color: "#488d17"},
                                {y: BySixty, color: "#346710"},
                                {y: thanSixty, color: "#204109"}
                            ],
                            showInLegend: false
                        }]
                    });
                    // 性别 gender
                    $('#gender').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            backgroundColor: "#fff"
                        },
                        title: {text: ''},
                        tooltip: {pointFormat: '<b>{point.percentage:.1f}%</b>'},
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
                                colors: ["#f05123", "#ff9e1a"]
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Browser share',
                            data: [
                                ['Male', men],
                                ['Female', females]

                            ]
                        }]
                    });
                    // 种族 Race
                    Highcharts.chart('race', {
                        title: {text: ''},
                        subtitle: {text: ''},
                        xAxis: {
                            categories: ['Asian', 'Hispanic', 'Africa', 'Caucasian'],
                            labels: {rotation: 0, style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}}
                        },
                        yAxis: {labels: {step: 1}},
                        series: [{
                            type: 'column',
                            colorByPoint: true,
                            data: [
                                {y: Asian, color: "#c3e4f7"},
                                {y: Hispanic, color: "#77c4ed"},
                                {y: Africa, color: "#1f8bc4"},
                                {y: Caucasian, color: "#0a5e8b"}
                            ],
                            showInLegend: false
                        }]
                    });
                    // 循环判断是否有数据
                    $.each(data, function (object, Whether) {
                        // 判断是否有年龄
                        if (Whether.author.average == 0) {
                            Highcharts.chart('detailsAge', {
                                title: {text: ''},
                                subtitle: {text: ''},
                                xAxis: {
                                    categories: ['<20', '20-25', '25-30', '30-35', '35-40', '40-45', '45-50', '50-55', '55-60', '>60'],
                                    labels: {rotation: 90, style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}}
                                },
                                yAxis: {labels: {step: 1}},
                                series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    data: [
                                        {y: 0, color: "#f0d6a4"},
                                        {y: 0, color: "#f8c35e"},
                                        {y: 0, color: "#f7b63a"},
                                        {y: 0, color: "#e49909"},
                                        {y: 0, color: "#cd8907"},
                                        {y: 0, color: "#b47805"},
                                        {y: 0, color: "#a16b04"},
                                        {y: 0, color: "#8a5b02"},
                                        {y: 0, color: "#764f03"},
                                        {y: 0, color: "#5c3f06"}
                                    ],
                                    showInLegend: false
                                }]
                            });
                        }
                        // 判断是否有性别
                        if (Whether.author.gender == 0) {

                            $('#gender').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
                                },
                                title: {text: ''},
                                tooltip: {pointFormat: '<b>{point.percentage:.1f}%</b>'},
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
                                        colors: ["#f05123", "#ff9e1a"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Browser share',
                                    data: [
                                        ['Male', 0],
                                        ['Female', 0]

                                    ]
                                }]
                            });
                        }
                        // 判断是否有种族
                        if (Whether.author.race == 0) {
                            Highcharts.chart('race', {
                                title: {text: ''},
                                subtitle: {text: ''},
                                xAxis: {
                                    categories: ['Asian', 'Hispanic', 'Africa', 'Caucasian'],
                                    labels: {rotation: 0, style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}}
                                },
                                yAxis: {labels: {step: 1}},
                                series: [{
                                    type: 'column', colorByPoint: true,
                                    data: [
                                        {y: 0, color: "#c3e4f7"},
                                        {y: 0, color: "#77c4ed"},
                                        {y: 0, color: "#1f8bc4"},
                                        {y: 0, color: "#0a5e8b"}
                                    ],
                                    showInLegend: false
                                }]
                            });
                        }
                    });
                    var imgNumber= $(".details-center-left-text").find("li").size();
                    var allCharacterNumber = females+men;
                    var RepeatCharacters = low + middle;
                    $("#allImageNumber").text(imgNumber);
                    $("#allCharacterNumber").text(allCharacterNumber);
                    $("#NoRepeatCharacters").text(high);
                    $("#RepeatCharacters").text(RepeatCharacters);
                    // 单个选中
                    $(".checkbox").on("click", function () {
                        var indexs = [];
                        $(".checkbox").each(function () {
                            if ($(this).prop("checked") == true) {
                                indexs.push($(this).parent().index());
                            }
                        });
                        var lengths=indexs.length;
                        if(lengths == 0 ){
                            $(".selected").css({backgroundColor:"#afb1b3"});
                        } else {
                            $(".selected").css({backgroundColor:"#2f9dd8"});
                        }
                        $("#detailsImgNumber").html(lengths);
                    });
                    // 选中图片相应的数据
                    $(".selected").on("click", function () {
                       // 添加数据
                        var indexs = [];
                        $("[name=checkboxt]").each(function () {
                            if ($(this).prop("checked") == true) {indexs.push($(this).parent().index());}
                        });
                        if(indexs.length == 0){return false;}
                        // 添加样式
                        $(".details-picture").css({display: "flex"});
                        $(".details-Close").on("click", function () {$(".details-picture").css({display: "none"})});
                        var selectedFemales = 0,
                            selectedMen = 0,
                            selectedCaucasian = 0,
                            selectedAfrica = 0,
                            selectedAsian = 0,
                            selectedHispanic = 0,
                            selectedByTwentyFive = 0,
                            selectedByThirty = 0,
                            selectedByThirtyFive = 0,
                            selectedByForty = 0,
                            selectedByFortyFive = 0,
                            selectedByFifty = 0,
                            selectedByFiftyFive = 0,
                            selectedBySixty = 0,
                            selectedAgetwenty = 0,
                            selectedThanSixty = 0;
                        $.each(indexs, function (name, index) {
                            if(data[index].child.face.length>0){
                                $.each(data[index].child.face, function (obj, seleData) {
                                    if (seleData.gender == "female") {selectedFemales = selectedFemales + 1;}
                                    if (seleData.gender == "male") {selectedMen = selectedMen + 1;}
                                    if (seleData.race == "Caucasian") {selectedCaucasian = selectedCaucasian + 1;}
                                    if (seleData.race == "African") {selectedAfrica = selectedAfrica + 1;}
                                    if (seleData.race == "Asian") {selectedAsian = selectedAsian + 1;}
                                    if (seleData.race == "Hispanic") {selectedHispanic = selectedHispanic + 1;}
                                    if (seleData.age == "20-25") {selectedByTwentyFive = selectedByTwentyFive + 1}
                                    if (seleData.age == "25-30") {selectedByThirty = selectedByThirty + 1}
                                    if (seleData.age == "30-35") {selectedByThirtyFive = selectedByThirtyFive + 1}
                                    if (seleData.age == "35-40") {selectedByForty = selectedByForty + 1}
                                    if (seleData.age == "40-45") {selectedByFortyFive = selectedByFortyFive + 1}
                                    if (seleData.age == "45-50") {selectedByFifty = selectedByFifty + 1}
                                    if (seleData.age == "50-55") {selectedByFiftyFive = selectedByFiftyFive + 1}
                                    if (seleData.age == "55-60") {selectedBySixty = selectedBySixty + 1}
                                    if (seleData.age == "0-20") {selectedAgetwenty = selectedAgetwenty + 1}
                                    if (seleData.age == ">60") {selectedThanSixty = selectedThanSixty + 1}
                                })
                            }else {
                                if (data[index].child.face.gender == "female") {selectedFemales = selectedFemales + 1;}
                                if (data[index].child.face.gender == "male") {selectedMen = selectedMen + 1;}
                                if (data[index].child.face.race == "Caucasian") {selectedCaucasian = selectedCaucasian + 1;}
                                if (data[index].child.face.race == "African") {selectedAfrica = selectedAfrica + 1;}
                                if (data[index].child.face.race == "Asian") {selectedAsian = selectedAsian + 1;}
                                if (data[index].child.face.race == "Hispanic") {selectedHispanic = selectedHispanic + 1;}
                                if (data[index].child.face.age == "20-25") {selectedByTwentyFive = selectedByTwentyFive + 1}
                                if (data[index].child.face.age == "25-30") {selectedByThirty = selectedByThirty + 1}
                                if (data[index].child.face.age == "30-35") {selectedByThirtyFive = selectedByThirtyFive + 1}
                                if (data[index].child.face.age == "35-40") {selectedByForty = selectedByForty + 1}
                                if (data[index].child.face.age == "40-45") {selectedByFortyFive = selectedByFortyFive + 1}
                                if (data[index].child.face.age == "45-50") {selectedByFifty = selectedByFifty + 1}
                                if (data[index].child.face.age == "50-55") {selectedByFiftyFive = selectedByFiftyFive + 1}
                                if (data[index].child.face.age == "55-60") {selectedBySixty = selectedBySixty + 1}
                                if (data[index].child.face.age == "0-20") {selectedAgetwenty = selectedAgetwenty + 1}
                                if (data[index].child.face.age == ">60") {selectedThanSixty = selectedThanSixty + 1}
                            }

                        });
                        var size = selectedFemales + selectedMen;
                        $("#detailsCharacterNumber").html(size);
                        // 统计选中图片的年龄数（age）
                        Highcharts.chart('selectedAge', {
                            title: {text: 'Age'},
                            subtitle: {text: ''},
                            xAxis: {
                                categories: ['<20', '20-25', '25-30', '30-35', '35-40', '40-45', '45-50', '50-55', '55-60', '>60'],
                                labels: {rotation: 90, style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}}
                            },
                            yAxis: {labels: {step: 1}},
                            series: [{
                                name: 'Number',
                                type: 'column',
                                colorByPoint: true,
                                data: [
                                    {y: selectedAgetwenty, color: "#d3f2c1"},
                                    {y: selectedByTwentyFive, color: "#ade58a"},
                                    {y: selectedByThirty, color: "#9ae06e"},
                                    {y: selectedByThirtyFive, color: "#78d43b"},
                                    {y: selectedByForty, color: "#64c020"},
                                    {y: selectedByFortyFive, color: "#5ab01c"},
                                    {y: selectedByFifty, color: "#519e1a"},
                                    {y: selectedByFiftyFive, color: "#488d17"},
                                    {y: selectedBySixty, color: "#346710"},
                                    {y: selectedThanSixty, color: "#204109"}],
                                showInLegend: false
                            }]
                        });
                        $('#selectedGender').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                backgroundColor: "#fff"
                            },
                            title: {text: 'Gender'},
                            tooltip: {pointFormat: '<b>{point.percentage:.1f}%</b>'},
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    borderWidth: 0,
                                    sdataLabels: {
                                        enabled: false,
                                        format: '{point.percentage:.1f} %',
                                        style: {
                                            "color": "#fff", "fontSize": "6px", "textOutline": "1px 1px contrast"
                                        },
                                        distance: -10,
                                        connectorPadding: 0
                                    },
                                    colors: ["#f05123", "#ff9e1a"]
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: 'Browser share',
                                data: [
                                    ['Male', selectedMen],
                                    ['Female', selectedFemales]

                                ]
                            }]
                        });
                        // 统计选中图片的种族数（race）
                        Highcharts.chart('selectedRace', {
                            title: {text: 'Race'},
                            subtitle: {text: ''},
                            xAxis: {
                                categories: ['Asian', 'Hispanic', 'Africa', 'Caucasian'],
                                labels: {rotation: 0, style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}}
                            },
                            yAxis: {labels: {step: 1}},
                            series: [{
                                name: 'Number',
                                type: 'column',
                                colorByPoint: true,
                                data: [
                                    {y: selectedAsian, color: "#c3e4f7"},
                                    {y: selectedHispanic, color: "#77c4ed"},
                                    {y: selectedAfrica, color: "#1f8bc4"},
                                    {y: selectedCaucasian, color: "#0a5e8b"}
                                ],
                                showInLegend: false
                            }]
                        });
                        //   判断是否有
                        $.each(data, function (name, number) {
                            // 判断是否有年龄
                                if (number.author.average == 0) {
                                Highcharts.chart('selectedAge', {
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
                                        type: 'column', colorByPoint: true,
                                        data: [
                                            {y: 0, color: "#d3f2c1"},
                                            {y: 0, color: "#ade58a"},
                                            {y: 0, color: "#9ae06e"},
                                            {y: 0, color: "#78d43b"},
                                            {y: 0, color: "#64c020"},
                                            {y: 0, color: "#5ab01c"},
                                            {y: 0, color: "#519e1a"},
                                            {y: 0, color: "#488d17"},
                                            {y: 0, color: "#346710"},
                                            {y: 0, color: "#204109"}],
                                        showInLegend: false
                                    }]
                                });
                            }
                            // 判断是否有性别
                                if (number.author.gender == 0) {
                                $('#gender').highcharts({
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        backgroundColor: "#fff"
                                    },
                                    title: {text: ''},
                                    tooltip: {pointFormat: '<b>{point.percentage:.1f}%</b>'},
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
                                            colors: ["#f05123", "#ff9e1a"]
                                        }
                                    },
                                    series: [{
                                        type: 'pie',
                                        name: 'Browser share',
                                        data: [
                                            ['Male', men],
                                            ['Female', females]

                                        ]
                                    }]
                                });
                                // Highcharts.chart('selectedGender', {
                                //     title: {text: 'Gender'},
                                //     subtitle: {text: ''},
                                //     xAxis: {
                                //         categories: ['men', 'female'],
                                //         labels: {
                                //             rotation: 0,
                                //             style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}
                                //         }
                                //     },
                                //     yAxis: {labels: {step: 1}},
                                //     series: [{
                                //         type: 'column', colorByPoint: true,
                                //         data: [
                                //             {y: 0, color: "#f05123"},
                                //             {y: 0, color: "#ff9e1a"}
                                //         ],
                                //         showInLegend: false
                                //     }]
                                // });
                            }
                            // 判断是否有忠诚度
                                if (number.author.loyalty == 0) {
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
                                            {y: 0, color: "#99e4cb"}, {y: 0, color: "#58e2b4"}, {y: 0, color: "#0af0a3"}
                                        ],
                                        showInLegend: false
                                    }]
                                });
                            }
                            // 判断是否有种族
                                if (number.author.race == 0) {
                                Highcharts.chart('selectedRace', {
                                    title: {text: 'Race'},
                                    subtitle: {text: ''},
                                    xAxis: {
                                        categories: ['Asian', 'Hispanic', 'Africa', 'Caucasian'],
                                        labels: {
                                            rotation: 0,
                                            style: {fontSize: '12px', fontFamily: 'Verdana, sans-serif'}
                                        }
                                    },
                                    yAxis: {labels: {step: 1}},
                                    series: [{
                                        type: 'column',
                                        colorByPoint: true,
                                        data: [
                                            {y: 0, color: "#c3e4f7"},
                                            {y: 0, color: "#77c4ed"},
                                            {y: 0, color: "#1f8bc4"},
                                            {y: 0, color: "#0a5e8b"}
                                        ],
                                        showInLegend: false
                                    }]
                                });
                            }
                        });
                    });
                    // 点击图片获取相应的数据
                    $(".details-center-left-text").find("ul").find("li").find("img").on("click", function (){
                        //    获取图片和名称
                        var imgsrc = $(this).attr("src");
                        var ptext = $(this).next().html();
                        $(".character-text-left").find("p").html(ptext);
                        $(".character-text-left").find("img").attr("src", imgsrc);
                        //    显示和关闭
                        $(".character-data").css({display: "flex"});
                        $(".character-Close").on("click", function () {
                            $(".character-data").css({display: "none"})
                        });

                        var imgIndex = $(this).parent().index();
                        $(".character-text-left").find("div").find("span").remove();
                        var imgFemales = 0,
                            imgMen = 0,
                            imgLow = 0,
                            imgMiddle = 0,
                            imgHigh = 0,
                            imgAsian = 0,
                            imgHispanic = 0,
                            imgAfrica = 0,
                            imgCaucasian = 0,
                            imgAgetwenty = 0,
                            imgByTwentyFive = 0,
                            imgByThirty = 0,
                            imgByThirtyFive = 0,
                            imgByForty = 0,
                            imgByFortyFive = 0,
                            imgByFifty = 0,
                            imgByFiftyFive = 0,
                            imgBySixty = 0,
                            imgThanSixty = 0;
                        if(data[imgIndex].child.face.length > 0){
                            var imgLefts = [];
                            var imgTops = [];
                            var imgWidths = [];
                            var imgHeights = [];
                            $.each(data[imgIndex].child.face, function (imgObject, imgData) {
                                if (imgData.position != '') {
                                    var positions = imgData.position.split(" ");
                                    var imgLeft = (positions[0]) * 100;
                                    var imgTop = (positions[1]) * 100;
                                    var imgWidth = (positions[2]) * 100;
                                    var imgHeight = (positions[3]) * 100;
                                    var div = "<span style='width:" + imgWidth + "%;height:" + imgHeight + "%;top:" + imgTop + "%;left:" + imgLeft + "%;position: absolute'></span>";
                                    $(".character-text-left").find("#personalData").append(div);
                                    imgLefts.push(imgLeft);
                                    imgTops.push(imgTop);
                                    imgWidths.push(imgWidth);
                                    imgHeights.push(imgHeight)
                                } else {
                                    return true;
                                }
                                if (imgData.gender == "female") {imgFemales = imgFemales + 1;}
                                if (imgData.gender == "male") {imgMen = imgMen + 1;}
                                if (imgData.loyalty == "low") {imgLow = glow + 1;}
                                if (imgData.loyalty == "middle") {imgMiddle = imgMiddle + 1;}
                                if (imgData.loyalty == "high") {imgHigh = imgHigh + 1;}
                                if (imgData.race == "Caucasian") {imgCaucasian = imgCaucasian + 1;}
                                if (imgData.race == "African") {imgAfrica = imgAfrica + 1;}
                                if (imgData.race == "Asian") {imgAsian = imgAsian + 1;}
                                if (imgData.race == "Hispanic") {imgHispanic = imgHispanic + 1;}
                                if (imgData.age == "20-25") {imgByTwentyFive = imgByTwentyFive + 1}
                                if (imgData.age == "25-30") {imgByThirty = imgByThirty + 1}
                                if (imgData.age == "30-35") {imgByThirtyFive = imgByThirtyFive + 1}
                                if (imgData.age == "35-40") {imgByForty = imgByForty + 1}
                                if (imgData.age == "40-45") {imgByFortyFive = imgByFortyFive + 1}
                                if (imgData.age == "45-50") {imgByFifty = imgByFifty + 1}
                                if (imgData.age == "50-55") {imgByFiftyFive = imgByFiftyFive + 1}
                                if (imgData.age == "55-60") {imgBySixty = imgBySixty + 1}
                                if (imgData.age == "0-20") {imgAgetwenty = imgAgetwenty + 1}
                                if (imgData.age == ">60") {imgThanSixty = imgThanSixty + 1}
                            });
                            var size = $(".character-text-left").find("div").find("span").size();
                            $(".character-text-left").find("#GroupNumber").html(size+"  people detected");

                            //    年龄的本分比（age Percentage）
                            if (imgAgetwenty != 0) {imgAgetwenty = (imgAgetwenty / size) * 100}
                            if (imgByTwentyFive != 0) {imgByTwentyFive = (imgByTwentyFive / size) * 100}
                            if (imgByThirty != 0) {imgByThirty = (imgByThirty / size) * 100}
                            if (imgByThirtyFive != 0) {imgByThirtyFive = (imgByThirtyFive / size) * 100}
                            if (imgByForty != 0) {imgByForty = (imgByForty / size) * 100}
                            if (imgByFortyFive != 0) {imgByFortyFive = (imgByFortyFive / size) * 100}
                            if (imgByFifty != 0) {imgByFifty = (imgByFifty / size) * 100}
                            if (imgByFiftyFive != 0) {imgByFiftyFive = (imgByFiftyFive / size) * 100}
                            if (imgBySixty != 0) {imgBySixty = (imgBySixty / size) * 100}
                            if (imgThanSixty != 0) {imgThanSixty = (imgThanSixty / size) * 100}
                            $('#circularAge').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
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
                                            distance: -10, connectorPadding: 0
                                        },
                                        colors: ["#d3f2c1", "#ade58a", "#9ae06e", "#78d43b", "#64c020", "#5ab01c",
                                            "#519e1a", "#488d17", "#346710", "#204109"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Number',
                                    data: [
                                        ['0-20', imgAgetwenty],
                                        ['20-25', imgByTwentyFive],
                                        ['25-30', imgByThirty],
                                        ['30-35', imgByThirtyFive],
                                        ['35-40', imgByForty],
                                        ['40-45', imgByFortyFive],
                                        ['45-50', imgByFifty],
                                        ['50-55', imgByFiftyFive],
                                        ['55-60', imgBySixty],
                                        ['>60', imgThanSixty]
                                    ]
                                }]
                            });
                            //    性别的半分比（Gender Percentage)
                            if (imgFemales != 0) {imgFemales = (imgFemales / size) * 100}
                            if (imgMen != 0) {imgMen = (imgMen / size) * 100}
                            $('#circularGender').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
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
                                            distance: -10,
                                            connectorPadding: 0
                                        },
                                        colors: ["#f05123", "#ff9e1a"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Number',
                                    data: [
                                        ['men', imgMen],
                                        ['females', imgFemales]

                                    ]
                                }]
                            });
                            //    种族的半分比（ race Percentage）
                            if (imgCaucasian != 0) {imgCaucasian = (imgCaucasian / size) * 100}
                            if (imgAfrica != 0) {imgAfrica = (imgAfrica / size) * 100}
                            if (imgAsian != 0) {imgAsian = (imgAsian / size) * 100}
                            if (imgHispanic != 0) {imgHispanic = (imgHispanic / size) * 100}
                            $('#circularEthnicity').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
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
                                            distance: -10,
                                            connectorPadding: 0
                                        },
                                        colors: ["#c3e4f7", "#77c4ed", "#1f8bc4", "#0a5e8b"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Number',
                                    data: [
                                        ['Caucasian', imgCaucasian],
                                        ['Africa', imgAfrica],
                                        ['Asian', imgAsian],
                                        ['Hispanic', imgHispanic]
                                    ]
                                }]
                            });
                            // 判断是否有
                            $.each(data, function (name, number) {
                                //  判断是否有年龄
                                if (number.author.average == 0) {
                                    $('#circularAge').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            backgroundColor: "#fff"
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
                                                    style: {
                                                        "color": "#fff",
                                                        "fontSize": "6px",
                                                        "textOutline": "1px 1px contrast"
                                                    },
                                                    distance: -10, connectorPadding: 0
                                                },
                                                colors: ["#f0d6a4", "#f8c35e", "#f7b63a", "#e49909", "#cd8907", "#b47805",
                                                    "#a16b04", "#8a5b02", "#764f03", "#5c3f06"]
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Number',
                                            data: [
                                                ['0-20', 0],
                                                ['20-25', 0],
                                                ['25-30', 0],
                                                ['30-35', 0],
                                                ['35-40', 0],
                                                ['40-45', 0],
                                                ['45-50', 0],
                                                ['50-55', 0],
                                                ['55-60', 0],
                                                ['>60', 0]
                                            ]
                                        }]
                                    });
                                }
                                //   判断是否有性别
                                if (number.author.gender == 0) {
                                    $('#circularGender').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            backgroundColor: "#fff"
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
                                                        "color": "#fff",
                                                        "fontSize": "6px",
                                                        "textOutline": "1px 1px contrast"
                                                    },
                                                    distance: -10,
                                                    connectorPadding: 0
                                                },
                                                colors: ["#2e9dd9", "#de443c"]
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Number',
                                            data: [
                                                ['men', 0],
                                                ['females', 0]

                                            ]
                                        }]
                                    });
                                }
                                // 判断是否有种族
                                if (number.author.race == 0) {
                                    $('#circularEthnicity').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            backgroundColor: "#fff"
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
                                                        "color": "#fff",
                                                        "fontSize": "6px",
                                                        "textOutline": "1px 1px contrast"
                                                    },
                                                    distance: -10,
                                                    connectorPadding: 0
                                                },
                                                colors: ["#e2e2e2", "#565553", "#ece165", "#81511c"]
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Number',
                                            data: [
                                                ['Caucasian', 0],
                                                ['Africa', 0],
                                                ['Asian', 0],
                                                ['Hispanic', 0]
                                            ]
                                        }]
                                    });
                                }
                            });
                            // 个人数据
                            var ageconf = Number(data[imgIndex].child.face[0].age_conf).toFixed(2);
                            var genderconf = Number(data[imgIndex].child.face[0].gender_conf).toFixed(2);
                            var loyaltyconf = Number(data[imgIndex].child.face[0].loyalty_conf).toFixed(2);
                            var ageValue = 0, genderValue = 0,  loyaltyValue = 0;
                            var gendercolors = "#de443c";
                            if (data[imgIndex].child.face[0].gender == "male") {
                                gendercolors = "#2e9dd9";
                            } else {
                                gendercolors = "#de443c";
                            }
                            $.each(data, function (name, number) {
                                /***********判断是否有年龄******************/
                                if (number.author.average == 0) {
                                    ageValue = 0;
                                } else {
                                    ageValue = ageconf;
                                }
                                /***********判断是否有性别******************/
                                if (number.author.gender == 0) {
                                    genderValue = 0
                                } else {
                                    genderValue = genderconf
                                }
                                /***********判断是否有种族******************/
                                if (number.author.race == 0) {
                                    loyaltyValue = 0
                                } else {
                                    loyaltyValue = loyaltyconf
                                }
                            });
                            var chart = Highcharts.chart('RunData', {
                                title: {text: ''},
                                subtitle: {text: ''},
                                xAxis: {categories: [data[imgIndex].child.face[0].age, data[imgIndex].child.face[0].gender, data[imgIndex].child.face[0].race, data[imgIndex].child.face[0].loyalty]},
                                bar: {dataLabels: {enabled: true}},
                                series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    data: [
                                        {y: 0, color: "#eca865"},
                                        {y: 0, color: gendercolors},
                                        {y: 0, color: "#e6d94c"}
                                    ],
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
                                chart: {inverted: true, polar: false},
                                subtitle: {text: ''}
                            });
                            // 点击个人头像获取相应的数据
                            $(".character-text-left").find("#personalData").find("span").on("click", function () {
                                var sizeIndex=$(this).index()-1;
                                var image=$("#personalData").find("img").attr("src");
                                var originImgWidth ;
                                var originImgHeigh ;
                                getImageWidth(image,function(w,h){
                                    return originImgWidth = w ,
                                        originImgHeigh = h;
                                });
                                var imgsX=imgLefts[sizeIndex]*originImgWidth/100.0;
                                var imgsY=imgTops[sizeIndex]*originImgHeigh/100.0;
                                var imgsWidth=imgWidths[sizeIndex]*originImgWidth/100.0;
                                var imgsHeight=imgHeights[sizeIndex]*originImgHeigh/100.0;
                                function drawBeauty(image){
                                    var mycv = document.getElementById("myCanvas");
                                    var myctx = mycv.getContext("2d");
                                    myctx.drawImage(image,
                                        imgsX,
                                        imgsY,
                                        imgsWidth,
                                        imgsHeight,
                                        0,
                                        0,
                                        300,
                                        162
                                    );
                                }
                                function load(){
                                    var beauty = new Image();
                                    beauty.src = image;
                                    if(beauty.complete){
                                        drawBeauty(beauty);

                                    }else{
                                        beauty.onload = function(){
                                            drawBeauty(beauty);
                                        };
                                        beauty.onerror = function(){
                                        };
                                    }
                                }
                                load();
                                function getImageWidth(url,callback){
                                    var img = new Image();
                                    img.src = url;
                                    if(img.complete){
                                        callback(img.width, img.height);
                                    }else{
                                        img.onload = function(){
                                            callback(img.width, img.height);
                                        }
                                    }
                                }
                                $(this).addClass("PersonalDetails").siblings().removeClass("PersonalDetails");
                                var personalIndex = $(this).index() - 1;
                                var personalAgeConf = Number(data[imgIndex].child.face[personalIndex].age_conf).toFixed(2);
                                var personalGenderConf = Number(data[imgIndex].child.face[personalIndex].gender_conf).toFixed(2);
                                var personalReceConf = Number(data[imgIndex].child.face[personalIndex].race_conf).toFixed(2);
                                var personalAgeValue = 0, personalGenderValue = 0, personalGraceValue = 0;
                                $.each(data, function (name, number) {
                                    if (number.author.average == 0) {personalAgeValue = 0;} else {personalAgeConf = personalAgeConf;}
                                    if (number.author.gender == 0) {personalGenderValue = 0;} else {personalGenderConf = personalGenderConf;}
                                    if (number.author.loyalty == 0) {personalGraceValue = 0} else {personalReceConf = personalReceConf}
                                });
                                var chart = Highcharts.chart('RunData', {
                                    title: {text: ''},
                                    subtitle: {text: ''},
                                    xAxis: {categories: [data[imgIndex].child.face[personalIndex].age, data[imgIndex].child.face[personalIndex].gender, data[imgIndex].child.face[personalIndex].race, data[imgIndex].child.face[personalIndex].loyalty]},
                                    bar: {dataLabels: {enabled: true}},
                                    series: [{
                                        type: 'column',
                                        colorByPoint: true,
                                        data: [{y: Number(personalAgeConf), color: "#9ae06e"},
                                            {y: Number(personalGenderConf), color: "#f05123"},
                                            {y: Number(personalReceConf), color: "#0a5e8b"}
                                        ],
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
                            $(".character-text-left").find("#personalData").find("span:first").trigger("click");
                        } else {
                            var imgLefts = [];
                            var imgTops = [];
                            var imgWidths = [];
                            var imgHeights = [];
                            if (data[imgIndex].child.face.position != '') {
                                var positions = data[imgIndex].child.face.position.split(" ");
                                var imgLeft = (positions[0]) * 100;
                                var imgTop = (positions[1]) * 100;
                                var imgWidth = (positions[2]) * 100;
                                var imgHeight = (positions[3]) * 100;
                                var div = "<span style='width:" + imgWidth + "%;height:" + imgHeight + "%;top:" + imgTop + "%;left:" + imgLeft + "%;position: absolute'></span>";
                                $(".character-text-left").find("#personalData").append(div);
                                imgLefts.push(imgLeft);
                                imgTops.push(imgTop);
                                imgWidths.push(imgWidth);
                                imgHeights.push(imgHeight)
                            } else {
                                return true;
                            }
                            if (data[imgIndex].child.face.gender == "female") {imgFemales = imgFemales + 1;}
                            if (data[imgIndex].child.face.gender == "male") {imgMen = imgMen + 1;}
                            if (data[imgIndex].child.face.loyalty == "low") {imgLow = glow + 1;}
                            if (data[imgIndex].child.face.loyalty == "middle") {imgMiddle = imgMiddle + 1;}
                            if (data[imgIndex].child.face.loyalty == "high") {imgHigh = imgHigh + 1;}
                            if (data[imgIndex].child.face.race == "Caucasian") {imgCaucasian = imgCaucasian + 1;}
                            if (data[imgIndex].child.face.race == "African") {imgAfrica = imgAfrica + 1;}
                            if (data[imgIndex].child.face.race == "Asian") {imgAsian = imgAsian + 1;}
                            if (data[imgIndex].child.face.race == "Hispanic") {imgHispanic = imgHispanic + 1;}
                            if (data[imgIndex].child.face.age == "20-25") {imgByTwentyFive = imgByTwentyFive + 1}
                            if (data[imgIndex].child.face.age == "25-30") {imgByThirty = imgByThirty + 1}
                            if (data[imgIndex].child.face.age == "30-35") {imgByThirtyFive = imgByThirtyFive + 1}
                            if (data[imgIndex].child.face.age == "35-40") {imgByForty = imgByForty + 1}
                            if (data[imgIndex].child.face.age == "40-45") {imgByFortyFive = imgByFortyFive + 1}
                            if (data[imgIndex].child.face.age == "45-50") {imgByFifty = imgByFifty + 1}
                            if (data[imgIndex].child.face.age == "50-55") {imgByFiftyFive = imgByFiftyFive + 1}
                            if (data[imgIndex].child.face.age == "55-60") {imgBySixty = imgBySixty + 1}
                            if (data[imgIndex].child.face.age == "0-20") {imgAgetwenty = imgAgetwenty + 1}
                            if (data[imgIndex].child.face.age == ">60") {imgThanSixty = imgThanSixty + 1}

                            var size = $(".character-text-left").find("div").find("span").size();
                            $(".character-text-left").find("#GroupNumber").html(size+"  people detected");
                            //    年龄的本分比（age Percentage）
                            if (imgAgetwenty != 0) {imgAgetwenty = (imgAgetwenty / size) * 100}
                            if (imgByTwentyFive != 0) {imgByTwentyFive = (imgByTwentyFive / size) * 100}
                            if (imgByThirty != 0) {imgByThirty = (imgByThirty / size) * 100}
                            if (imgByThirtyFive != 0) {imgByThirtyFive = (imgByThirtyFive / size) * 100}
                            if (imgByForty != 0) {imgByForty = (imgByForty / size) * 100}
                            if (imgByFortyFive != 0) {imgByFortyFive = (imgByFortyFive / size) * 100}
                            if (imgByFifty != 0) {imgByFifty = (imgByFifty / size) * 100}
                            if (imgByFiftyFive != 0) {imgByFiftyFive = (imgByFiftyFive / size) * 100}
                            if (imgBySixty != 0) {imgBySixty = (imgBySixty / size) * 100}
                            if (imgThanSixty != 0) {imgThanSixty = (imgThanSixty / size) * 100}
                            $('#circularAge').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
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
                                            distance: -10, connectorPadding: 0
                                        },
                                        colors: ["#d3f2c1", "#ade58a", "#9ae06e", "#78d43b", "#64c020", "#5ab01c",
                                            "#519e1a", "#488d17", "#346710", "#204109"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Number',
                                    data: [
                                        ['0-20', imgAgetwenty],
                                        ['20-25', imgByTwentyFive],
                                        ['25-30', imgByThirty],
                                        ['30-35', imgByThirtyFive],
                                        ['35-40', imgByForty],
                                        ['40-45', imgByFortyFive],
                                        ['45-50', imgByFifty],
                                        ['50-55', imgByFiftyFive],
                                        ['55-60', imgBySixty],
                                        ['>60', imgThanSixty]
                                    ]
                                }]
                            });
                            //    性别的半分比（Gender Percentage)
                            if (imgFemales != 0) {imgFemales = (imgFemales / size) * 100}
                            if (imgMen != 0) {imgMen = (imgMen / size) * 100}
                            $('#circularGender').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
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
                                            distance: -10,
                                            connectorPadding: 0
                                        },
                                        colors: ["#f05123", "#ff9e1a"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Number',
                                    data: [
                                        ['men', imgMen],
                                        ['females', imgFemales]

                                    ]
                                }]
                            });
                            //    种族的半分比（ race Percentage）
                            if (imgCaucasian != 0) {imgCaucasian = (imgCaucasian / size) * 100}
                            if (imgAfrica != 0) {imgAfrica = (imgAfrica / size) * 100}
                            if (imgAsian != 0) {imgAsian = (imgAsian / size) * 100}
                            if (imgHispanic != 0) {imgHispanic = (imgHispanic / size) * 100}
                            $('#circularEthnicity').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    backgroundColor: "#fff"
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
                                            distance: -10,
                                            connectorPadding: 0
                                        },
                                        colors: ["#c3e4f7", "#77c4ed", "#1f8bc4", "#0a5e8b"]
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Number',
                                    data: [
                                        ['Caucasian', imgCaucasian],
                                        ['Africa', imgAfrica],
                                        ['Asian', imgAsian],
                                        ['Hispanic', imgHispanic]
                                    ]
                                }]
                            });
                            // 判断是否有
                            $.each(data, function (name, number) {
                              //  判断是否有年龄
                                if (number.author.average == 0) {
                                    $('#circularAge').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            backgroundColor: "#fff"
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
                                                    style: {
                                                        "color": "#fff",
                                                        "fontSize": "6px",
                                                        "textOutline": "1px 1px contrast"
                                                    },
                                                    distance: -10, connectorPadding: 0
                                                },
                                                colors: ["#f0d6a4", "#f8c35e", "#f7b63a", "#e49909", "#cd8907", "#b47805",
                                                    "#a16b04", "#8a5b02", "#764f03", "#5c3f06"]
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Number',
                                            data: [
                                                ['0-20', 0],
                                                ['20-25', 0],
                                                ['25-30', 0],
                                                ['30-35', 0],
                                                ['35-40', 0],
                                                ['40-45', 0],
                                                ['45-50', 0],
                                                ['50-55', 0],
                                                ['55-60', 0],
                                                ['>60', 0]
                                            ]
                                        }]
                                    });
                                }
                              //   判断是否有性别
                                if (number.author.gender == 0) {
                                    $('#circularGender').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            backgroundColor: "#fff"
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
                                                        "color": "#fff",
                                                        "fontSize": "6px",
                                                        "textOutline": "1px 1px contrast"
                                                    },
                                                    distance: -10,
                                                    connectorPadding: 0
                                                },
                                                colors: ["#2e9dd9", "#de443c"]
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Number',
                                            data: [
                                                ['men', 0],
                                                ['females', 0]

                                            ]
                                        }]
                                    });
                                }
                              // 判断是否有种族
                                if (number.author.race == 0) {
                                    $('#circularEthnicity').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            backgroundColor: "#fff"
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
                                                        "color": "#fff",
                                                        "fontSize": "6px",
                                                        "textOutline": "1px 1px contrast"
                                                    },
                                                    distance: -10,
                                                    connectorPadding: 0
                                                },
                                                colors: ["#e2e2e2", "#565553", "#ece165", "#81511c"]
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Number',
                                            data: [
                                                ['Caucasian', 0],
                                                ['Africa', 0],
                                                ['Asian', 0],
                                                ['Hispanic', 0]
                                            ]
                                        }]
                                    });
                                }
                            });
                            // 个人数据
                            var ageconf = Number(data[imgIndex].child.face.age_conf).toFixed(2);
                            var genderconf = Number(data[imgIndex].child.face.gender_conf).toFixed(2);
                            var loyaltyconf = Number(data[imgIndex].child.face.loyalty_conf).toFixed(2);
                            var ageValue = 0, genderValue = 0,  loyaltyValue = 0;
                            var gendercolors = "#de443c";
                            if (data[imgIndex].child.face.gender == "male") {
                                gendercolors = "#2e9dd9";
                            } else {
                                gendercolors = "#de443c";
                            }
                            $.each(data, function (name, number) {
                                /***********判断是否有年龄******************/
                                if (number.author.average == 0) {
                                    ageValue = 0;
                                } else {
                                    ageValue = ageconf;
                                }
                                /***********判断是否有性别******************/
                                if (number.author.gender == 0) {
                                    genderValue = 0
                                } else {
                                    genderValue = genderconf
                                }
                                /***********判断是否有种族******************/
                                if (number.author.race == 0) {
                                    loyaltyValue = 0
                                } else {
                                    loyaltyValue = loyaltyconf
                                }
                            });
                            var chart = Highcharts.chart('RunData', {
                                title: {text: ''},
                                subtitle: {text: ''},
                                xAxis: {categories: [data[imgIndex].child.face.age, data[imgIndex].child.face.gender, data[imgIndex].child.face.race, data[imgIndex].child.face.loyalty]},
                                bar: {dataLabels: {enabled: true}},
                                series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    data: [
                                        {y: 0, color: "#eca865"},
                                        {y: 0, color: gendercolors},
                                        {y: 0, color: "#e6d94c"}
                                    ],
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
                                chart: {inverted: true, polar: false},
                                subtitle: {text: ''}
                            });
                            // 点击个人头像获取相应的数据
                            $(".character-text-left").find("#personalData").find("span").on("click", function () {
                                var sizeIndex=$(this).index()-1;
                                var image=$("#personalData").find("img").attr("src");
                                var originImgWidth ;
                                var originImgHeigh ;
                                getImageWidth(image,function(w,h){
                                    return originImgWidth = w ,
                                        originImgHeigh = h;
                                });
                                var imgsX=imgLefts[sizeIndex]*originImgWidth/100.0;
                                var imgsY=imgTops[sizeIndex]*originImgHeigh/100.0;
                                var imgsWidth=imgWidths[sizeIndex]*originImgWidth/100.0;
                                var imgsHeight=imgHeights[sizeIndex]*originImgHeigh/100.0;
                                function drawBeauty(image){
                                    var mycv = document.getElementById("myCanvas");
                                    var myctx = mycv.getContext("2d");
                                    myctx.drawImage(image,
                                        imgsX,
                                        imgsY,
                                        imgsWidth,
                                        imgsHeight,
                                        0,
                                        0,
                                        300,
                                        162
                                    );
                                }
                                function load(){
                                    var beauty = new Image();
                                    beauty.src = image;
                                    if(beauty.complete){
                                        drawBeauty(beauty);

                                    }else{
                                        beauty.onload = function(){
                                            drawBeauty(beauty);
                                        };
                                        beauty.onerror = function(){
                                        };
                                    }
                                }
                                load();
                                function getImageWidth(url,callback){
                                    var img = new Image();
                                    img.src = url;
                                    if(img.complete){
                                        callback(img.width, img.height);
                                    }else{
                                        img.onload = function(){
                                            callback(img.width, img.height);
                                        }
                                    }
                                }
                                $(this).addClass("PersonalDetails").siblings().removeClass("PersonalDetails");
                                var personalAgeConf = Number(data[imgIndex].child.face.age_conf).toFixed(2);
                                var personalGenderConf = Number(data[imgIndex].child.face.gender_conf).toFixed(2);
                                var personalReceConf = Number(data[imgIndex].child.face.race_conf).toFixed(2);
                                var personalAgeValue = 0, personalGenderValue = 0, personalGraceValue = 0;
                                $.each(data, function (name, number) {
                                    if (number.author.average == 0) {personalAgeValue = 0;} else {personalAgeConf = personalAgeConf;}
                                    if (number.author.gender == 0) {personalGenderValue = 0;} else {personalGenderConf = personalGenderConf;}
                                    if (number.author.loyalty == 0) {personalGraceValue = 0} else {personalReceConf = personalReceConf}
                                });
                                var chart = Highcharts.chart('RunData', {
                                    title: {text: ''},
                                    subtitle: {text: ''},
                                    xAxis: {categories: [data[imgIndex].child.face.age, data[imgIndex].child.face.gender, data[imgIndex].child.face.race, data[imgIndex].child.face.loyalty]},
                                    bar: {dataLabels: {enabled: true}},
                                    series: [{
                                        type: 'column',
                                        colorByPoint: true,
                                        data: [{y: Number(personalAgeConf), color: "#9ae06e"},
                                            {y: Number(personalGenderConf), color: "#f05123"},
                                            {y: Number(personalReceConf), color: "#0a5e8b"}
                                        ],
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
                            $(".character-text-left").find("#personalData").find("span:first").trigger("click");
                        }
                    });
                },
                error: function () {
                    alert("Failed to load")
                }
            });

        });


    </script>
@stop
