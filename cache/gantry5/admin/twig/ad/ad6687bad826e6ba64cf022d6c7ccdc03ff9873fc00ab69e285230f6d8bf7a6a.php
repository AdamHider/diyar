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

/* @gantry-admin/partials/base.html.twig */
class __TwigTemplate_f468852dbfd6ca5451d219cfd9d7672b218b37f34ed9962ae705c796de0d0db2 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascript' => [$this, 'block_javascript'],
            'content' => [$this, 'block_content'],
            'gantry_content_wrapper' => [$this, 'block_gantry_content_wrapper'],
            'gantry' => [$this, 'block_gantry'],
            'footer_section' => [$this, 'block_footer_section'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@gantry-admin/partials/page.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("@gantry-admin/partials/page.html.twig", "@gantry-admin/partials/base.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 4
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/css-compiled/g-admin.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    ";
        // line 5
        if ( !$this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", []), "has", [0 => "fontawesome"], "method")) {
            // line 6
            echo "    <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/css/font-awesome.min.css"), "html", null, true);
            echo "\" type=\"text/css\" />
    ";
        }
        // line 8
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 11
    public function block_javascript($context, array $blocks = [])
    {
        // line 12
        echo "    <script type=\"text/javascript\" async=\"async\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/js/main.js"), "html", null, true);
        echo "\"></script>
    ";
        // line 13
        $this->loadTemplate("@gantry-admin/partials/js-translations.html.twig", "@gantry-admin/partials/base.html.twig", 13)->display($context);
        // line 14
        echo "    ";
        $this->displayParentBlock("javascript", $context, $blocks);
        echo "
";
    }

    // line 17
    public function block_content($context, array $blocks = [])
    {
        // line 18
        echo "    <div id=\"main-header\" data-mode-indicator=\"production\">
        ";
        // line 19
        $this->loadTemplate("@gantry-admin/partials/php_unsupported.html.twig", "@gantry-admin/partials/base.html.twig", 19)->display($context);
        // line 20
        echo "        ";
        $this->loadTemplate("@gantry-admin/partials/header.html.twig", "@gantry-admin/partials/base.html.twig", 20)->display($context);
        // line 21
        echo "    </div>
    <div class=\"inner-container\">
        ";
        // line 23
        $this->loadTemplate("@gantry-admin/partials/updates.html.twig", "@gantry-admin/partials/base.html.twig", 23)->display($context);
        // line 24
        echo "        ";
        $this->displayBlock('gantry_content_wrapper', $context, $blocks);
        // line 39
        echo "    </div>
";
    }

    // line 24
    public function block_gantry_content_wrapper($context, array $blocks = [])
    {
        // line 25
        echo "            <div data-g5-content-wrapper=\"\">
                ";
        // line 26
        $this->loadTemplate("@gantry-admin/partials/navigation.html.twig", "@gantry-admin/partials/base.html.twig", 26)->display($context);
        // line 27
        echo "                <div class=\"g-grid\">
                    <div class=\"g-block main-block\">
                        <section id=\"g-main\">
                            <div class=\"g-content\" data-g5-content=\"\">
                                ";
        // line 31
        $this->displayBlock('gantry', $context, $blocks);
        // line 33
        echo "                            </div>
                        </section>
                    </div>
                </div>
            </div>
        ";
    }

    // line 31
    public function block_gantry($context, array $blocks = [])
    {
        // line 32
        echo "                                ";
    }

    // line 42
    public function block_footer_section($context, array $blocks = [])
    {
        // line 43
        echo "    <footer id=\"footer\">
        <div>
            ";
        // line 45
        echo $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_FOOTER");
        echo "
        </div>
        ";
        // line 47
        $context["version"] = twig_constant("GANTRY5_VERSION");
        // line 48
        echo "        ";
        $context["version_date"] = twig_constant("GANTRY5_VERSION_DATE");
        // line 49
        echo "        <div>
            ";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_FOOTER_VERSION"), "html", null, true);
        echo " <span class=\"g-version\">";
        echo twig_escape_filter($this->env, ($context["version"] ?? null), "html", null, true);
        echo "</span>
            /
            ";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_FOOTER_RELEASED"), "html", null, true);
        echo " <span class=\"g-version-date\">";
        echo twig_escape_filter($this->env, ($context["version_date"] ?? null), "html", null, true);
        echo "</span>
        </div>
        <div><a href=\"#\" data-changelog=\"";
        // line 54
        echo twig_escape_filter($this->env, twig_constant("GANTRY5_VERSION"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_CHANGELOG"), "html", null, true);
        echo "</a></div>
    </footer>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 54,  168 => 52,  161 => 50,  158 => 49,  155 => 48,  153 => 47,  148 => 45,  144 => 43,  141 => 42,  137 => 32,  134 => 31,  125 => 33,  123 => 31,  117 => 27,  115 => 26,  112 => 25,  109 => 24,  104 => 39,  101 => 24,  99 => 23,  95 => 21,  92 => 20,  90 => 19,  87 => 18,  84 => 17,  77 => 14,  75 => 13,  70 => 12,  67 => 11,  60 => 8,  54 => 6,  52 => 5,  47 => 4,  44 => 3,  34 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@gantry-admin/partials/base.html.twig", "W:\\Isell\\www\\diyar\\administrator\\components\\com_gantry5\\templates\\partials\\base.html.twig");
    }
}
