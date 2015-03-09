<?php

/* default/regression.twig */
class __TwigTemplate_31da388f325b104011fa6333f404b73af9bd9b64a90621c1dc9f809b3f80b81b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("master.twig");

        $this->blocks = array(
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page($context, array $blocks = array())
    {
        // line 4
        echo "<div id=\"countries-view\">
\t

</div>

<!-- scripts -->
<script type=\"text/javascript\">
\$(document).ready(function(){
\t\$.when(\$.getJSON(\"/api/getRegressionTest\")).then(processTest);
\t
});
function processTest(testData){
\tfor(var country in testData){
\t\tbuildWidget(testData[country]);
\t}\t
}
function buildWidget(country){
\tvar output = \"<h3>\" + country.name + \"</h3>\";
\toutput \t  += \"<div id='chartarea-\"+country.id+\"' style='height:400px; width:100%;'></div>\";
\toutput    += \"<p>y = \";
\tfor(var coeff in country.regression.coefficients){\t
\t\toutput += parseFloat(country.regression.coefficients[coeff]).toFixed(3)+\"*x<sub>\"+coeff+\"</sub> + \";
\t}
    output    += \"<br>R<sup>2</sup> = \"+parseFloat(country.regression.rsquare).toFixed(3);
    output    += \"<br>SSE = \"+parseFloat(country.regression.SSE).toFixed(3);
    output    += \"<br>SSR = \"+parseFloat(country.regression.SSR).toFixed(3);
\toutput    += \"<hr>\";
\tvar values = [93.4636,95.087,4.6,-2.4942];
\tvar coeffs = country.regression.coefficients;
\t\$(\"#countries-view\").append(output);
\tbuildChart(\"#chartarea-\"+country.id, country.data, country.regression1d.coefficients);
}
function calcY(values, coeffs){
\tvar result = coeffs[0];
\tfor (var i = 0; i < values.length; i++) {
\t\tresult += parseFloat(coeffs[i+1])*parseFloat(values[i]);
\t};
\treturn result;
}
function buildChart(view, testData, regr){
\tvar sets = [];
\tvar data = [];
\tfor(var item in testData){
\t\tvar value = item;
\t\tdata[data.length] = {x:parseFloat(testData[value].date), y:parseFloat(testData[value].gni)};
\t}
\tsets[sets.length] = {
        name: \"GNI\",
        color: 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')',
        data: data
    }
    var start = {x:2002, y:calcY([2002], regr)};    
    var end = {x:2014, y:calcY([2014], regr)};

    data = [start,end];
    sets[sets.length] = {
        name: \"GNI trend\",
        color: 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')',
        data: data
    }
    \$(view).highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'GNI'
        },
        subtitle: {
            text: 'Source: World Bank'
        },
        xAxis: {
            title: {
                enabled: true,
                text: 'Years'
            },
            startOnTick: true,
            endOnTick: true,
            showLastLabel: true
        },
        yAxis: {
            title: {
                text: 'GNI per capita, PPP (\$)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 100,
            y: 70,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
            borderWidth: 1
        },
        plotOptions: {
            scatter: {
            \tlineWidth: 3,
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x}, {point.y} \$'
                }
            }
        },
        series: sets
    });
}
</script>
";
    }

    public function getTemplateName()
    {
        return "default/regression.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
