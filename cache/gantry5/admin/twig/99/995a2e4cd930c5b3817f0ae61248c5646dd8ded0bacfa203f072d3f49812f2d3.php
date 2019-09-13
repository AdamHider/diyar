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

/* forms/fields/input/text.html.twig */
class __TwigTemplate_1001ae732af70cc315b1c4722db748c9ddf335cbee80e66367effc8171f6bbbe extends \Twig\Template
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
        return "forms/fields/input/group/group.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("forms/fields/input/group/group.html.twig", "forms/fields/input/text.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_input($context, array $blocks = [])
    {
        // line 4
        echo "    <input
            ";
        // line 6
        echo "            type=\"text\"
            name=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . ($context["name"] ?? null))), "html", null, true);
        echo "\"
            value=\"";
        // line 8
        echo twig_escape_filter($this->env, twig_join_filter(($context["value"] ?? null), ", "), "html", null, true);
        echo "\"
            ";
        // line 10
        echo "            ";
        $this->displayBlock("global_attributes", $context, $blocks);
        echo "
            ";
        // line 12
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "autocomplete", []), [0 => "on", 1 => "off"])) {
            echo "autocomplete=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "autocomplete", []), "html", null, true);
            echo "\"";
        }
        // line 13
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "autofocus", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "autofocus=\"autofocus\"";
        }
        // line 14
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "dirname", [], "any", true, true)) {
            echo "dirname=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "dirname", []), "html", null, true);
            echo "\"";
        }
        // line 15
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "disabled", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "disabled=\"disabled\"";
        }
        // line 16
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "list", [], "any", true, true)) {
            echo "list=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "list", []), "html", null, true);
            echo "\"";
        }
        // line 17
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "maxlength", [], "any", true, true)) {
            echo "maxlength=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "maxlength", []), "html", null, true);
            echo "\"";
        }
        // line 18
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "minlength", [], "any", true, true)) {
            echo "minlength=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "minlength", []), "html", null, true);
            echo "\"";
        }
        // line 19
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "pattern", [], "any", true, true)) {
            echo "pattern=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "pattern", []), "html", null, true);
            echo "\"";
        }
        // line 20
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "placeholder", [], "any", true, true)) {
            echo "placeholder=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "placeholder", []), "html", null, true);
            echo "\"";
        }
        // line 21
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "readonly", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "readonly=\"readonly\"";
        }
        // line 22
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "required", []), [0 => "on", 1 => "true", 2 => 1])) {
            echo "required=\"required\"";
        }
        // line 23
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "size", [], "any", true, true)) {
            echo "size=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "size", []), "html", null, true);
            echo "\"";
        }
        // line 24
        echo "            />
";
    }

    public function getTemplateName()
    {
        return "forms/fields/input/text.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 24,  130 => 23,  125 => 22,  120 => 21,  113 => 20,  106 => 19,  99 => 18,  92 => 17,  85 => 16,  80 => 15,  73 => 14,  68 => 13,  61 => 12,  56 => 10,  52 => 8,  48 => 7,  45 => 6,  42 => 4,  39 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'forms/fields/input/group/group.html.twig' %}

{% block input %}
    <input
            {# required attribute structures #}
            type=\"text\"
            name=\"{{ (scope ~ name)|fieldName }}\"
            value=\"{{ value|join(', ') }}\"
            {# global attribute structures #}
            {{ block('global_attributes') }}
            {# non-gloval attribute structures #}
            {% if field.autocomplete in ['on', 'off'] %}autocomplete=\"{{ field.autocomplete }}\"{% endif %}
            {% if field.autofocus in ['on', 'true', 1] %}autofocus=\"autofocus\"{% endif %}
            {% if field.dirname is defined %}dirname=\"{{ field.dirname }}\"{% endif %}
            {% if field.disabled in ['on', 'true', 1] %}disabled=\"disabled\"{% endif %}
            {% if field.list is defined %}list=\"{{ field.list }}\"{% endif %}
            {% if field.maxlength is defined %}maxlength=\"{{ field.maxlength }}\"{% endif %}
            {% if field.minlength is defined %}minlength=\"{{ field.minlength }}\"{% endif %}
            {% if field.pattern is defined %}pattern=\"{{ field.pattern }}\"{% endif %}
            {% if field.placeholder is defined %}placeholder=\"{{ field.placeholder }}\"{% endif %}
            {% if field.readonly in ['on', 'true', 1] %}readonly=\"readonly\"{% endif %}
            {% if field.required in ['on', 'true', 1] %}required=\"required\"{% endif %}
            {% if field.size is defined %}size=\"{{ field.size }}\"{% endif %}
            />
{% endblock %}
", "forms/fields/input/text.html.twig", "W:\\iSell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\forms\\fields\\input\\text.html.twig");
    }
}
