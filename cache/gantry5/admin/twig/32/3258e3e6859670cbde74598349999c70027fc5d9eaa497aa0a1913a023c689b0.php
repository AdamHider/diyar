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

/* forms/fields/gantry/module.html.twig */
class __TwigTemplate_8af1a35985c106a7de2be6d8732156072c8f16479efd8aae1934a53eb21baacd extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'input' => [$this, 'block_input'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate(((($context["default"] ?? null)) ? ("partials/field.html.twig") : ((("forms/" . (((isset($context["layout"]) || array_key_exists("layout", $context))) ? (_twig_default_filter(($context["layout"] ?? null), "field")) : ("field"))) . ".html.twig"))), "forms/fields/gantry/module.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_input($context, array $blocks = [])
    {
        // line 4
        echo "    <input
            type=\"text\"
            name=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . ($context["name"] ?? null))));
        echo "\"
            value=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_join_filter(($context["value"] ?? null), ", "));
        echo "\"
            ";
        // line 9
        echo "            ";
        $this->displayBlock("global_attributes", $context, $blocks);
        echo "
            ";
        // line 11
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "pattern", [], "any", true, true)) {
            echo "pattern=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "pattern", []), "html", null, true);
            echo "\"";
        }
        // line 12
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "disabled", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "disabled=\"disabled\"";
        }
        // line 13
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "required", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "required=\"required\"";
        }
        // line 14
        echo "            />
    <span class=\"button\" data-g-instancepicker=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_jsonencode_filter(["type" => "module", "return" => true, "field" => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . ($context["name"] ?? null)))]), "html_attr");
        echo "\">";
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["field"] ?? null), "picker_label", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["field"] ?? null), "picker_label", []), "Pick a Module")) : ("Pick a Module")), "html", null, true);
        echo "</span>
";
    }

    public function getTemplateName()
    {
        return "forms/fields/gantry/module.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 15,  75 => 14,  70 => 13,  65 => 12,  58 => 11,  53 => 9,  49 => 7,  45 => 6,  41 => 4,  38 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "forms/fields/gantry/module.html.twig", "W:\\Isell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\forms\\fields\\gantry\\module.html.twig");
    }
}
