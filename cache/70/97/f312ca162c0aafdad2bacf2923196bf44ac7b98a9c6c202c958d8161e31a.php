<?php

/* notfound.twig */
class __TwigTemplate_7097f312ca162c0aafdad2bacf2923196bf44ac7b98a9c6c202c958d8161e31a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\">
        <meta description=\"\">
        <meta keywords=\"\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Страница не найдена - Посуточно73</title>
        <base href=\"";
        // line 10
        if (isset($context["siteRoot"])) { $_siteRoot_ = $context["siteRoot"]; } else { $_siteRoot_ = null; }
        echo twig_escape_filter($this->env, $_siteRoot_, "html", null, true);
        echo "\">        
    </head>
    <body>
        <p>Страница не найдена</p>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "notfound.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 10,  19 => 1,);
    }
}
