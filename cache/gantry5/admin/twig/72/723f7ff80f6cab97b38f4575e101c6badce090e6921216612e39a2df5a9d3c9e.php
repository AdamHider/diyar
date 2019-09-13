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

/* forms/fields/separator/note.html.twig */
class __TwigTemplate_2ad0753cb69331900ae4760026778d0fffd43a3d8dfa9ee51a5208bcd87d1541 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'field' => [$this, 'block_field'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((("forms/" . (((isset($context["layout"]) || array_key_exists("layout", $context))) ? (_twig_default_filter(($context["layout"] ?? null), "field")) : ("field"))) . ".html.twig"), "forms/fields/separator/note.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field($context, array $blocks = [])
    {
        // line 4
        echo "    <div class=\"";
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["field"] ?? null), "class", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["field"] ?? null), "class", []), "alert alert-warning")) : ("alert alert-warning")), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter($this->getAttribute(($context["field"] ?? null), "content", []));
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "forms/fields/separator/note.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 4,  38 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'forms/' ~ layout|default('field') ~ '.html.twig' %}

{% block field %}
    <div class=\"{{ field.class|default(\"alert alert-warning\") }}\">{{ field.content|trans|raw }}</div>
{% endblock %}
", "forms/fields/separator/note.html.twig", "W:\\iSell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\forms\\fields\\separator\\note.html.twig");
    }
}
