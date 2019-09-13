<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @particles/contenttabs.html.twig */
class __TwigTemplate_4acad02b444103a1314712c5a9857ab565493433562d7a34a51aefcee67892e1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'particle' => [$this, 'block_particle'],
            'javascript' => [$this, 'block_javascript'],
            'javascript_footer' => [$this, 'block_javascript_footer'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/contenttabs.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "
    <div class=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\">
        ";
        // line 6
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>";
        }
        // line 7
        echo "
        <div class=\"g-contenttabs\">
            <div id=\"g-contenttabs-";
        // line 9
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" class=\"g-contenttabs-container\">
                <ul class=\"g-contenttabs-tab-wrapper-container\">

                    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", []));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "                        <li class=\"g-contenttabs-tab-wrapper\">
                            <span class=\"g-contenttabs-tab-wrapper-head\">
                                <a class=\"g-contenttabs-tab\" href=\"#g-contenttabs-item-";
            // line 15
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", []), "html", null, true);
            echo "\">
                                    <span class=\"g-contenttabs-tab-title\">";
            // line 16
            echo $this->getAttribute($context["item"], "title", []);
            echo "</span>
                                </a>
                            </span>
                        </li>
                    ";
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
        // line 21
        echo "
                </ul>

                <div class=\"clearfix\"></div>

                <ul class=\"g-contenttabs-content-wrapper-container\">

                    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", []));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 29
            echo "                        <li class=\"g-contenttabs-tab-wrapper\">
                            <div class=\"g-contenttabs-tab-wrapper-body\">
                                <div id=\"g-contenttabs-item-";
            // line 31
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", []), "html", null, true);
            echo "\" class=\"g-contenttabs-content\">
                                    ";
            // line 32
            echo $this->getAttribute($context["item"], "content", []);
            echo "
                                </div>
                            </div>
                        </li>
                    ";
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
        // line 37
        echo "
                </ul>
                <div class=\"clearfix\"></div>
            </div>
        </div>
    </div>

";
    }

    // line 46
    public function block_javascript($context, array $blocks = [])
    {
        // line 47
        echo "    ";
        $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery"], "method");
        // line 48
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/juitabs.js"), "html", null, true);
        echo "\"></script>
";
    }

    // line 51
    public function block_javascript_footer($context, array $blocks = [])
    {
        // line 52
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function () {
            jQuery('#g-contenttabs-";
        // line 54
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "').tabs({
                show: {
                    ";
        // line 56
        if ((((($this->getAttribute(($context["particle"] ?? null), "animation", []) == "up") || ($this->getAttribute(($context["particle"] ?? null), "animation", []) == "down")) || ($this->getAttribute(($context["particle"] ?? null), "animation", []) == "left")) || ($this->getAttribute(($context["particle"] ?? null), "animation", []) == "right"))) {
            // line 57
            echo "                    effect: 'slide',
                    direction: '";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "animation", []), "html", null, true);
            echo "',
                    ";
        } else {
            // line 60
            echo "                    effect: '";
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "animation", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "animation", []), "slide")) : ("slide")), "html", null, true);
            echo "',
                    ";
        }
        // line 62
        echo "                    duration: 500
                }
            });
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "@particles/contenttabs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 62,  214 => 60,  209 => 58,  206 => 57,  204 => 56,  199 => 54,  195 => 52,  192 => 51,  185 => 48,  182 => 47,  179 => 46,  168 => 37,  149 => 32,  143 => 31,  139 => 29,  122 => 28,  113 => 21,  94 => 16,  88 => 15,  84 => 13,  67 => 12,  61 => 9,  57 => 7,  51 => 6,  47 => 5,  44 => 4,  41 => 3,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/contenttabs.html.twig", "W:\\iSell\\www\\diyar\\templates\\g5_helium\\particles\\contenttabs.html.twig");
    }
}
