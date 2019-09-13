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

/* @gantry-admin/modals/module-picker.html.twig */
class __TwigTemplate_3b793c8265919d1ad0dcf3cb92f5d1cf83da1efafd16227cbc45560db920da89 extends \Twig\Template
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
        // line 5
        echo "<div data-mm-particle-stepone=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["gantry"] ?? null), "route", [0 => "menu/particle"], "method"), "html", null, true);
        echo "\" class=\"menu-editor-extras\">
    <div class=\"card settings-block\">
        <h4>
            ";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_PICK_MODULE"), "html", null, true);
        echo "
        </h4>
        <div class=\"inner-params\">
            <div class=\"g5-mm-modules-picker menu-editor-modules\">
                <div class=\"search settings-block\">
                    <input type=\"text\" placeholder=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SEARCH_ELI"), "html", null, true);
        echo "\" />
                    <i class=\"fa fa-search\" aria-hidden=\"true\"></i>
                </div>
                <div class=\"modules-wrapper\">
                    <ul>
                        ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", []), "listModules", []));
        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
            // line 19
            echo "                        <li data-mm-module=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["module"], "id", []), "html", null, true);
            echo "\" data-mm-type=\"module\">
                            <span class=\"module-infos\">
                                <span data-title=\"";
            // line 21
            echo twig_escape_filter($this->env, (((($this->getAttribute($context["module"], "enabled", [])) ? ($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_PUBLISHED")) : ($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_UNPUBLISHED"))) . " / ") . $this->getAttribute($context["module"], "access", [])), "html", null, true);
            echo "\"
                                      data-tip=\"";
            // line 22
            echo twig_escape_filter($this->env, (((($this->getAttribute($context["module"], "enabled", [])) ? ($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_PUBLISHED")) : ($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_UNPUBLISHED"))) . " / ") . $this->getAttribute($context["module"], "access", [])), "html", null, true);
            echo "\"
                                      data-tip-place=\"top-left\"
                                >
                                    <i class=\"fa fa-fw fa-";
            // line 25
            echo (($this->getAttribute($context["module"], "enabled", [])) ? ("toggle-on") : ("toggle-off"));
            echo "\" aria-hidden=\"true\"></i>
                                </span>
                            </span>
                            <span class=\"module-wrapper\">
                                <span class=\"title\" data-mm-title=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($context["module"], "title", []), "html", null, true);
            echo "\" data-mm-filter=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["module"], "title", []), "html", null, true);
            echo "\">
                                    ";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($context["module"], "title", []), "html", null, true);
            echo "
                                </span>
                                <span class=\"sub-title font-small\">
                                    <strong>";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_ID_UPPER"), "html", null, true);
            echo "</strong>: ";
            echo twig_escape_filter($this->env, (($this->getAttribute($context["module"], "id", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["module"], "id", []), "unknown")) : ("unknown")), "html", null, true);
            echo "
                                </span>
                                <span class=\"sub-title font-small\" data-mm-filter=\"";
            // line 35
            echo twig_escape_filter($this->env, (($this->getAttribute($context["module"], "module", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["module"], "module", []), "none")) : ("none")), "html", null, true);
            echo "\">
                                    <strong>";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_TYPE"), "html", null, true);
            echo "</strong>: ";
            echo twig_escape_filter($this->env, (($this->getAttribute($context["module"], "module", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["module"], "module", []), "none")) : ("none")), "html", null, true);
            echo "
                                </span>
                                <span class=\"sub-title font-small\">
                                    <strong>";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_POSITION"), "html", null, true);
            echo "</strong>: ";
            echo twig_escape_filter($this->env, (($this->getAttribute($context["module"], "position", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["module"], "position", []), "none")) : ("none")), "html", null, true);
            echo "
                                </span>
                            </span>
                        </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=\"g-modal-actions\">
        ";
        // line 51
        echo "        <button class=\"button button-primary\" type=\"submit\" data-mm-select disabled>";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SELECT"), "html", null, true);
        echo "</button>
        <button class=\"button g5-dialog-close\">";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_CANCEL"), "html", null, true);
        echo "</button>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/modals/module-picker.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 52,  132 => 51,  124 => 44,  111 => 39,  103 => 36,  99 => 35,  92 => 33,  86 => 30,  80 => 29,  73 => 25,  67 => 22,  63 => 21,  57 => 19,  53 => 18,  45 => 13,  37 => 8,  30 => 5,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{# Available variables:

module.[id | title | position | enabled | access]
#}
<div data-mm-particle-stepone=\"{{ gantry.route('menu/particle') }}\" class=\"menu-editor-extras\">
    <div class=\"card settings-block\">
        <h4>
            {{ 'GANTRY5_PLATFORM_PICK_MODULE'|trans }}
        </h4>
        <div class=\"inner-params\">
            <div class=\"g5-mm-modules-picker menu-editor-modules\">
                <div class=\"search settings-block\">
                    <input type=\"text\" placeholder=\"{{ 'GANTRY5_PLATFORM_SEARCH_ELI'|trans }}\" />
                    <i class=\"fa fa-search\" aria-hidden=\"true\"></i>
                </div>
                <div class=\"modules-wrapper\">
                    <ul>
                        {% for module in gantry.platform.listModules %}
                        <li data-mm-module=\"{{ module.id }}\" data-mm-type=\"module\">
                            <span class=\"module-infos\">
                                <span data-title=\"{{ (module.enabled ? 'GANTRY5_PLATFORM_PUBLISHED'|trans : 'GANTRY5_PLATFORM_UNPUBLISHED'|trans) ~ ' / ' ~ module.access }}\"
                                      data-tip=\"{{ (module.enabled ? 'GANTRY5_PLATFORM_PUBLISHED'|trans : 'GANTRY5_PLATFORM_UNPUBLISHED'|trans) ~ ' / ' ~ module.access }}\"
                                      data-tip-place=\"top-left\"
                                >
                                    <i class=\"fa fa-fw fa-{{ module.enabled ? 'toggle-on' : 'toggle-off' }}\" aria-hidden=\"true\"></i>
                                </span>
                            </span>
                            <span class=\"module-wrapper\">
                                <span class=\"title\" data-mm-title=\"{{ module.title }}\" data-mm-filter=\"{{ module.title }}\">
                                    {{ module.title }}
                                </span>
                                <span class=\"sub-title font-small\">
                                    <strong>{{ 'GANTRY5_PLATFORM_ID_UPPER'|trans }}</strong>: {{ module.id|default('unknown') }}
                                </span>
                                <span class=\"sub-title font-small\" data-mm-filter=\"{{ module.module|default('none') }}\">
                                    <strong>{{ 'GANTRY5_PLATFORM_TYPE'|trans }}</strong>: {{ module.module|default('none') }}
                                </span>
                                <span class=\"sub-title font-small\">
                                    <strong>{{ 'GANTRY5_PLATFORM_POSITION'|trans }}</strong>: {{ module.position|default('none') }}
                                </span>
                            </span>
                        </li>
                        {% endfor %}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=\"g-modal-actions\">
        {#<a class=\"button float-left\">{{ 'GANTRY5_PLATFORM_DEFAULTS'|trans }}</a>#}
        <button class=\"button button-primary\" type=\"submit\" data-mm-select disabled>{{ 'GANTRY5_PLATFORM_SELECT'|trans }}</button>
        <button class=\"button g5-dialog-close\">{{ 'GANTRY5_PLATFORM_CANCEL'|trans }}</button>
    </div>
</div>
", "@gantry-admin/modals/module-picker.html.twig", "W:\\iSell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\modals\\module-picker.html.twig");
    }
}
