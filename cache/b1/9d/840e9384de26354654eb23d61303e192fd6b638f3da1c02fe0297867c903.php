<?php

/* default/input.twig */
class __TwigTemplate_b19d840e9384de26354654eb23d61303e192fd6b638f3da1c02fe0297867c903 extends Twig_Template
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
        echo "
\t";
        // line 5
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        if ($_data_) {
            // line 6
            echo "\t";
            if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_data_);
            foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
                // line 7
                echo "\t<h3>";
                if (isset($context["country"])) { $_country_ = $context["country"]; } else { $_country_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_, "name"), "html", null, true);
                echo "</h3>
\t<table class=\"table\">
\t\t<tr>
\t\t\t<th>#</th>
\t\t\t<th>Date</th>
\t\t\t<th>WPI</th>
\t\t\t<th>CPI</th>
\t\t\t<th>Unemployment</th>
\t\t\t<th>Net lending/borrowing</th>
\t\t\t<th>GDP</th>
\t\t\t<th>GNI</th>
\t\t</tr>

\t\t";
                // line 20
                if (isset($context["country"])) { $_country_ = $context["country"]; } else { $_country_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_country_, "data"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 21
                    echo "\t\t<tr>
\t\t\t<td>";
                    // line 22
                    if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index"), "html", null, true);
                    echo "</td>
\t\t\t<td>";
                    // line 23
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "date"), 4), "html", null, true);
                    echo "</td>
\t\t\t<td>";
                    // line 24
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "wpi"), 4), "html", null, true);
                    echo "</td>
\t\t\t<td>";
                    // line 25
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "cpi"), 4), "html", null, true);
                    echo "</td>
\t\t\t<td>";
                    // line 26
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "unemployment"), 4), "html", null, true);
                    echo "</td>
\t\t\t<td>";
                    // line 27
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "net"), 4), "html", null, true);
                    echo "</td>\t\t
\t\t\t<td>";
                    // line 28
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "gdp"), 4), "html", null, true);
                    echo "</td>\t
\t\t\t<td>";
                    // line 29
                    if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                    echo twig_escape_filter($this->env, twig_round($this->getAttribute($_item_, "gni"), 4), "html", null, true);
                    echo "</td>
\t\t</tr>
\t\t";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 32
                echo "\t</table>
\t<hr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "\t";
        }
        // line 36
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/input.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 36,  143 => 35,  135 => 32,  117 => 29,  112 => 28,  107 => 27,  102 => 26,  97 => 25,  92 => 24,  87 => 23,  82 => 22,  79 => 21,  61 => 20,  43 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
