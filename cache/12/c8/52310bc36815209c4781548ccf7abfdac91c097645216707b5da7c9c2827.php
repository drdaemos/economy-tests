<?php

/* default/index.twig */
class __TwigTemplate_12c852310bc36815209c4781548ccf7abfdac91c097645216707b5da7c9c2827 extends Twig_Template
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
        echo "<p>Hello, this is a fundamental economy analyzer for various macroeconomic indices across such countries as Russia, USA, Germany, Greece, Ukraine.</p>
<p>Used macroeconomic indices are:
\t<ul>
\t\t<li>Wholesale Price Index (WPI)
\t\t<li>Consumer Price Index (CPI) 
\t\t<li>Unemployment Rate 
\t\t<li>GDP per capita in PPP 
\t\t<li>GNI per capita in PPP
\t\t<li>Government Debt Net Lending/Borrowing 
\t</ul>
</p>
<p>The main hypothesis is that GNI value (and GDP) is highly dependent on other mentioned value, and we can calculate a trend to be able to predict its dynamics and future values. We're also can estimate economy situation throughout various countries using all these indices. You know, just to be sure the country and its leader is on the right track.</p>
<p>Secondly, we want to check if this data can be clusterized to at least 3 clusters, which will separate countries by their economy class.</p>
<p>P.S. If you are anyhow interested in this system, or wishing to improve it, feel free to write us an email: <a href=\"mailto:drdaemos@gmail.com\">drdaemos@gmail.com</a>

";
    }

    public function getTemplateName()
    {
        return "default/index.twig";
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
