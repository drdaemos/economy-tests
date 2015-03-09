<?php

/* master.twig */
class __TwigTemplate_252ea096fb844a6b0883c53023a33ab4161db8aa3bc3d47e668834964dbfaf8e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'header' => array($this, 'block_header'),
            'aside' => array($this, 'block_aside'),
            'page' => array($this, 'block_page'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
\t<head>
\t\t";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 10
        echo "\t</head>
\t<body>
\t\t";
        // line 12
        $this->displayBlock('header', $context, $blocks);
        // line 15
        echo "
\t\t<div class=\"container content-block\">\t
\t\t\t<div class=\"row\">
\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t";
        // line 19
        $this->displayBlock('aside', $context, $blocks);
        // line 21
        echo "\t\t\t
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-9\">\t\t\t\t
\t\t\t\t\t <h3> ";
        // line 24
        if (isset($context["title"])) { $_title_ = $context["title"]; } else { $_title_ = null; }
        echo twig_escape_filter($this->env, $_title_, "html", null, true);
        echo "</h3>  \t\t\t\t\t\t
\t\t\t\t\t <hr>\t\t
\t\t\t\t\t";
        // line 26
        $this->displayBlock('page', $context, $blocks);
        // line 27
        echo "\t
\t\t\t\t</div>\t\t
\t\t\t</div>\t
\t\t\t<hr>
\t\t\t
\t\t\t";
        // line 32
        $this->displayBlock('footer', $context, $blocks);
        // line 35
        echo "\t\t</div>
\t</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "\t\t\t<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
\t\t\t<meta charset=\"utf-8\">
\t\t\t<title>";
        // line 7
        if (isset($context["title"])) { $_title_ = $context["title"]; } else { $_title_ = null; }
        echo twig_escape_filter($this->env, $_title_, "html", null, true);
        echo " - 2003-2013 Economy Dynamics</title>
\t\t\t";
        // line 8
        $this->env->loadTemplate("layout/head.twig")->display($context);
        // line 9
        echo "\t\t";
    }

    // line 12
    public function block_header($context, array $blocks = array())
    {
        // line 13
        echo "\t\t\t\t";
        $this->env->loadTemplate("layout/header.twig")->display($context);
        echo "         
\t\t";
    }

    // line 19
    public function block_aside($context, array $blocks = array())
    {
        // line 20
        echo "\t\t\t\t\t\t";
        $this->env->loadTemplate("layout/aside.twig")->display($context);
        echo "         
\t\t\t\t\t";
    }

    // line 26
    public function block_page($context, array $blocks = array())
    {
        echo "  
\t\t\t\t\t";
    }

    // line 32
    public function block_footer($context, array $blocks = array())
    {
        // line 33
        echo "\t\t\t\t\t";
        $this->env->loadTemplate("layout/footer.twig")->display($context);
        echo "         
\t\t\t";
    }

    public function getTemplateName()
    {
        return "master.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 33,  118 => 32,  111 => 26,  104 => 20,  101 => 19,  94 => 13,  91 => 12,  87 => 9,  85 => 8,  80 => 7,  76 => 5,  73 => 4,  67 => 35,  65 => 32,  58 => 27,  56 => 26,  50 => 24,  45 => 21,  43 => 19,  37 => 15,  35 => 12,  31 => 10,  29 => 4,  24 => 1,);
    }
}
