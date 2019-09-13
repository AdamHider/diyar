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

/* partials/outlines-list.html.twig */
class __TwigTemplate_2e3f1e5f5b3a966b09fe6039a8e2f34d79f58a1cd8a63b468b8c9114fdf870f8 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<optgroup label=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_GLOBAL_DEFAULTS"), "html", null, true);
        echo "\">
    <option value=\"default\"
            ";
        // line 3
        if ((($context["configuration"] ?? null) == "default")) {
            echo "selected=\"selected\"";
        }
        // line 4
        echo "            data-data=\"";
        echo twig_escape_filter($this->env, twig_jsonencode_filter(["params" => ["navbar" => true], "url" => $this->getAttribute(($context["gantry"] ?? null), "route", [0 => "configurations/default", 1 => (((isset($context["configuration_page"]) || array_key_exists("configuration_page", $context))) ? (_twig_default_filter(($context["configuration_page"] ?? null), "styles")) : ("styles"))], "method")]), "html_attr");
        echo "\">
        ";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_BASE_OUTLINE"), "html", null, true);
        echo "
    </option>
</optgroup>

";
        // line 9
        $context["user_conf"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "outlines", []), "user", []);
        // line 10
        if ($this->getAttribute(($context["user_conf"] ?? null), "count", [])) {
            // line 11
            echo "    <optgroup label=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_THEME_OUTLINES"), "html", null, true);
            echo "\">
        ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["user_conf"] ?? null));
            foreach ($context['_seq'] as $context["name"] => $context["title"]) {
                // line 13
                echo "            ";
                if (($context["name"] == ($context["configuration"] ?? null))) {
                    // line 14
                    echo "                ";
                    $context["selected_title"] = $context["title"];
                    // line 15
                    echo "                ";
                    $context["selected_value"] = $context["name"];
                    // line 16
                    echo "            ";
                }
                // line 17
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "\"
                    ";
                // line 18
                if (($context["name"] == ($context["configuration"] ?? null))) {
                    echo "selected=\"selected\"";
                }
                // line 19
                echo "                    data-data=\"";
                echo twig_escape_filter($this->env, twig_jsonencode_filter(["params" => ["navbar" => true], "url" => $this->getAttribute(($context["gantry"] ?? null), "route", [0 => "configurations", 1 => twig_escape_filter($this->env, $context["name"]), 2 => (((isset($context["configuration_page"]) || array_key_exists("configuration_page", $context))) ? (_twig_default_filter(($context["configuration_page"] ?? null), "styles")) : ("styles"))], "method")]), "html_attr");
                echo "\"
            >
                ";
                // line 21
                echo twig_escape_filter($this->env, $context["title"], "html", null, true);
                echo "
            </option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['title'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "    </optgroup>
";
        }
        // line 26
        echo "
";
        // line 27
        $context["system_conf"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "outlines", []), "system", []);
        // line 28
        if ($this->getAttribute(($context["system_conf"] ?? null), "count", [])) {
            // line 29
            echo "    <optgroup label=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SYSTEM_OUTLINES"), "html", null, true);
            echo "\">
        ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["system_conf"] ?? null));
            foreach ($context['_seq'] as $context["name"] => $context["title"]) {
                // line 31
                echo "            ";
                if (($context["name"] == ($context["configuration"] ?? null))) {
                    // line 32
                    echo "                ";
                    $context["selected_title"] = $context["title"];
                    // line 33
                    echo "                ";
                    $context["selected_value"] = $context["name"];
                    // line 34
                    echo "                ";
                    $context["selected_editable"] = false;
                    // line 35
                    echo "            ";
                }
                // line 36
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "\"
                    ";
                // line 37
                if (($context["name"] == ($context["configuration"] ?? null))) {
                    echo "selected=\"selected\"";
                }
                // line 38
                echo "                    data-data=\"";
                echo twig_escape_filter($this->env, twig_jsonencode_filter(["params" => ["navbar" => true], "url" => $this->getAttribute(($context["gantry"] ?? null), "route", [0 => "configurations", 1 => twig_escape_filter($this->env, $context["name"]), 2 => (((isset($context["configuration_page"]) || array_key_exists("configuration_page", $context))) ? (_twig_default_filter(($context["configuration_page"] ?? null), "styles")) : ("styles"))], "method")]), "html_attr");
                echo "\"
            >
                ";
                // line 40
                echo twig_escape_filter($this->env, $context["title"], "html", null, true);
                echo "
            </option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['title'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "    </optgroup>
";
        }
    }

    public function getTemplateName()
    {
        return "partials/outlines-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 43,  151 => 40,  145 => 38,  141 => 37,  136 => 36,  133 => 35,  130 => 34,  127 => 33,  124 => 32,  121 => 31,  117 => 30,  112 => 29,  110 => 28,  108 => 27,  105 => 26,  101 => 24,  92 => 21,  86 => 19,  82 => 18,  77 => 17,  74 => 16,  71 => 15,  68 => 14,  65 => 13,  61 => 12,  56 => 11,  54 => 10,  52 => 9,  45 => 5,  40 => 4,  36 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<optgroup label=\"{{ 'GANTRY5_PLATFORM_GLOBAL_DEFAULTS'|trans }}\">
    <option value=\"default\"
            {% if configuration == 'default' %}selected=\"selected\"{% endif %}
            data-data=\"{{ {params: {navbar: true}, url: gantry.route('configurations/default', configuration_page|default('styles'))}|json_encode|e('html_attr') }}\">
        {{ 'GANTRY5_PLATFORM_BASE_OUTLINE'|trans }}
    </option>
</optgroup>

{% set user_conf = gantry.outlines.user %}
{% if user_conf.count %}
    <optgroup label=\"{{ 'GANTRY5_PLATFORM_THEME_OUTLINES'|trans }}\">
        {% for name, title in user_conf %}
            {% if name == configuration %}
                {% set selected_title = title %}
                {% set selected_value = name %}
            {% endif %}
            <option value=\"{{ name }}\"
                    {% if name == configuration %}selected=\"selected\"{% endif %}
                    data-data=\"{{ {params: {navbar: true}, url: gantry.route('configurations', name|e, configuration_page|default('styles'))}|json_encode|e('html_attr') }}\"
            >
                {{ title }}
            </option>
        {% endfor %}
    </optgroup>
{% endif %}

{% set system_conf = gantry.outlines.system %}
{% if system_conf.count %}
    <optgroup label=\"{{ 'GANTRY5_PLATFORM_SYSTEM_OUTLINES'|trans }}\">
        {% for name, title in system_conf %}
            {% if name == configuration %}
                {% set selected_title = title %}
                {% set selected_value = name %}
                {% set selected_editable = false %}
            {% endif %}
            <option value=\"{{ name }}\"
                    {% if name == configuration %}selected=\"selected\"{% endif %}
                    data-data=\"{{ {params: {navbar: true}, url: gantry.route('configurations', name|e, configuration_page|default('styles'))}|json_encode|e('html_attr') }}\"
            >
                {{ title }}
            </option>
        {% endfor %}
    </optgroup>
{% endif %}", "partials/outlines-list.html.twig", "W:\\iSell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\partials\\outlines-list.html.twig");
    }
}
