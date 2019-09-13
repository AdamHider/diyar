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

/* @nucleus/page.html.twig */
class __TwigTemplate_9cba26d3358875fe770d252cfc204080518a9890bfc1ce96e5ae841eafa187e5 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'page_offcanvas' => [$this, 'block_page_offcanvas'],
            'page_layout' => [$this, 'block_page_layout'],
            'page_top' => [$this, 'block_page_top'],
            'page_bottom' => [$this, 'block_page_bottom'],
            'body_top' => [$this, 'block_body_top'],
            'body_bottom' => [$this, 'block_body_bottom'],
            'page_head' => [$this, 'block_page_head'],
            'page_footer' => [$this, 'block_page_footer'],
            'page' => [$this, 'block_page'],
            'page_body' => [$this, 'block_page_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "debugger", []), "startTimer", [0 => "render", 1 => "Rendering page"], "method");
        // line 2
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "setLayout", [], "method");
        // line 3
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "loadAtoms", [], "method");
        // line 4
        $context["segments"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "segments", [], "method");
        // line 6
        ob_start();
        // line 7
        echo "    ";
        if ($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "hasContent", [], "method")) {
            // line 8
            echo "        ";
            $this->displayBlock('content', $context, $blocks);
            // line 10
            echo "    ";
        }
        $context["content"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 13
        $context["offcanvas"] = null;
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["segments"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["segment"]) {
            if (($this->getAttribute($context["segment"], "type", []) == "offcanvas")) {
                // line 15
                $context["offcanvas"] = $context["segment"];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['segment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        ob_start();
        // line 19
        echo "    ";
        $this->displayBlock('page_offcanvas', $context, $blocks);
        $context["page_offcanvas"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 26
        $context["page_offcanvas"] = ((twig_trim_filter(($context["page_offcanvas"] ?? null))) ? (twig_trim_filter(($context["page_offcanvas"] ?? null))) : (""));
        // line 27
        $context["offcanvas_position"] = ((($context["page_offcanvas"] ?? null)) ? ((($this->getAttribute($this->getAttribute(($context["offcanvas"] ?? null), "attributes", [], "any", false, true), "position", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["offcanvas"] ?? null), "attributes", [], "any", false, true), "position", []), "g-offcanvas-left")) : ("g-offcanvas-left"))) : (""));
        // line 29
        ob_start();
        // line 30
        echo "    ";
        $this->displayBlock('page_layout', $context, $blocks);
        $context["page_layout"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 37
        ob_start();
        // line 38
        echo "    ";
        $this->displayBlock('page_top', $context, $blocks);
        // line 40
        echo "    ";
        echo twig_join_filter($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "getHtml", [0 => "top"], "method"), "
    ");
        echo "
";
        $context["page_top"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 43
        ob_start();
        // line 44
        echo "    ";
        $this->displayBlock('page_bottom', $context, $blocks);
        // line 46
        echo "    ";
        echo twig_join_filter($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "getHtml", [0 => "bottom"], "method"), "
    ");
        echo "
";
        $context["page_bottom"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 49
        ob_start();
        // line 50
        echo "    ";
        $this->displayBlock('body_top', $context, $blocks);
        // line 52
        echo "    ";
        echo twig_join_filter($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "getHtml", [0 => "body_top"], "method"), "
    ");
        echo "
";
        $context["body_top"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 55
        ob_start();
        // line 56
        echo "    ";
        $this->displayBlock('body_bottom', $context, $blocks);
        // line 58
        echo "    ";
        echo twig_join_filter($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "getHtml", [0 => "body_bottom"], "method"), "
    ");
        echo "
";
        $context["body_bottom"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 61
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "addScript", [0 => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-assets://js/main.js"), 1 => 11, 2 => "footer"], "method");
        // line 65
        ob_start();
        // line 66
        echo "    ";
        $this->displayBlock('page_head', $context, $blocks);
        $context["page_head"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 71
        ob_start();
        // line 72
        echo "    ";
        $this->displayBlock('page_footer', $context, $blocks);
        // line 76
        echo "
    ";
        // line 77
        echo $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "debugger", []), "render", [], "method");
        echo "
";
        $context["page_footer"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 80
        $this->displayBlock('page', $context, $blocks);
    }

    // line 8
    public function block_content($context, array $blocks = [])
    {
        // line 9
        echo "        ";
    }

    // line 19
    public function block_page_offcanvas($context, array $blocks = [])
    {
        // line 20
        echo "        ";
        if (($context["offcanvas"] ?? null)) {
            // line 21
            echo "            ";
            $this->loadTemplate((("@nucleus/layout/" . $this->getAttribute(($context["offcanvas"] ?? null), "type", [])) . ".html.twig"), "@nucleus/page.html.twig", 21)->display(twig_array_merge($context, ["segment" => ($context["offcanvas"] ?? null)]));
        }
        // line 23
        echo "    ";
    }

    // line 30
    public function block_page_layout($context, array $blocks = [])
    {
        // line 31
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["segments"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        foreach ($context['_seq'] as $context["_key"] => $context["segment"]) {
            if (($this->getAttribute($context["segment"], "type", []) != "offcanvas")) {
                // line 32
                echo "        ";
                $this->loadTemplate((("@nucleus/layout/" . $this->getAttribute($context["segment"], "type", [])) . ".html.twig"), "@nucleus/page.html.twig", 32)->display(twig_array_merge($context, ["segments" => $this->getAttribute($context["segment"], "children", [])]));
                // line 33
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['segment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "    ";
    }

    // line 38
    public function block_page_top($context, array $blocks = [])
    {
        // line 39
        echo "    ";
    }

    // line 44
    public function block_page_bottom($context, array $blocks = [])
    {
        // line 45
        echo "    ";
    }

    // line 50
    public function block_body_top($context, array $blocks = [])
    {
        // line 51
        echo "    ";
    }

    // line 56
    public function block_body_bottom($context, array $blocks = [])
    {
        // line 57
        echo "    ";
    }

    // line 66
    public function block_page_head($context, array $blocks = [])
    {
        // line 67
        $this->loadTemplate("partials/page_head.html.twig", "@nucleus/page.html.twig", 67)->display($context);
    }

    // line 72
    public function block_page_footer($context, array $blocks = [])
    {
        // line 73
        echo "        ";
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", []), "finalize", [], "method");
        // line 74
        echo twig_join_filter($this->getAttribute(($context["gantry"] ?? null), "scripts", [0 => "footer"], "method"), "
    ");
    }

    // line 80
    public function block_page($context, array $blocks = [])
    {
        // line 81
        echo "<!DOCTYPE ";
        echo (($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", [], "any", false, true), "page", [], "any", false, true), "doctype", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", [], "any", false, true), "page", [], "any", false, true), "doctype", []), "html")) : ("html"));
        echo ">
<html";
        // line 82
        echo $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "htmlAttributes", []);
        echo ">
    ";
        // line 83
        echo ($context["page_head"] ?? null);
        echo "
    ";
        // line 84
        $this->displayBlock('page_body', $context, $blocks);
        // line 102
        echo "
</html>
";
    }

    // line 84
    public function block_page_body($context, array $blocks = [])
    {
        // line 85
        echo "<body";
        echo $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "bodyAttributes", [0 => ["class" => [0 => ($context["offcanvas_position"] ?? null), 1 => $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "preset", []), 2 => ("g-style-" . $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "preset", []))]]], "method");
        echo ">
        ";
        // line 86
        echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "page", []), "body", []), "body_top", []);
        echo "
        ";
        // line 87
        echo ($context["body_top"] ?? null);
        echo "
        ";
        // line 88
        echo ($context["page_offcanvas"] ?? null);
        echo "
        <div id=\"g-page-surround\">
            ";
        // line 90
        if (twig_trim_filter(($context["page_offcanvas"] ?? null))) {
            // line 91
            echo "<div class=\"g-offcanvas-hide g-offcanvas-toggle\" data-offcanvas-toggle aria-controls=\"g-offcanvas\" aria-expanded=\"false\"><i class=\"fa fa-fw fa-bars\"></i></div>";
        }
        // line 93
        echo "            ";
        echo ($context["page_top"] ?? null);
        echo "
            ";
        // line 94
        echo ($context["page_layout"] ?? null);
        echo "
            ";
        // line 95
        echo ($context["page_bottom"] ?? null);
        echo "
        </div>
        ";
        // line 97
        echo ($context["body_bottom"] ?? null);
        echo "
        ";
        // line 98
        echo ($context["page_footer"] ?? null);
        echo "
        ";
        // line 99
        echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "page", []), "body", []), "body_bottom", []);
        echo "
    </body>";
    }

    public function getTemplateName()
    {
        return "@nucleus/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  335 => 99,  331 => 98,  327 => 97,  322 => 95,  318 => 94,  313 => 93,  310 => 91,  308 => 90,  303 => 88,  299 => 87,  295 => 86,  290 => 85,  287 => 84,  281 => 102,  279 => 84,  275 => 83,  271 => 82,  266 => 81,  263 => 80,  258 => 74,  255 => 73,  252 => 72,  248 => 67,  245 => 66,  241 => 57,  238 => 56,  234 => 51,  231 => 50,  227 => 45,  224 => 44,  220 => 39,  217 => 38,  213 => 34,  203 => 33,  200 => 32,  188 => 31,  185 => 30,  181 => 23,  177 => 21,  174 => 20,  171 => 19,  167 => 9,  164 => 8,  160 => 80,  155 => 77,  152 => 76,  149 => 72,  147 => 71,  143 => 66,  141 => 65,  139 => 61,  132 => 58,  129 => 56,  127 => 55,  120 => 52,  117 => 50,  115 => 49,  108 => 46,  105 => 44,  103 => 43,  96 => 40,  93 => 38,  91 => 37,  87 => 30,  85 => 29,  83 => 27,  81 => 26,  77 => 19,  75 => 18,  68 => 15,  63 => 14,  61 => 13,  57 => 10,  54 => 8,  51 => 7,  49 => 6,  47 => 4,  45 => 3,  43 => 2,  41 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{%- do gantry.debugger.startTimer('render', 'Rendering page') %}
{%- do gantry.theme.setLayout() -%}
{%- do gantry.theme.loadAtoms() -%}
{%- set segments = gantry.theme.segments() -%}

{%- set content %}
    {% if gantry.theme.hasContent() %}
        {% block content %}
        {% endblock %}
    {% endif %}
{% endset -%}

{%- set offcanvas = null -%}
{%- for segment in segments if segment.type == 'offcanvas' %}
    {%- set offcanvas = segment -%}
{% endfor -%}

{%- set page_offcanvas %}
    {% block page_offcanvas %}
        {% if offcanvas %}
            {% include '@nucleus/layout/' ~ offcanvas.type ~ '.html.twig' with { 'segment': offcanvas } -%}
        {% endif %}
    {% endblock %}
{% endset -%}

{%- set page_offcanvas = page_offcanvas|trim ?: '' %}
{%- set offcanvas_position = page_offcanvas ? offcanvas.attributes.position|default('g-offcanvas-left') : '' -%}

{%- set page_layout %}
    {% block page_layout %}
    {% for segment in segments if segment.type != 'offcanvas' %}
        {% include '@nucleus/layout/' ~ segment.type ~ '.html.twig' with { 'segments': segment.children } %}
    {% endfor %}
    {% endblock %}
{% endset -%}

{%- set page_top %}
    {% block page_top %}
    {% endblock %}
    {{ gantry.document.getHtml('top')|join(\"\\n    \")|raw }}
{% endset -%}

{%- set page_bottom %}
    {% block page_bottom %}
    {% endblock %}
    {{ gantry.document.getHtml('bottom')|join(\"\\n    \")|raw }}
{% endset -%}

{%- set body_top %}
    {% block body_top %}
    {% endblock %}
    {{ gantry.document.getHtml('body_top')|join(\"\\n    \")|raw }}
{% endset -%}

{%- set body_bottom %}
    {% block body_bottom %}
    {% endblock %}
    {{ gantry.document.getHtml('body_bottom')|join(\"\\n    \")|raw }}
{% endset -%}

{%- do gantry.document.addScript(url('gantry-assets://js/main.js'), 11, 'footer') -%}

{# Head and footer needs to come last because of any of the above blocks may have CSS or JavaScript in them #}

{%- set page_head %}
    {% block page_head -%}
        {% include 'partials/page_head.html.twig' %}
    {%- endblock %}
{% endset -%}

{%- set page_footer %}
    {% block page_footer %}
        {% do gantry.platform.finalize() -%}
        {{ gantry.scripts('footer')|join(\"\\n    \")|raw -}}
    {% endblock %}

    {{ gantry.debugger.render()|raw }}
{% endset -%}

{%- block page -%}
<!DOCTYPE {{ gantry.config.page.doctype|default('html')|raw }}>
<html{{ gantry.page.htmlAttributes|raw }}>
    {{ page_head|raw }}
    {% block page_body -%}
    <body{{ gantry.page.bodyAttributes({'class': [offcanvas_position, gantry.page.preset, 'g-style-' ~ gantry.theme.preset]})|raw }}>
        {{ gantry.config.page.body.body_top|raw }}
        {{ body_top|raw }}
        {{ page_offcanvas|raw }}
        <div id=\"g-page-surround\">
            {% if page_offcanvas|trim -%}
            <div class=\"g-offcanvas-hide g-offcanvas-toggle\" data-offcanvas-toggle aria-controls=\"g-offcanvas\" aria-expanded=\"false\"><i class=\"fa fa-fw fa-bars\"></i></div>
            {%- endif %}
            {{ page_top|raw }}
            {{ page_layout|raw }}
            {{ page_bottom|raw }}
        </div>
        {{ body_bottom|raw }}
        {{ page_footer|raw }}
        {{ gantry.config.page.body.body_bottom|raw }}
    </body>
    {%- endblock %}

</html>
{% endblock -%}
", "@nucleus/page.html.twig", "W:\\iSell\\www\\diyar\\media\\gantry5\\engines\\nucleus\\templates\\page.html.twig");
    }
}
