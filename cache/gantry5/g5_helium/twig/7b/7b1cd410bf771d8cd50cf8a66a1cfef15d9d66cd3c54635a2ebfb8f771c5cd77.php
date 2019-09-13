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

/* @nucleus/content/particle.html.twig */
class __TwigTemplate_cc54346cd750a518b48180a72e79152b894ad7426df9ab3f15838c9d834d550d extends \Twig\Template
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
        try {            // line 2
            echo "    ";
            $context["id"] = $this->getAttribute(($context["segment"] ?? null), "id", []);
            // line 3
            echo "    ";
            if ( !($context["particle"] ?? null)) {
                // line 4
                echo "        ";
                if (($context["noConfig"] ?? null)) {
                    // line 5
                    echo "            ";
                    $context["enabled"] = true;
                    // line 6
                    echo "            ";
                    $context["particle"] = $this->getAttribute(($context["segment"] ?? null), "attributes", []);
                    // line 7
                    echo "        ";
                } else {
                    // line 8
                    echo "            ";
                    $context["enabled"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "get", [0 => (("particles." . $this->getAttribute(($context["segment"] ?? null), "subtype", [])) . ".enabled"), 1 => 1], "method");
                    // line 9
                    echo "            ";
                    $context["particle"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "getJoined", [0 => ("particles." . $this->getAttribute(($context["segment"] ?? null), "subtype", [])), 1 => $this->getAttribute(($context["segment"] ?? null), "attributes", [])], "method");
                    // line 10
                    echo "        ";
                }
                // line 11
                echo "    ";
            }
            // line 12
            echo "
    ";
            // line 13
            ob_start();
            // line 14
            echo "        ";
            if ((($context["enabled"] ?? null) && ((null === $this->getAttribute($this->getAttribute(($context["segment"] ?? null), "attributes", []), "enabled", [])) || $this->getAttribute($this->getAttribute(($context["segment"] ?? null), "attributes", []), "enabled", [])))) {
                // line 15
                echo "            ";
                $this->loadTemplate([0 => (("particles/" . $this->getAttribute(($context["segment"] ?? null), "subtype", [])) . ".html.twig"), 1 => (("@particles/" . $this->getAttribute(                // line 16
($context["segment"] ?? null), "subtype", [])) . ".html.twig"), 2 => "@nucleus/content/missing.html.twig"], "@nucleus/content/particle.html.twig", 15)->display($context);
                // line 18
                echo "        ";
            }
            // line 19
            echo "    ";
            $context["html"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 20
            echo "    ";
            $context["html"] = twig_trim_filter(($context["html"] ?? null));
            // line 21
            echo "
    ";
            // line 22
            $context["classes"] = twig_trim_filter(((( !($context["inContent"] ?? null)) ? ("g-content g-particle ") : ("g-particle ")) . twig_join_filter($this->getAttribute(($context["segment"] ?? null), "classes", []), " ")));
            // line 23
            if (($context["html"] ?? null)) {
                // line 24
                if ($this->getAttribute(($context["gantry"] ?? null), "debug", [])) {
                    echo "<!-- START PARTICLE ";
                    echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                    echo " -->";
                }
                // line 25
                echo "
            ";
                // line 26
                if ( !(isset($context["ajax"]) || array_key_exists("ajax", $context))) {
                    echo "<div id=\"";
                    echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                    echo "-particle\" class=\"";
                    echo twig_escape_filter($this->env, ($context["classes"] ?? null), "html", null, true);
                    echo "\">";
                }
                // line 27
                echo "            ";
                echo ($context["html"] ?? null);
                echo "
            ";
                // line 28
                if ( !(isset($context["ajax"]) || array_key_exists("ajax", $context))) {
                    echo "</div>";
                }
                // line 29
                echo "            ";
                if ($this->getAttribute(($context["gantry"] ?? null), "debug", [])) {
                    echo "<!-- END PARTICLE ";
                    echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                    echo " -->";
                }
            }
        } catch (\Exception $e) {
            if ($context['gantry']->debug()) throw $e;
            GANTRY_DEBUGGER && method_exists('Gantry\Debugger', 'addException') && \Gantry\Debugger::addException($e);
            $context['e'] = $e;
            // line 33
            echo "    <div class=\"alert alert-error\"><strong>Error</strong> while rendering ";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["segment"] ?? null), "subtype", []), "html", null, true);
            echo " particle.</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@nucleus/content/particle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 33,  115 => 29,  111 => 28,  106 => 27,  98 => 26,  95 => 25,  89 => 24,  87 => 23,  85 => 22,  82 => 21,  79 => 20,  76 => 19,  73 => 18,  71 => 16,  69 => 15,  66 => 14,  64 => 13,  61 => 12,  58 => 11,  55 => 10,  52 => 9,  49 => 8,  46 => 7,  43 => 6,  40 => 5,  37 => 4,  34 => 3,  31 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% try %}
    {% set id = segment.id %}
    {% if not particle %}
        {% if noConfig %}
            {% set enabled = true %}
            {% set particle = segment.attributes %}
        {% else %}
            {% set enabled = gantry.config.get('particles.' ~ segment.subtype ~ '.enabled', 1) %}
            {% set particle = gantry.config.getJoined('particles.' ~ segment.subtype, segment.attributes) %}
        {% endif %}
    {% endif %}

    {% set html %}
        {% if enabled and (segment.attributes.enabled is null or segment.attributes.enabled) %}
            {% include ['particles/' ~ segment.subtype ~ '.html.twig',
            '@particles/' ~ segment.subtype ~ '.html.twig',
            '@nucleus/content/missing.html.twig'] %}
        {% endif %}
    {% endset %}
    {% set html = html|trim %}

    {% set classes = ((not inContent ? 'g-content g-particle ' : 'g-particle ') ~ segment.classes|join(' '))|trim %}
    {%- if html -%}
            {% if gantry.debug %}<!-- START PARTICLE {{ id }} -->{% endif %}

            {% if ajax is not defined %}<div id=\"{{ id }}-particle\" class=\"{{ classes }}\">{% endif %}
            {{ html|raw }}
            {% if ajax is not defined %}</div>{% endif %}
            {% if gantry.debug %}<!-- END PARTICLE {{ id }} -->{% endif %}
    {%- endif -%}

{% catch %}
    <div class=\"alert alert-error\"><strong>Error</strong> while rendering {{ segment.subtype }} particle.</div>
{% endtry %}
", "@nucleus/content/particle.html.twig", "W:\\iSell\\www\\diyar\\media\\gantry5\\engines\\nucleus\\templates\\content\\particle.html.twig");
    }
}
