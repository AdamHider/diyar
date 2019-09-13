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

/* @particles/menu.html.twig */
class __TwigTemplate_2ca023a3cee0ec905d7004bece8e7fc4b808213e7b541fca8fa56041ffe8148f extends \Twig\Template
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
            $context["menu"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "menu", []), "instance", [0 => ($context["particle"] ?? null)], "method");
        } catch (\Exception $e) {
            if ($context['gantry']->debug()) throw $e;
            GANTRY_DEBUGGER && method_exists('Gantry\Debugger', 'addException') && \Gantry\Debugger::addException($e);
            $context['e'] = $e;
            // line 4
            echo "<div class=\"alert alert-error\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["e"] ?? null), "getMessage", []), "html", null, true);
            echo "</div>
";
        }
        // line 6
        echo "
";
        // line 14
        echo "
";
        // line 23
        echo "
";
        // line 32
        echo "
";
        // line 84
        echo "
";
        // line 101
        echo "
";
        // line 109
        echo "
";
        // line 122
        echo "
";
        // line 123
        $context["macro"] = $this;
        // line 124
        echo "
";
        // line 125
        if ($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "root", []), "count", [], "method")) {
            // line 126
            echo "<nav class=\"g-main-nav\" role=\"navigation\"";
            echo (($this->getAttribute(($context["particle"] ?? null), "mobileTarget", [])) ? (" data-g-mobile-target") : (""));
            echo " data-g-hover-expand=\"";
            echo (((($this->getAttribute(($context["particle"] ?? null), "hoverExpand", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "hoverExpand", []), "true")) : ("true"))) ? ("true") : ("false"));
            echo "\">
    <ul class=\"g-toplevel\">
        ";
            // line 128
            echo $context["macro"]->getdisplayItems($this->getAttribute(($context["menu"] ?? null), "root", []), ($context["menu"] ?? null), $context);
            echo "
    </ul>
</nav>
";
        }
    }

    // line 7
    public function getgetCustomWidth($__item__ = null, $__menu__ = null, $__mode__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "menu" => $__menu__,
            "mode" => $__mode__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 8
            if ((((($this->getAttribute(($context["item"] ?? null), "width", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "width", []), "auto")) : ("auto")) != "auto") &&  !((($context["dropdown_type"] ?? null) == "fullwidth") && ($this->getAttribute(($context["item"] ?? null), "level", []) > 1)))) {
                // line 9
                if ((($context["mode"] ?? null) == "item")) {
                    echo " style=\"position: relative;\"";
                } elseif ((                // line 10
($context["mode"] ?? null) == "submenu")) {
                    echo " style=\"width:";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "width", []), "html", null, true);
                    echo ";\" data-g-item-width=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "width", []), "html", null, true);
                    echo "\"";
                }
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

    // line 15
    public function getdisplayParticle($__item__ = null, $__context__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "context" => $__context__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 16
            echo "    ";
            $context["context"] = twig_array_merge(($context["context"] ?? null), ["particle" => $this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", []), "particle", [])]);
            // line 17
            echo "    ";
            $context["classes"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", []), "block", []), "class", []);
            // line 18
            echo "    <div class=\"menu-item-particle";
            ((($context["classes"] ?? null)) ? (print (twig_escape_filter($this->env, (" " . ($context["classes"] ?? null)), "html", null, true))) : (print ("")));
            echo "\">
    ";
            // line 19
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
            try {
                $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =                 $this->loadTemplate([0 => (("particles/" . $this->getAttribute(($context["item"] ?? null), "particle", [])) . ".html.twig"), 1 => (("@particles/" . $this->getAttribute(($context["item"] ?? null), "particle", [])) . ".html.twig")], "@particles/menu.html.twig", 19);
            } catch (LoaderError $e) {
                // ignore missing template
            }
            if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
                $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display(twig_to_array(                // line 20
($context["context"] ?? null)));
            }
            // line 21
            echo "    </div>
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 24
    public function getdisplayTitle($__item__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 25
            echo "    ";
            if (( !$this->getAttribute(($context["item"] ?? null), "icon_only", []) ||  !($this->getAttribute(($context["item"] ?? null), "image", []) || $this->getAttribute(($context["item"] ?? null), "icon", [])))) {
                // line 26
                echo "        <span class=\"g-menu-item-title\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", []), "html", null, true);
                echo "</span>
        ";
                // line 27
                if ($this->getAttribute(($context["item"] ?? null), "subtitle", [])) {
                    // line 28
                    echo "            <span class=\"g-menu-item-subtitle\">";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "subtitle", []), "html", null, true);
                    echo "</span>
        ";
                }
                // line 30
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

    // line 33
    public function getdisplayItem($__item__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 34
            echo "    ";
            $context["self"] = $this;
            // line 35
            echo "    ";
            if ((($this->getAttribute(($context["item"] ?? null), "type", []) == "particle") &&  !$this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", []), "particle", []), "enabled", []))) {
                echo " 
        ";
                // line 36
                $context["enabled"] = 0;
                // line 37
                echo "    ";
            }
            // line 38
            echo "    ";
            if ((($this->getAttribute(($context["item"] ?? null), "visible", []) && $this->getAttribute(($context["item"] ?? null), "enabled", [])) && (((isset($context["enabled"]) || array_key_exists("enabled", $context))) ? (_twig_default_filter(($context["enabled"] ?? null), 1)) : (1)))) {
                // line 39
                echo "        ";
                $context["title"] = ((($this->getAttribute(($context["item"] ?? null), "icon_only", []) || $this->getAttribute(($context["item"] ?? null), "link_title", []))) ? (((" title=\"" . twig_escape_filter($this->env, (($this->getAttribute(($context["item"] ?? null), "link_title", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "link_title", []), $this->getAttribute(($context["item"] ?? null), "title", []))) : ($this->getAttribute(($context["item"] ?? null), "title", []))))) . "\"")) : (""));
                // line 40
                echo "        ";
                $context["label"] = ((($this->getAttribute(($context["item"] ?? null), "icon_only", []) && ($this->getAttribute(($context["item"] ?? null), "image", []) || $this->getAttribute(($context["item"] ?? null), "icon", [])))) ? (((" aria-label=\"" . twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", []))) . "\"")) : (""));
                // line 41
                echo "        ";
                $context["active"] = (($this->getAttribute(($context["menu"] ?? null), "isActive", [0 => ($context["item"] ?? null)], "method")) ? (" active") : (""));
                // line 42
                echo "        ";
                $context["dropdown"] = ((($this->getAttribute(($context["item"] ?? null), "level", []) == 1)) ? ((" g-" . $this->getAttribute(($context["item"] ?? null), "getDropdown", [], "method"))) : (""));
                // line 43
                echo "        ";
                $context["parent"] = (($this->getAttribute(($context["item"] ?? null), "children", [])) ? (" g-parent") : (""));
                // line 44
                echo "        ";
                $context["target"] = (((($this->getAttribute(($context["item"] ?? null), "target", []) != "_self") || $this->getAttribute($this->getAttribute(($context["context"] ?? null), "particle", []), "forceTarget", []))) ? (((" target=\"" . twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "target", []))) . "\"")) : (""));
                // line 45
                echo "        ";
                $context["rel"] = (($this->getAttribute(($context["item"] ?? null), "rel", [])) ? (((" rel=\"" . twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "rel", []))) . "\"")) : (""));
                // line 46
                echo "
        <li class=\"g-menu-item g-menu-item-type-";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "type", []), "html", null, true);
                echo " g-menu-item-";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "id", []), "html", null, true);
                if ( !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", [])) {
                    echo twig_escape_filter($this->env, ($context["parent"] ?? null), "html", null, true);
                }
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["dropdown"] ?? null), "html", null, true);
                echo " ";
                if (($this->getAttribute(($context["item"] ?? null), "url", []) && $this->getAttribute(($context["item"] ?? null), "children", []))) {
                    if ( !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", [])) {
                        echo "g-menu-item-link-parent";
                    }
                }
                echo " ";
                echo twig_escape_filter($this->env, (($this->getAttribute(($context["item"] ?? null), "class", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "class", []), "")) : ("")), "html", null, true);
                echo "\"";
                // line 48
                echo $context["self"]->getgetCustomWidth(($context["item"] ?? null), ($context["menu"] ?? null), "item", ($context["dropdown"] ?? null));
                // line 49
                if ((($this->getAttribute($this->getAttribute(($context["context"] ?? null), "particle", [], "any", false, true), "renderTitles", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["context"] ?? null), "particle", [], "any", false, true), "renderTitles", []), 0)) : (0))) {
                    echo " title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", []), "html", null, true);
                    echo "\"";
                }
                echo ">
            ";
                // line 50
                if ($this->getAttribute(($context["item"] ?? null), "url", [])) {
                    echo "<a class=\"g-menu-item-container";
                    (($this->getAttribute(($context["item"] ?? null), "anchor_class", [])) ? (print (twig_escape_filter($this->env, (" " . $this->getAttribute(($context["item"] ?? null), "anchor_class", [])), "html", null, true))) : (print ("")));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "url", []), "html", null, true);
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "hash", []), "html", null, true);
                    echo "\"";
                    echo (((($context["title"] ?? null) . ($context["label"] ?? null)) . ($context["target"] ?? null)) . ($context["rel"] ?? null));
                    echo ">
            ";
                } else {
                    // line 51
                    echo "<div class=\"g-menu-item-container";
                    (($this->getAttribute(($context["item"] ?? null), "anchor_class", [])) ? (print (twig_escape_filter($this->env, (" " . $this->getAttribute(($context["item"] ?? null), "anchor_class", [])), "html", null, true))) : (print ("")));
                    echo "\" data-g-menuparent=\"\"";
                    echo ($context["label"] ?? null);
                    echo ">";
                }
                // line 52
                echo "                ";
                if ($this->getAttribute(($context["item"] ?? null), "image", [])) {
                    // line 53
                    echo "                    <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute(($context["item"] ?? null), "image", [])), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", []), "html", null, true);
                    echo "\" />
                ";
                } elseif ($this->getAttribute(                // line 54
($context["item"] ?? null), "icon", [])) {
                    // line 55
                    echo "                    <i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "icon", []), "html", null, true);
                    echo "\" aria-hidden=\"true\"></i>
                ";
                }
                // line 57
                echo "                ";
                if ($this->getAttribute(($context["item"] ?? null), "url", [])) {
                    // line 58
                    echo "                    <span class=\"g-menu-item-content\">
                        ";
                    // line 59
                    echo $context["self"]->getdisplayTitle(($context["item"] ?? null));
                    echo "
                    </span>
                    ";
                    // line 61
                    if (($this->getAttribute(($context["item"] ?? null), "children", []) &&  !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", []))) {
                        // line 62
                        echo "<span class=\"g-menu-parent-indicator\" data-g-menuparent=\"\"></span>";
                    }
                    // line 64
                    echo "                ";
                } else {
                    // line 65
                    echo "                    ";
                    if (($this->getAttribute(($context["item"] ?? null), "type", []) == "particle")) {
                        // line 66
                        echo "                        ";
                        echo $context["self"]->getdisplayParticle(($context["item"] ?? null), ($context["context"] ?? null));
                        echo "
                    ";
                    } elseif (($this->getAttribute(                    // line 67
($context["item"] ?? null), "type", []) == "heading")) {
                        // line 68
                        echo "                        <span class=\"g-nav-header g-menu-item-content\"";
                        echo ($context["title"] ?? null);
                        echo ">";
                        echo $context["self"]->getdisplayTitle(($context["item"] ?? null));
                        echo "</span>
                    ";
                    } else {
                        // line 70
                        echo "                        <span class=\"g-separator g-menu-item-content\"";
                        echo ($context["title"] ?? null);
                        echo ">";
                        echo $context["self"]->getdisplayTitle(($context["item"] ?? null));
                        echo "</span>
                    ";
                    }
                    // line 72
                    echo "                        ";
                    if (($this->getAttribute(($context["item"] ?? null), "children", []) &&  !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", []))) {
                        // line 73
                        echo "<span class=\"g-menu-parent-indicator\"></span>";
                    }
                    // line 75
                    echo "                ";
                }
                // line 76
                echo "            ";
                if ($this->getAttribute(($context["item"] ?? null), "url", [])) {
                    echo "</a>
            ";
                } else {
                    // line 77
                    echo "</div>";
                }
                // line 78
                echo "            ";
                if ($this->getAttribute(($context["item"] ?? null), "children", [])) {
                    // line 79
                    echo $context["self"]->getdisplaySubmenu(($context["item"] ?? null), ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                }
                // line 81
                echo "        </li>
    ";
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

    // line 85
    public function getdisplayContainers($__item__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 86
            echo "    ";
            $context["self"] = $this;
            // line 87
            echo "    <div class=\"g-grid\">
        ";
            // line 88
            $context["groups"] = ((($this->getAttribute(($context["item"] ?? null), "getDropdown", [], "method") == "standard")) ? ([0 => ($context["item"] ?? null)]) : ($this->getAttribute(($context["item"] ?? null), "groups", [])));
            // line 89
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
            foreach ($context['_seq'] as $context["column"] => $context["items"]) {
                // line 90
                echo "        <div class=\"g-block ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('toGrid')->getCallable(), [$this->getAttribute(($context["item"] ?? null), "columnWidth", [0 => $context["column"]], "method")]), "html", null, true);
                echo "\">
            <ul class=\"g-sublevel\">
                <li class=\"g-level-";
                // line 92
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "level", []), "html", null, true);
                echo " g-go-back\">
                    <a class=\"g-menu-item-container\" href=\"#\" data-g-menuparent=\"\"><span>Back</span></a>
                </li>
                ";
                // line 95
                echo $context["self"]->getdisplayItems($context["items"], ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                echo "
            </ul>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['column'], $context['items'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "    </div>
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 102
    public function getdisplayItems($__items__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 103
            echo "    ";
            $context["self"] = $this;
            // line 104
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 105
                echo "        ";
                if (($this->getAttribute($context["item"], "level", []) == 1)) {
                    $context["dropdown_type"] = $this->getAttribute($context["item"], "dropdown", []);
                }
                // line 106
                echo "        ";
                echo $context["self"]->getdisplayItem($context["item"], ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 110
    public function getdisplaySubmenu($__item__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 111
            echo "    ";
            $context["self"] = $this;
            // line 112
            echo "    ";
            if ( !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", [])) {
                // line 113
                echo "        ";
                $context["animation"] = (($this->getAttribute($this->getAttribute($this->getAttribute(($context["context"] ?? null), "gantry", [], "any", false, true), "config", [], "any", false, true), "get", [0 => "styles.menu.animation"], "method", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["context"] ?? null), "gantry", [], "any", false, true), "config", [], "any", false, true), "get", [0 => "styles.menu.animation"], "method"), "g-fade")) : ("g-fade"));
                // line 114
                echo "        ";
                if (((((twig_length_filter($this->env, $this->getAttribute(($context["item"] ?? null), "groups", [])) == 1) && ( !($context["dropdown_type"] ?? null) == "fullwidth")) || (($context["dropdown_type"] ?? null) == "standard")) || (((($this->getAttribute(($context["item"] ?? null), "width", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "width", []), "auto")) : ("auto")) != "auto") && (($context["dropdown_type"] ?? null) == "fullwidth")))) {
                    $context["dropdown_dir"] = ("g-dropdown-" . (($this->getAttribute(($context["item"] ?? null), "dropdown_dir", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "dropdown_dir", []), "right")) : ("right")));
                }
                // line 115
                echo "        <ul class=\"g-dropdown g-inactive ";
                echo twig_escape_filter($this->env, ($context["animation"] ?? null), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, ($context["dropdown_dir"] ?? null), "html", null, true);
                echo "\"";
                echo $context["self"]->getgetCustomWidth(($context["item"] ?? null), ($context["menu"] ?? null), "submenu", ($context["dropdown_type"] ?? null));
                echo ">
            <li class=\"g-dropdown-column\">
                ";
                // line 117
                echo $context["self"]->getdisplayContainers(($context["item"] ?? null), ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                echo "
            </li>
        </ul>
    ";
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
        return "@particles/menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  589 => 117,  579 => 115,  574 => 114,  571 => 113,  568 => 112,  565 => 111,  550 => 110,  528 => 106,  523 => 105,  518 => 104,  515 => 103,  500 => 102,  484 => 99,  474 => 95,  468 => 92,  462 => 90,  457 => 89,  455 => 88,  452 => 87,  449 => 86,  434 => 85,  417 => 81,  414 => 79,  411 => 78,  408 => 77,  402 => 76,  399 => 75,  396 => 73,  393 => 72,  385 => 70,  377 => 68,  375 => 67,  370 => 66,  367 => 65,  364 => 64,  361 => 62,  359 => 61,  354 => 59,  351 => 58,  348 => 57,  342 => 55,  340 => 54,  333 => 53,  330 => 52,  323 => 51,  311 => 50,  303 => 49,  301 => 48,  283 => 47,  280 => 46,  277 => 45,  274 => 44,  271 => 43,  268 => 42,  265 => 41,  262 => 40,  259 => 39,  256 => 38,  253 => 37,  251 => 36,  246 => 35,  243 => 34,  228 => 33,  212 => 30,  206 => 28,  204 => 27,  199 => 26,  196 => 25,  184 => 24,  168 => 21,  165 => 20,  157 => 19,  152 => 18,  149 => 17,  146 => 16,  133 => 15,  111 => 10,  108 => 9,  106 => 8,  91 => 7,  82 => 128,  74 => 126,  72 => 125,  69 => 124,  67 => 123,  64 => 122,  61 => 109,  58 => 101,  55 => 84,  52 => 32,  49 => 23,  46 => 14,  43 => 6,  37 => 4,  31 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/menu.html.twig", "W:\\iSell\\www\\diyar\\media\\gantry5\\engines\\nucleus\\particles\\menu.html.twig");
    }
}
