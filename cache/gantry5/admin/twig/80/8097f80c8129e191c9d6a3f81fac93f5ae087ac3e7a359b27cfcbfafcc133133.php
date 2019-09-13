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

/* forms/fields/input/group/group.html.twig */
class __TwigTemplate_fedf6b238e21d5b9038144b9d49f04e9773f5982aab60ebe017767803a84f071 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'group' => [$this, 'block_group'],
            'input' => [$this, 'block_input'],
            'reset_field' => [$this, 'block_reset_field'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate(((($context["default"] ?? null)) ? ("partials/field.html.twig") : ((("forms/" . (((isset($context["layout"]) || array_key_exists("layout", $context))) ? (_twig_default_filter(($context["layout"] ?? null), "field")) : ("field"))) . ".html.twig"))), "forms/fields/input/group/group.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 18
        $context["macro"] = $this;
        // line 1
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 20
    public function block_group($context, array $blocks = [])
    {
        // line 21
        echo "    <div class=\"input-group
        ";
        // line 22
        if ($this->getAttribute(($context["field"] ?? null), "prepend", [])) {
            echo "prepend
        ";
        }
        // line 24
        echo "        ";
        if ($this->getAttribute(($context["field"] ?? null), "append", [])) {
            echo "append
        ";
        }
        // line 26
        echo "    \">


        ";
        // line 29
        if ($this->getAttribute(($context["field"] ?? null), "prepend", [])) {
            // line 30
            echo "            ";
            echo $context["macro"]->getpend($this->getAttribute(($context["field"] ?? null), "prepend", []));
            echo "
        ";
        }
        // line 32
        echo "        ";
        $this->displayBlock('input', $context, $blocks);
        // line 34
        echo "        ";
        if ($this->getAttribute(($context["field"] ?? null), "append", [])) {
            // line 35
            echo "            ";
            echo $context["macro"]->getpend($this->getAttribute(($context["field"] ?? null), "append", []));
            echo "
        ";
        }
        // line 37
        echo "        ";
        $this->displayBlock('reset_field', $context, $blocks);
        // line 38
        echo "    </div>
";
    }

    // line 32
    public function block_input($context, array $blocks = [])
    {
        // line 33
        echo "        ";
    }

    // line 37
    public function block_reset_field($context, array $blocks = [])
    {
        $this->displayParentBlock("reset_field", $context, $blocks);
    }

    // line 3
    public function getpend($__item__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 4
            echo "    ";
            if (($this->getAttribute(($context["item"] ?? null), "type", []) == "text")) {
                // line 5
                echo "        <span class=\"input-group-addon\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "text", []));
                echo "</span>
    ";
            } elseif (($this->getAttribute(            // line 6
($context["item"] ?? null), "type", []) == "list")) {
                // line 7
                echo "        ";
                if ($this->getAttribute(($context["item"] ?? null), "options", [])) {
                    // line 8
                    echo "            ";
                    $this->loadTemplate("forms/fields/select/selectize.html.twig", "forms/fields/input/group/group.html.twig", 8)->display(twig_array_merge($context, ["field.options" => $this->getAttribute(($context["item"] ?? null), "options", [])]));
                    // line 9
                    echo "        ";
                }
                // line 10
                echo "    ";
            } elseif (($this->getAttribute(($context["item"] ?? null), "type", []) == "button")) {
                // line 11
                echo "        <span class=\"input-group-btn\">
            ";
                // line 12
                $this->loadTemplate("forms/fields/button", "forms/fields/input/group/group.html.twig", 12)->display($context);
                // line 13
                echo "        </span>
    ";
            } elseif (($this->getAttribute(            // line 14
($context["item"] ?? null), "type", []) == "actions")) {
                // line 15
                echo "    ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "forms/fields/input/group/group.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 15,  148 => 14,  145 => 13,  143 => 12,  140 => 11,  137 => 10,  134 => 9,  131 => 8,  128 => 7,  126 => 6,  121 => 5,  118 => 4,  106 => 3,  100 => 37,  96 => 33,  93 => 32,  88 => 38,  85 => 37,  79 => 35,  76 => 34,  73 => 32,  67 => 30,  65 => 29,  60 => 26,  54 => 24,  49 => 22,  46 => 21,  43 => 20,  39 => 1,  37 => 18,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends default ? \"partials/field.html.twig\" : 'forms/' ~ layout|default('field') ~ '.html.twig' %}

{% macro pend(item) %}
    {% if item.type == \"text\" %}
        <span class=\"input-group-addon\">{{ item.text|e }}</span>
    {% elseif item.type == \"list\" %}
        {% if item.options %}
            {% include 'forms/fields/select/selectize.html.twig' with {'field.options': item.options} %}
        {% endif %}
    {% elseif item.type == \"button\" %}
        <span class=\"input-group-btn\">
            {% include 'forms/fields/button' %}
        </span>
    {% elseif item.type == \"actions\" %}
    {% endif %}
{% endmacro %}

{% import _self as macro %}

{% block group %}
    <div class=\"input-group
        {% if field.prepend -%} prepend
        {% endif %}
        {% if field.append -%} append
        {% endif %}
    \">


        {% if field.prepend %}
            {{ macro.pend(field.prepend) }}
        {% endif %}
        {% block input %}
        {% endblock %}
        {% if field.append %}
            {{ macro.pend(field.append) }}
        {% endif %}
        {% block reset_field %}{{ parent() }}{% endblock %}
    </div>
{% endblock %}
", "forms/fields/input/group/group.html.twig", "W:\\iSell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\forms\\fields\\input\\group\\group.html.twig");
    }
}
