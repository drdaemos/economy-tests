<?php

/* default/project.twig */
class __TwigTemplate_ceb5e405cdca639d1d15d07b9c06e35153022ec88f2947c3cab06df9af24fd83 extends Twig_Template
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
        echo "\t<div style=\"text-align:center;\">
\t<h2>Design Sketch</h2>
\t<img src=\"assets/img/FRWL_Design.png\" style=\"width:50%;padding:15px; border:1px dashed #777;\">
\t<h2>Use Case Diagram</h2>
\t<img src=\"assets/img/FRWL_UseCase.png\" style=\"width:50%;padding:15px; border:1px dashed #777;\">
\t<h2>Regression Activity Diagram</h2>
\t<img src=\"assets/img/FRWL_Activity.png\" style=\"width:50%;padding:15px; border:1px dashed #777;\">\t
\t<h2>Page Sequence Diagram</h2>
\t<img src=\"assets/img/FRWL_Sequence.png\" style=\"width:50%;padding:15px; border:1px dashed #777;\">
\t<h2>Class Diagram</h2>
\t<img src=\"assets/img/FRWL_Class.png\" style=\"width:100%; padding:15px; border:1px dashed #777;\">

";
    }

    public function getTemplateName()
    {
        return "default/project.twig";
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
