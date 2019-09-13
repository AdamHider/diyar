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

/* error.html.twig */
class __TwigTemplate_5335f219efc9c64acd9f485f584b4086b0554db97b39101b21cd99675491aa1e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'page_head' => [$this, 'block_page_head'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "partials/page.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("partials/page.html.twig", "error.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_head($context, array $blocks = [])
    {
        // line 4
        $this->loadTemplate("partials/error_head.html.twig", "error.html.twig", 4)->display($context);
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        // line 8
        echo "    <h1>";
        echo twig_escape_filter($this->env, (((isset($context["errorcode"]) || array_key_exists("errorcode", $context))) ? (_twig_default_filter(($context["errorcode"] ?? null), 500)) : (500)), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (((isset($context["error"]) || array_key_exists("error", $context))) ? (_twig_default_filter(($context["error"] ?? null), "Unknown Error")) : ("Unknown Error")), "html", null, true);
        echo "</h1>
    ";
        // line 9
        echo ($context["backtrace"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 9,  50 => 8,  47 => 7,  43 => 4,  40 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"partials/page.html.twig\" %}

{% block page_head -%}
    {% include 'partials/error_head.html.twig' %}
{%- endblock %}

{% block content %}
    <h1>{{ errorcode|default(500) }} {{ error|default('Unknown Error') }}</h1>
    {{ backtrace|raw }}
{% endblock %}
", "error.html.twig", "W:\\iSell\\www\\diyar\\media\\gantry5\\engines\\nucleus\\twig\\error.html.twig");
    }
}
