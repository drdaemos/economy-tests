<?php

/* default/clusters.twig */
class __TwigTemplate_74a24179053556012ac76f2c1cc7ce420813afdeb6b0aadfaf310fe29e311e04 extends Twig_Template
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
        echo "<div id=\"cluster-chart\" style=\"height:800px; width:100%;\"></div>

<script type=\"text/javascript\">
\$(document).ready(function(){
\t

\t\$.when(\$.getJSON(\"api/getdata\"), \$.getJSON(\"api/getkmeanstest\")).then(buildChart, function(data){
\t\tconsole.log(data);
\t}); 
});

function buildChart(dataReq, clustersReq){
    var datarows = dataReq[0];
    var clusters = clustersReq[0];
    var countrycolors = [];
    for(i = 1; i < 15; i++){
        countrycolors[i] = 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')';
    }
    var clusterAvg = [];
\tvar sets = [];
\tfor(var cluster in clusters){
        var avg = 0.0;
\t\tvar data = [];
\t\tfor(var item in clusters[cluster]){
\t\t\tvar value = clusters[cluster][item];
            avg += parseFloat(datarows[value].gni);


\t\t\tdata[data.length] = {color: countrycolors[datarows[value].country_id], x:parseFloat(datarows[value].date), y:parseFloat(datarows[value].gni)};
\t\t}
        avg /= parseFloat(clusters.length);
        clusterAvg[clusterAvg.length] = avg;
\t\tsets[sets.length] = {
            name: \"Cluster #\"+cluster,
            // color: 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')',
            data: data
        }
\t}
    for(var cl in clusterAvg){
        \$(\"#analysis\").append(\"<p>Cluster #\"+cl+\" avg - \"+clusterAvg[cl]+\"</p>\");
    }

\t//-----
\t\$('#cluster-chart').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'GNI over years for various countries'
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
        return "default/clusters.twig";
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
